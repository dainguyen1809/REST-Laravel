<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class CustomersFilter extends ApiFilter
{
    protected $safeParams = [
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'],
        'address' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq', 'gt', 'lt'],
    ];

    protected $columnMap = [
        'postalCode' => 'postal_code',

    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];

    // public function transform(Request $req)
    // {
    //     $eloQuery = [];

    //     foreach ($this->safeParams as $param => $operators) {
    //         $query = $req->query($param);

    //         if (!isset($query)) {
    //             continue;
    //         }

    //         $column = $this->columnMap[$param] ?? $param;

    //         foreach ($operators as $operator) {
    //             if (isset($query[$operator])) {
    //                 $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
    //             }
    //         }
    //     }

    //     return $eloQuery;
    // }

}
