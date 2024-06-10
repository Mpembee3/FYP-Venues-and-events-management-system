<?php

namespace App\Http\Controllers;

use App\Models\PaymentRequest;
use Illuminate\Http\Request;

class PaymentRequestController extends Controller
{
    public function index()
    {
        $paymentRequests = PaymentRequest::all();
        return view('payment-requests.index', compact('paymentRequests'));
    }

    public function create()
    {
        return view('payment-requests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'service' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        PaymentRequest::create([
            'user_id' => auth()->id(),
            'service' => $request->service,
            'amount' => $request->amount,
            'reference_number' => strtoupper(uniqid('REF')),
        ]);

        return redirect()->route('payment-requests.index')->with('success', 'Payment request created successfully.');
    }

    public function show($id)
    {
        $paymentRequest = PaymentRequest::find($id);
        $paymentRequests = PaymentRequest::all(); // Ensure all payment requests are passed
        return view('payment-requests.index', compact('paymentRequests', 'paymentRequest'));
    }
}

