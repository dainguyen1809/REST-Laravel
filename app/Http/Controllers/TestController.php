<?php

namespace App\Http\Controllers;

use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;

class TestController extends Controller
{
    public function test()
    {
        return new CustomerCollection(Customer::paginate(10));
    }

    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    // public function show(Customer $customer)
    // {
    //     // For API
    //     if (request()->wantsJson()) {
    //         return new CustomerResource($customer);
    //     }

    //     // For view
    //     return view('customers.show', compact('customer'));
    // }
}
