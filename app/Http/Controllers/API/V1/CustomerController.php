<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\CustomersFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreCustomerRequest;
use App\Http\Requests\V1\UpdateCustomerRequest;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $req)
    {

        $filter             = new CustomersFilter();
        $filterItems        = $filter->transform($req);          // ['col', 'operator', 'value']
        $includeInvoices    = request()->query('includeInvoices');

        $customers = Customer::where($filterItems);

        if ($includeInvoices) {
            $customers = $customers->with('invoices');

        }

        return new CustomerCollection(
            $customers->paginate()->appends($req->query())
        );
    }

    public function show(Customer $customer)
    {
        $includeInvoices = request()->query('includeInvoices');

        if ($includeInvoices) {
            return new CustomerResource($customer->loadMissing('invoices'));
        }
        return new CustomerResource($customer);
    }

    public function store(StoreCustomerRequest $req) {
        return new CustomerResource(Customer::create($req->all()));
    }

    public function update(UpdateCustomerRequest $req, Customer $customer) {
        $customer->update($req->all());
    }
}
