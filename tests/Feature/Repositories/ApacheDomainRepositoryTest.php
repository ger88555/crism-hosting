<?php

namespace Tests\Feature\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\ApacheDomainRepository;
use Illuminate\Support\Facades\Storage;
use App\Models\Domain;
use App\Services\SystemCommandService;
use Tests\TestCase;

class ApacheDomainRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The domain data
     *
     * @var Domain
     */
    protected $domain;

    /**
     * The repository instance
     *
     * @var ApacheDomainRepository
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
        $this->setUpApacheFiles();

        Storage::fake('hosting');

        $this->domain = Domain::factory()->create();
        $this->repository = new ApacheDomainRepository($this->domain);
    }

    protected function setUpApacheFiles()
    {
        Storage::fake('apache');

        $configPath = config('services.apache.conf.httpd');
        $httpd = file_get_contents( resource_path('testing/httpd.conf') );

        Storage::disk('apache')->put($configPath, $httpd);
    }
    
    public function test_site_config_file_created()
    {
        // arrange
        $expectedPath = "{$this->domain->name}.conf";
        $expectedConf = view('apache.vhost', ['domain' => $this->domain->name])->render();

        // act
        $this->repository->create();

        // assert
        Storage::disk('apache')->assertExists($expectedPath);
        $conf = Storage::disk('apache')->get($expectedPath);

        $this->assertEquals($expectedConf, $conf);        
    }
    
    public function test_site_config_file_included()
    {
        $this->markTestSkipped();

        // arrange
        $includeStatement = view('apache.httpd', ['domain' => $this->domain->name])->render();
        $expectedPath = config('services.apache.conf.httpd');

        // act
        $this->repository->create();

        // assert
        Storage::disk('apache')->assertExists($expectedPath);
        $conf = Storage::disk('apache')->get($expectedPath);

        $OPENING_TAG = "<IfModule.*?>";
        $CLOSING_TAG = "<\/IfModule>";

        preg_match("/$OPENING_TAG(.*)$CLOSING_TAG/s", $conf, $expectedZone);
        $expectedZone = $expectedZone[1];

        $this->assertStringContainsString($includeStatement, $expectedZone);
    }
    
    public function test_site_enabled()
    {
        // prepare
        $spy = $this->spy(SystemCommandService::class);
        
        // act
        $this->repository->create();

        // assert
        $spy->shouldHaveReceived('run', ["a2enable {$this->domain->name}"]);
    }
    
    public function test_apache_reloaded()
    {
        // prepare
        $spy = $this->spy(SystemCommandService::class);

        // act
        $this->repository->create();

        // assert
        $spy->shouldHaveReceived('run', function ($command) {
            return str_contains($command, "apachectl");
        });
    }
}