<?php

namespace App\Jobs;

use App\Repositories\Contracts\DomainRepository;
use App\Models\{Plan, Customer};
use App\Repositories\Contracts\FTPRepository;
use App\Repositories\Contracts\HostingRepository;
use App\Repositories\Contracts\MailAccountRepository;
use App\Repositories\Contracts\WireguardRepository;
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
    public function handle(DomainRepository $domainRepository, HostingRepository $hostingRepository, FTPRepository $ftpRepository, MailAccountRepository $mailaccountRepository)
    {
        $this->customer->load('domain', 'hosting','email', 'wireguard');

        if ($this->plan->hosting) {
            $hostingRepository->setHosting($this->customer->hosting);
            $hostingRepository->create();

            $ftpRepository->setHosting($this->customer->hosting);
            $ftpRepository->create();
            
            $this->customer->hosting->update(['ready' => true]);
        }

        if ($this->plan->domain) {
            $domainRepository->setDomain($this->customer->domain);
            $domainRepository->create();
            
            $this->customer->domain->update(['ready' => true]);
        }

        if($this->plan->email){
            
            $mailaccountRepository->setEmail($this->customer->email);
            $mailaccountRepository->create();
            
            $this->customer->email->update(['ready' => true]);
        }

        // if($this->plan->wireguard){
        //     $wireguardRepository->setWireguard($this->customer->wireguard);
        //     $wireguardRepository->registerPeer();
        // }

    }
}
