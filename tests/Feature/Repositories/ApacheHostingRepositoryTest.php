<?php

namespace Tests\Feature\Repositories;

use App\Models\Domain;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\ApacheHostingRepository;
use Illuminate\Support\Facades\Storage;
use App\Models\Hosting;
use Tests\TestCase;

class ApacheHostingRepositoryTest extends TestCase
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
     * @var ApacheHostingRepository
     */
    protected $repository;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('hosting');
        Storage::fake('apache');

        $this->domain       = Domain::factory()->create();
        $this->hosting      = Hosting::factory(['domain_id' => $this->domain])->create();
        $this->repository   = new ApacheHostingRepository($this->hosting);
    }
    
    public function test_hosting_directory_structure_created()
    {
        // arrange
        $expectedPath = "{$this->domain->name}/public";

        // act
        $this->repository->create();

        // assert
        Storage::disk('hosting')->assertExists($expectedPath);
    }
    
    public function test_htaccess_created()
    {
        // arrange
        $expectedPath = "{$this->domain->name}/.htaccess";

        // act
        $this->repository->create();

        // assert
        Storage::disk('hosting')->assertExists($expectedPath);
        $conf = Storage::disk('hosting')->get($expectedPath);

        preg_match("/RewriteBase \/([[:alnum:]\.]*)\//s", $conf, $rootDirName);
        $rootDirName = $rootDirName[1];

        $this->assertEquals($this->domain->name, $rootDirName);
    }
    
    public function test_index_php_created()
    {
        // arrange
        $expectedPath = "{$this->domain->name}/public/index.php";
        $expectedFile = file_get_contents( resource_path('testing/index.php') );

        // act
        $this->repository->create();

        // assert
        Storage::disk('hosting')->assertExists($expectedPath);
        $index = Storage::disk('hosting')->get($expectedPath);
        
        $this->assertEquals($expectedFile, $index);
    }
}