<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\CustomersFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $req)
    {

        $filter = new CustomersFilter();
        $queryItems = $filter->transform($req);          // ['col', 'operator', 'value']


        if (count($queryItems) == 0) {
            return new CustomerCollection(Customer::paginate(10));
        } else {
            $customers = Customer::where($queryItems)->paginate();
            return new CustomerCollection($customers->appends($req->query()));
        }
    }

    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }
}
