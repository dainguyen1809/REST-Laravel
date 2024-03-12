<?php

namespace App\Http\Controllers;

use App\Filters\V1\CustomersFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;


class TestController extends Controller
{
    // public function test(Customer $customer)
    // {

    //     $includeInvoices = request()->query('includeInvoices');

    //     if ($includeInvoices) {
    //         return new CustomerResource($customer->loadMissing('invoices'));
    //     }
    //     return new CustomerResource($customer);
    //     // return new CustomerCollection(Customer::paginate(10));
    // }

    public function test(Request $req)
    {

        $filter = new CustomersFilter();
        $filterItems = $filter->transform($req);          // ['col', 'operator', 'value']

        $includeInvoices = request()->query('includeInvoices');

        $customers = Customer::where($filterItems);

        if ($includeInvoices) {
            $customers = $customers->with('invoices');

        }

        // $customers = $customers->paginate()->appends($req->query());
        // // dd($customers);

        // return view('customers.index', ['customers' => $customers]);

        return new CustomerCollection(
            $customers->paginate(3)
                ->appends($req->query())
        );
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
