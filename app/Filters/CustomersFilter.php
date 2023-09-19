<?php

namespace App\Filters;

use Illuminate\Http\Request;


class CustomersFilter extends ApiFilter{
    protected $allowedParams = [
        'name' => ['eq'],
        'type' => ['eq'],
        'city' => ['eq'],
        'address' => ['eq'],
        // equal-eq, greater-gt, less than-lt
    ];

    protected $columnMap = [
        // 'postalCode' => 'postal_code',
        'name' => 'name',
        'type' => 'type',
        'city' => 'city',
        'address' => 'address',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];
}