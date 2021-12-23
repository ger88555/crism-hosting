<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowCustomerDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (auth('customer')->user()->plan_id === null) {
            return redirect('/plans');
        }

        return view('backoffice.customer.dashboard');
    }
}
