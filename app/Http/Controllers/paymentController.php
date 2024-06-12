<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rave;
use App\Models\Payment;
use App\Models\Event;
use App\Models\Reservation;
use Flutterwave\Flutterwave;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function createPayment(Request $request, $reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);

        // Check if the reservation is approved for payment
        if ($reservation->admin_approval == 'approved' && $reservation->dvc_approval == 'approved') {
            $payment = Payment::create([
                'reservation_id' => $reservation->id,
                'control_number' => $this->generateControlNumber(), // Implement this method to generate a control number
                'status' => 'pending',
                'pro_approval' => 'pending'
            ]);

            return redirect()->route('payments.index')->with('success', 'Payment created successfully.');
        }

        return redirect()->route('reservations.index')->with('error', 'Reservation not approved for payment.');
    }

    private function generateControlNumber()
    {
        // Implement your control number generation logic here
        return 'CN' . time();
    }




    public function processPayment(Request $request)
    {
        $reservation = Reservation::findOrFail($request->input('reservation_id'));

        // Implement your payment processing logic here

        $reservation->status = 'paid';
        $reservation->save();

        return redirect()->route('user.reservations')->with('success', 'Payment successful and reservation approved.');
    }



    ///User's page
    public function showPaymentPage()
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)
                               ->with(['payment', 'venue']) // Eager load related models
                               ->get();
            
        // dd($reservations);
        //debug technique to show data in web

        
    return view('payments.page', compact('reservations'));
    }





        ////////////////////////////PRO HANDLING PAYMENTS//////////
    public function index()
    {
        $payments = Reservation::with('venue', 'payment')->get();

        return view('payments.admins', compact('payments'));
    }

        //method to display payments done
        // public function status(){
        //     $payments = Payment::all();
        //     return view('payments.admins', ["payments"=>$payments]);
        // }

    public function confirmPayment(Request $request, $paymentId)
    {
        if (Auth::user()->role == 'PRO') {
        $payment = Payment::findOrFail($paymentId);
        $payment->pro_approval = 'confirmed';
        $payment->payment_status = 'paid';
        $payment->save();
    
        // Create or update event
        $reservation = $payment->reservation;
        $user = $reservation->user;
        Event::updateOrCreate(
            ['payment_id' => $payment->id],
            [
                'status' => 'upcoming', // Assuming the default status is 'upcoming'
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
            // Send the email to the user
            // Mail::send('emails.approved', ['user' => $user, 'reservation' => $reservation], function ($message) use ($user) {
            //     $message->to($user->email)
            //             ->subject('Your Reservation is Approved');
            // });
            Mail::to($user->email)->send(new \App\Mail\Approved_reservation($user, $reservation));

             return redirect()->route('payments.index')->with('success', 'Payment confirmed successfully.');
        }

        return redirect()->route('payments.index')->with('error', 'Unauthorized action.');
    }




        ///Flutterwave integration starts below

        public function initialize(Request $request, $reservation_id)
        {
            $reservation = Reservation::findOrFail($reservation_id);
            
            $reference = Rave::generateReference();
            // Create a new payment record
            $payment = Payment::create([
                'reservation_id' => $reservation->id,
                'payment_status' => 'pending',
                'control_number' => $reference,
            ]);
    
            // Initialize payment
            $data = [
                'tx_ref' => $payment->control_number,
                'amount' => $reservation->venue->Price, // Assuming there's an 'amount' field in reservations
                'currency' => 'TZS',
                'payment_method' => 'mpesa',
                'redirect_url' => route('payment.callback'),
                'customer' => [
                    'email' =>Auth::user()->email,
                    'phone_number' => Auth::user()->phone, // Assuming there's a 'phone_number' field in users
                    'name' => Auth::user()->firstname . ' ' .Auth::user()->surname,
                ],
                'customizations' => [
                    'title' => 'UDSM Reservation Payment',
                    'description' => 'Payment for reservation ID: ' . $reservation->id
                ]


            ];
    
            $paymentResponse = Rave::initializePayment($data);
    
            if ($paymentResponse['status'] !== 'success') {
                return redirect()->back()->with('error', 'Failed to initialize payment.');
            }
    
            return redirect($paymentResponse['data']['link']);
        }
    
        public function callback(Request $request)
        {
            $status = $request->payment_status;
            $txRef = $request->tx_ref;
            $transactionID = $request->transaction_id;
            
    
            $payment = Payment::where('control_number', $txRef)->firstOrFail();
            
            // Verify the transaction
            $data = Rave::verifyTransaction($transactionID);

            if ($data['status'] === 'success') {
                $payment->payment_status = 'paid';
                $payment->save();
    
                return redirect()->route('payment.page')->with('success', 'Payment successful.');
            } else {
                $payment->payment_status = 'failed';
                $payment->save();
    
                return redirect()->route('payment.page')->with('error', 'Payment failed.');
            }
        }
                


}
