<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\InvoiceFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\InvoiceCollection;
use App\Http\Resources\V1\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $req)
    {

        $filter     = new InvoiceFilters();
        $queryItems = $filter->transform($req);          // ['col', 'operator', 'value']


        if (count($queryItems) == 0) {
            return new InvoiceCollection(Invoice::paginate(10));
        } else {
            $customers = Invoice::where($queryItems)->paginate();
            return new InvoiceCollection($customers->appends($req->query()));
        }
    }

    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }
}
