<?php

namespace App\Filters;

use Illuminate\Http\Request;


class InvoicesFilter extends ApiFilter{
    protected $allowedParams = [
        'customerId' => ['eq'],
        'amount' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'status' => ['eq', 'ne'],
        'billedDate' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'paidDate' => ['eq', 'lt', 'lte', 'gt', 'gte'],
    ];

    protected $columnMap = [
        'customerId' => 'customer_id',
        'billedDate' => 'billed_date',
        'paidDate' => 'paid_date',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'ne' => '!='
    ];

}