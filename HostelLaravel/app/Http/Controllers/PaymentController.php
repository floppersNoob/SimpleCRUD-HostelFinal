<?php
namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Payment;
use App\Models\Customer;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('customer')->get();
        return response()->json($payments, 200);
    }
  
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount_paid' => 'required|numeric',
            'payment_method' => 'required|string',
            'payment_date' => 'required|date',
            'status' => 'required|string|in:Approved,Pending',
        ]);
        $payment = Payment::create($validated);

        $customer = Customer::find($validated['customer_id']);
        $customer->payment_status = $validated['status'];
        if ($validated['status'] === 'Approved') {
            Room::where('id', $customer->room_id)->update(['status' => 'Reserved']);
        }
        $customer->save();
        return response()->json(['message' => 'Payment recorded and room status updated'], 200);
    }
}