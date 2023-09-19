<?php

namespace App\Services;

use Illuminate\Http\Request;

class CustomerQuery{
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

    public function transform(Request $request){
        $eloQuery = [];

        foreach ($this->allowedParams as $parm => $operators) {
            $query = $request->query($parm);

            if(!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as $operator) {
                if(isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloQuery;
    }

}