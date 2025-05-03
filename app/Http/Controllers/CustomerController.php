<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function deleteAll()
{
    Customer::truncate();
    Order::truncate();
    return response()->json(['message' => 'All customers and orders deleted successfully']);
}
    public function getCustomers()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }


    public function addCustomer(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:customers,email',
        ]);
        $customer = Customer::create($validated);

        return response()->json($customer, 201);
    }
}
