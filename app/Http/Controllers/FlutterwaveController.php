<?php

namespace App\Http\Controllers;

use KingFlamez\Rave\Facades\Rave as Flutterwave;
use Illuminate\Http\Request;

class FlutterwaveController extends Controller
{
    /**
     * Initialize Rave payment process with M-Pesa
     * @return void
     */
    public function initialize(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string'
        ]);

        // Generate a payment reference
        $reference = Flutterwave::generateReference();

        // Enter the details of the payment
        $data = [
            'amount' => 1500, // Example amount
            'email' => $request->email,
            'phone_number' => $request->phone,
            'tx_ref' => $reference,
            'currency' => 'KES', // Kenyan Shillings for M-Pesa
            'redirect_url' => route('callback'),
            'customer' => [
                'email' => $request->email,
                'phone_number' => $request->phone,
                'name' => $request->name
            ],
            'customizations' => [
                'title' => 'Movie Ticket',
                'description' => 'Buy Movie Tickets',
            ]
        ];

        $charge = Flutterwave::payments()->mpesa($data);

        if ($charge['status'] === 'success') {
            // Handle the charge response
            return redirect()->route('callback')->with('transactionID', $charge['data']['id']);
        } else {
            return back()->with('error', 'Failed to initialize payment.');
        }
    }

    /**
     * Obtain Rave callback information
     * @return void
     */
    public function callback(Request $request)
    {
        // Retrieve the transaction ID from the session or request
        $transactionID = session('transactionID') ?? $request->transactionID;

        if ($transactionID) {
            $data = Flutterwave::verifyTransaction($transactionID);

            // Handle the verified transaction data
            // You can update your database, send confirmation emails, etc.
            if ($data['status'] === 'success') {
                // Handle successful transaction
                return view('payment_success', ['data' => $data]);
            } else {
                // Handle failed transaction
                return view('payment_failed', ['data' => $data]);
            }
        } else {
            return back()->with('error', 'Transaction ID not found.');
        }
    }
}
