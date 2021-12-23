<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckForActivatedPlan
{

    /**
     * Redirect customers with an active plan to this URI.
     */
    const ACTIVE_PLAN_REDIRECT_URI = '/dashboard';

    /**
     * Redirect customers with no active plan to this URI.
     */
    const INACTIVE_PLAN_REDIRECT_URI = '/plans';
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  bool $shouldBeActive Wether the customer's plan should be active.
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $shouldBeActive = true)
    {
        $shouldBeActive = filter_var($shouldBeActive, FILTER_VALIDATE_BOOLEAN);

        $customer = auth('customer')->user();

        if ($shouldBeActive && $customer->plan_id === null) {
            return redirect(static::INACTIVE_PLAN_REDIRECT_URI);

        } else if ($shouldBeActive == false && $customer->plan_id) {
            return redirect(static::ACTIVE_PLAN_REDIRECT_URI);
        }

        return $next($request);
    }
}
