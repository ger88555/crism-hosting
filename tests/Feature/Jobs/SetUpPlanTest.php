<?php

namespace Tests\Feature\Jobs;

use App\Repositories\Contracts\{ DomainRepository, HostingRepository, FTPRepository, MailAccountRepository};
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\{ Customer, Plan, Domain, Email, Hosting };
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

    private function expectRepositoryToReceive($abstract, $method, $arg)
    {
        $this->mock($abstract, function (MockInterface $mock) use ($method, $arg) {
            $mock
                ->shouldReceive($method)
                ->with(
                    \Mockery::on(fn ($param) => $param->id === $arg->id)
                )
                ->once();
                
            $mock->shouldReceive('create')->once()->andReturn(null);
        });
    }

    private function expectRepositoryNotToReceive($abstract, $method, $arg)
    {
        $this->mock($abstract, function (MockInterface $mock) use ($method, $arg) {
            $mock
                ->shouldNotReceive($method)
                ->with(
                    \Mockery::on(fn ($param) => $param->id === $arg->id)
                );
                
            $mock->shouldNotReceive('create');
        });
    }
    
    public function test_domain_created_when_included_in_plan()
    {
        // arrange
        $plan = Plan::factory()->create(['domain' => true, 'hosting' => false, 'email' => false]);
        $customer = Customer::factory()->create(['plan_id' => $plan]);
        $domain = Domain::factory()->create(['customer_id' => $customer]);

        // assert
        $this->expectRepositoryToReceive(DomainRepository::class, 'setDomain', $domain);

        // act
        SetUpPlan::dispatchSync($customer);

        // assert
        $this->assertTrue($domain->fresh()->ready);
    }

    public function test_domain_not_created_when_not_included_in_plan()
    {
        // arrange
        $plan = Plan::factory()->create(['domain' => false, 'hosting' => false, 'email' => false]);
        $customer = Customer::factory()->create(['plan_id' => $plan]);
        $domain = Domain::factory()->create(['customer_id' => $customer]);

        // assert
        $this->expectRepositoryNotToReceive(DomainRepository::class, 'setDomain', $domain);

        // act
        SetUpPlan::dispatchSync($customer);

        // assert
        $this->assertFalse($domain->fresh()->ready);
    }
    
    public function test_hosting_created_when_included_in_plan()
    {
        // arrange
        $plan = Plan::factory()->create(['hosting' => true, 'domain' => false, 'email' => false]);
        $customer = Customer::factory()->create(['plan_id' => $plan]);
        $domain = Domain::factory()->create(['customer_id' => $customer]);
        $hosting = Hosting::factory()->create(['customer_id' => $customer, 'domain_id' => $domain]);

        // assert
        $this->expectRepositoryToReceive(HostingRepository::class, 'setHosting', $hosting);
        $this->expectRepositoryToReceive(FTPRepository::class, 'setHosting', $hosting);

        // act
        SetUpPlan::dispatchSync($customer);

        // assert
        $this->assertTrue($hosting->fresh()->ready);
    }

    public function test_hosting_not_created_when_not_included_in_plan()
    {
        // arrange
        $plan = Plan::factory()->create(['hosting' => false, 'domain' => false, 'email' => false]);
        $customer = Customer::factory()->create(['plan_id' => $plan]);
        $domain = Domain::factory()->create(['customer_id' => $customer]);
        $hosting = Hosting::factory()->create(['customer_id' => $customer, 'domain_id' => $domain]);

        // assert
        $this->expectRepositoryNotToReceive(HostingRepository::class, 'setHosting', $hosting);
        $this->expectRepositoryNotToReceive(FTPRepository::class, 'setHosting', $hosting);

        // act
        SetUpPlan::dispatchSync($customer);

        // assert
        $this->assertFalse($hosting->fresh()->ready);
    }
    
    public function test_email_created_when_included_in_plan()
    {
        // arrange
        $plan = Plan::factory()->create(['hosting' => false, 'domain' => false, 'email' => true]);
        $customer = Customer::factory()->create(['plan_id' => $plan]);
        $email = Email::factory()->create(['customer_id' => $customer]);

        // assert
        $this->expectRepositoryToReceive(MailAccountRepository::class, 'setEmail', $email);

        // act
        SetUpPlan::dispatchSync($customer);

        // assert
        $this->assertTrue($email->fresh()->ready);
    }

    public function test_email_not_created_when_not_included_in_plan()
    {
        // arrange
        $plan = Plan::factory()->create(['hosting' => false, 'domain' => false, 'email' => false]);
        $customer = Customer::factory()->create(['plan_id' => $plan]);
        $email = Email::factory()->create(['customer_id' => $customer]);

        // assert
        $this->expectRepositoryNotToReceive(MailAccountRepository::class, 'setEmail', $email);

        // act
        SetUpPlan::dispatchSync($customer);

        // assert
        $this->assertFalse($email->fresh()->ready);
    }
}