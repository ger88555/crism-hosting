<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

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
        
        $customer = auth('customer')->user();
        $hosting = $customer->hosting()->get();
        $domain = $customer->domain()->get();
        $email = $customer->email()->get();
        $wireguard = $customer->wireguard()->get();

        $results  = [
            "customer" => $customer,
            "hosting" => $hosting,
            "domain" => $domain,
            "email" => $email,
            "wireguard" =>$wireguard,
        ];
    


        return view('backoffice.customer.dashboard',$results);
    }
}


/**
 *  $customer = auth('customer')->user();
 *  $hosting = $customer->hosting()->get();
 *  $domain = $customer->domain()->get();
 *  $email = $customer->email()->get();
 *  $wireguard = $customer->wireguard()->get()
 */
