<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Request;
use App\Filters\CustomersFilter;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // filtering customer data
        $filter = new CustomersFilter();

        $queryItems = $filter->transform($request); // [['column', 'operator', 'value']]

        if (count($queryItems) == 0) {
            return new CustomerCollection(Customer::with('invoices')->paginate());
        } else {
            $customers = Customer::where($queryItems)->paginate();
            return new CustomerCollection($customers->append($request->query()));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        return new CustomerResource(Customer::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());
        return response()->json(['message' => 'Customer updated successfully', 'data' => $customer]);
    }

    // public function update(Request $request, $id)
    // {
    //     $data = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'type' => 'required|in:I,i,B,b', // Ensure 'type' is one of: Individual, Business (case-insensitive)
    //         'city' => 'required|string|max:255',
    //         'address' => 'required|string',
    //     ]);
    
    //     $customer = Customer::find($id);
    
    //     if (!$customer) {
    //         return response()->json(['message' => 'Customer not found'], 404);
    //     }
    
    //     $customer->update([
    //         'name' => $data['name'],
    //         'type' => strtoupper($data['type']), // Convert 'type' to uppercase
    //         'city' => $data['city'],
    //         'address' => $data['address'],
    //     ]);
    
    //     return response()->json(['message' => 'Customer updated successfully', 'data' => $customer]);
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
