<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\Plan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Customer $customer)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Customer  $customer
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Customer $customer, Plan $plan)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Customer $customer)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Customer  $customer
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Customer $customer, Plan $plan)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Customer  $customer
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Customer $customer, Plan $plan)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Customer  $customer
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Customer $customer, Plan $plan)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Customer  $customer
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Customer $customer, Plan $plan)
    {
        //
    }
}
