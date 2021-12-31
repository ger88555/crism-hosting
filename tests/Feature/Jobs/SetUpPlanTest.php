<?php

namespace Tests\Feature\Jobs;

use App\Repositories\Contracts\{ DomainRepository, HostingRepository };
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\{ Customer, Plan, Domain, Hosting };
use App\Jobs\SetUpPlan;
use Mockery\MockInterface;
use Tests\TestCase;

class SetUpPlanTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
    }
    
    public function test_domain_created_when_included_in_plan()
    {
        // arrange
        $plan = Plan::factory()->create(['domain' => true, 'hosting' => false]);
        $customer = Customer::factory()->create(['plan_id' => $plan]);
        $domain = Domain::factory()->create(['customer_id' => $customer]);

        // assert
        $this->mock(DomainRepository::class, function (MockInterface $mock) use ($domain) {
            $mock
                ->shouldReceive('setDomain')
                ->with(
                    \Mockery::on(fn (Domain $param) => $param->id === $domain->id)
                )
                ->once();
                
            $mock->shouldReceive('create')->once()->andReturn(null);
        });

        // act
        SetUpPlan::dispatchSync($customer);

        // assert
        $this->assertTrue($domain->fresh()->ready);
    }

    public function test_domain_not_created_when_not_included_in_plan()
    {
        // arrange
        $plan = Plan::factory()->create(['domain' => false, 'hosting' => false]);
        $customer = Customer::factory()->create(['plan_id' => $plan]);
        $domain = Domain::factory()->create(['customer_id' => $customer]);

        // assert
        $this->mock(DomainRepository::class, function (MockInterface $mock) use ($domain) {
            $mock
                ->shouldNotReceive('setDomain')
                ->with(
                    \Mockery::on(fn (Domain $param) => $param->id === $domain->id)
                );
                
            $mock->shouldNotReceive('create');
        });

        // act
        SetUpPlan::dispatchSync($customer);

        // assert
        $this->assertFalse($domain->fresh()->ready);
    }
    
    public function test_hosting_created_when_included_in_plan()
    {
        // arrange
        $plan = Plan::factory()->create(['hosting' => true, 'domain' => false]);
        $customer = Customer::factory()->create(['plan_id' => $plan]);
        $domain = Domain::factory()->create(['customer_id' => $customer]);
        $hosting = Hosting::factory()->create(['customer_id' => $customer, 'domain_id' => $domain]);

        // assert
        $this->mock(HostingRepository::class, function (MockInterface $mock) use ($hosting) {
            $mock
                ->shouldReceive('setHosting')
                ->with(
                    \Mockery::on(fn (Hosting $param) => $param->id === $hosting->id)
                )
                ->once();
                
            $mock->shouldReceive('create')->once()->andReturn(null);
        });

        // act
        SetUpPlan::dispatchSync($customer);

        // assert
        $this->assertTrue($hosting->fresh()->ready);
    }

    public function test_hosting_not_created_when_not_included_in_plan()
    {
        // arrange
        $plan = Plan::factory()->create(['hosting' => false, 'domain' => false]);
        $customer = Customer::factory()->create(['plan_id' => $plan]);
        $domain = Domain::factory()->create(['customer_id' => $customer]);
        $hosting = Hosting::factory()->create(['customer_id' => $customer, 'domain_id' => $domain]);

        // assert
        $this->mock(HostingRepository::class, function (MockInterface $mock) use ($hosting) {
            $mock
                ->shouldNotReceive('setHosting')
                ->with(
                    \Mockery::on(fn (Hosting $param) => $param->id === $hosting->id)
                );
                
            $mock->shouldNotReceive('create');
        });

        // act
        SetUpPlan::dispatchSync($customer);

        // assert
        $this->assertFalse($hosting->fresh()->ready);
    }
}