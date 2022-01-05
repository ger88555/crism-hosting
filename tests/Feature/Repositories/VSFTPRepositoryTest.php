<?php

namespace Tests\Feature\Repositories;

use App\Models\Domain;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\VSFTPRepository;
use App\Models\Hosting;
use App\Services\SystemCommandService;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class VSFTPRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The hosting data
     *
     * @var Hosting
     */
    protected $hosting;

    /**
     * The domain data
     *
     * @var Domain
     */
    protected $domain;

    /**
     * The repository instance
     *
     * @var VSFTPRepository
     */
    protected $repository;

    /**
     * The SystemCommandService spy
     *
     * @var \Mockery\MockInterface
     */
    protected $commandSpy;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('hosting');

        $this->domain       = Domain::factory()->create();
        $this->hosting      = Hosting::factory()->create(['domain_id' => $this->domain]);
        $this->repository   = new VSFTPRepository($this->hosting);

        $this->commandSpy = $this->spy(SystemCommandService::class);
    }

    private function mockExistsCommand($returnValue = null)
    {
        $existsCommand = "id -u \"{$this->hosting->username}\" >/dev/null 2>&1;";

        $this->commandSpy->shouldReceive('run')
            ->withArgs([$existsCommand])
            ->once()
            ->andReturn($returnValue ?? rand(0, 1));
    }

    public function test_doesnt_create_user_if_exists()
    {
        // prepare
        $createCommand = "useradd -p $(openssl passwd -1 {$this->hosting->password}) {$this->hosting->username}";
        
        $this->mockExistsCommand(1);

        // act
        $this->repository->create();

        // assert
        $this->commandSpy->shouldNotHaveReceived('run', [$createCommand]);
    }

    public function test_creates_user_if_doesnt_exist()
    {
        // prepare
        $createCommand = "useradd -p $(openssl passwd -1 {$this->hosting->password}) {$this->hosting->username}";
        
        $this->mockExistsCommand(0);

        // act
        $this->repository->create();

        // assert
        $this->commandSpy->shouldHaveReceived('run', [$createCommand]);
    }

    public function test_allows_ftp_user()
    {
        // prepare
        $allowCommand = "echo \"{$this->hosting->username}\" | sudo tee -a /etc/vsftpd.userlist";
        
        $this->mockExistsCommand();

        // act
        $this->repository->create();

        // assert
        $this->commandSpy->shouldHaveReceived('run', [$allowCommand]);
    }

    public function test_restarts_daemon()
    {
        // prepare
        $restartCommand = "systemctl restart vsftpd";
        
        $this->mockExistsCommand();

        // act
        $this->repository->create();

        // assert
        $this->commandSpy->shouldHaveReceived('run', [$restartCommand]);
    }
}