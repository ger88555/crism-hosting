<?php

namespace App\Http\Controllers;

use App\Models\Customer;

class ShowAdminDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $customers = Customer::with('plan', 'hosting', 'domain', 'email', 'wireguard')->get();

        return view('backoffice.admin.dashboard', compact('customers'));
    }
}
