<?php

namespace App\Jobs;

use App\Repositories\Contracts\DomainRepository;
use App\Models\{Plan, Customer};
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SetUpPlan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The Plan information
     *
     * @var Plan
     */
    protected $plan;

    /**
     * The Plan's customer
     *
     * @var Customer
     */
    protected $customer;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer->withoutRelations();

        $this->customer->load('plan');
        
        $this->plan = $customer->plan;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(DomainRepository $domainRepository)
    {
        $this->customer->load('domain');

        if ($this->plan->domain) {
            $domainRepository->setDomain($this->customer->domain);
            $domainRepository->create();
            
            $this->customer->domain->update(['ready' => true]);
        }
    }
}