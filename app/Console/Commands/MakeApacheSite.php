<?php

namespace App\Console\Commands;

use App\Jobs\SetUpPlan;
use App\Models\Customer;
use App\Models\Domain;
use App\Models\Hosting;
use App\Models\Plan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MakeApacheSite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:apache-site';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an Apache hosting + domain.';

    /**
     * The site owner.
     *
     * @var Customer
     */
    protected $customer;

    /**
     * The site's domain data.
     *
     * @var Domain
     */
    protected $domain;

    /**
     * The site's hosting data.
     *
     * @var Hosting
     */
    protected $hosting;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->prepareData();

        $this->displayData();

        SetUpPlan::dispatch($this->customer);

        $this->newLine();
        $this->output->writeln('Check the job queue.');

        return 0;
    }

    protected function prepareData()
    {
        try {
            DB::beginTransaction();

            $this->customer = Customer::factory()->create(['plan_id' => $this->makeOrCreatePlan()]);
            $this->domain   = Domain::factory()->create(['customer_id' => $this->customer]);
            $this->hosting  = Hosting::factory()->create(['customer_id' => $this->customer, 'domain_id' => $this->domain]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }
    }

    protected function makeOrCreatePlan() : Plan
    {
        $desiredFields = ['hosting' => true, 'domain' => true];

        return Plan::firstOrCreate($desiredFields, Plan::factory()->makeOne($desiredFields)->toArray());
    }

    protected function displayData()
    {
        $this->warn("Customer:");
        $this->info("\tUsername: {$this->customer->username}");
        $this->info("\tPassword: password");
        $this->newLine();

        $this->warn("Domain name: ");
        $this->info($this->domain->name);
        $this->warn("Domain URL: ");
        $this->info($this->domain->name.'.'.config('services.apache.domain'));
        $this->newLine();

        $this->warn("FTP:");
        $this->info("\tUsername: {$this->hosting->username}");
        $this->info("\tPassword: {$this->hosting->password}");
        $this->newLine();

        $this->warn("Site conf file: ");
        $this->info(config('filesystems.disks.apache.root')."conf/{$this->domain->name}.conf");
        $this->warn("Apache conf file (will reference the site conf file): ");
        $this->info(config('filesystems.disks.apache.root').config('services.apache.conf.httpd'));
        $this->newLine();

        $this->warn("Site folder: ");
        $this->info(config('filesystems.disks.hosting.root')."{$this->domain->name}/");
    }
}
