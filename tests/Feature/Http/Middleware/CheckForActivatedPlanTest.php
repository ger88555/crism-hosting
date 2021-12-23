<?php

namespace Tests\Feature\Http\Middleware;

use App\Http\Middleware\CheckForActivatedPlan;
use App\Models\Customer;
use App\Models\Plan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class CheckForActivatedPlanTest extends TestCase
{
    use RefreshDatabase;

    public function test_redirect_unactivated_customer_when_active()
    {
        // arrange
        $customer = Customer::factory()->create(['plan_id' => null]);
        
        // act
        $response = $this->handle_customer($customer, true);

        // assert
        $response->assertRedirect(CheckForActivatedPlan::INACTIVE_PLAN_REDIRECT_URI);
    }

    public function test_dont_redirect_activated_customer_when_active()
    {
        // arrange
        $customer = Customer::factory()->create(['plan_id' => Plan::factory()->create()]);

        // act
        $response = $this->handle_customer($customer, true);

        // assert
        $response->assertStatus(200);
    }

    public function test_redirect_activated_customer_when_inactive()
    {
        // arrange
        $customer = Customer::factory()->create(['plan_id' => Plan::factory()->create()]);

        // act
        $response = $this->handle_customer($customer, false);

        // assert
        $response->assertRedirect(CheckForActivatedPlan::ACTIVE_PLAN_REDIRECT_URI);
    }

    public function test_dont_redirect_unactivated_customer_when_inactive()
    {
        // arrange
        $customer = Customer::factory()->create(['plan_id' => null]);

        // act
        $response = $this->handle_customer($customer, false);

        // assert
        $response->assertStatus(200);
    }

    /**
     * Get the response of the middleware when handling a customer.
     *
     * @param Customer $customer The customer.
     * @param boolean $shouldBeActive Expected plan activation status.
     * 
     * @return TestResponse The middleware response.
     */
    private function handle_customer(Customer $customer, $shouldBeActive = true)
    {        
        $this->actingAs(new Customer($customer->toArray()), 'customer');

        $middleware = new CheckForActivatedPlan;
        $request = Request::create('/', 'GET');
        $next = function () {
            return new Response;
        };

        $response = $middleware->handle($request, $next, $shouldBeActive);

        return TestResponse::fromBaseResponse($response);
    }
}
