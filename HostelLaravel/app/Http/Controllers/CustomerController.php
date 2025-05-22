<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;


class CustomerController extends Controller
{
    public function index()
    {
        return Customer::with('room')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'nullable|date|after_or_equal:check_in_date',
            'total_payment' => 'nullable|numeric',
            'payment_status' => 'nullable|string'
        ]);

        $customer = Customer::create($validated);
        return response()->json(Customer::with('room')->find($customer->id), 200);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->payment_status = $request->payment_status;
        $customer->save();      

        return response()->json($customer, 200);
    }
}