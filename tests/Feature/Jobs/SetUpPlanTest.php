<?php

namespace Tests\Feature\Jobs;

use App\Repositories\Contracts\DomainRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\{ Customer, Plan, Domain };
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
        $plan = Plan::factory()->create(['domain' => true]);
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
                
            $mock->shouldReceive('create')->once();
        });

        // act
        SetUpPlan::dispatchSync($customer);

        // assert
        $this->assertTrue($domain->fresh()->ready);
    }

    public function test_domain_not_created_when_not_included_in_plan()
    {
        // arrange
        $plan = Plan::factory()->create(['domain' => false]);
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
}