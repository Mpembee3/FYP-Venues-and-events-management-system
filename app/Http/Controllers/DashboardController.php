<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Venue;
use App\Models\Event;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Basic data
        $totalReservations = Reservation::count();
        //$newReservations = Reservation::where('created_at', '>', now()->subDay())->count();
        $newReservations = Reservation::where('created_at', '>', now()->subDay())
            ->where('admin_approval', 'pending')
            ->orWhere(function ($query) {
                $query->where('dvc_approval', 'pending')
                    ->where('admin_approval', 'approved');
            })
            ->count();



        $registeredVenues = Venue::count();
        $ongoingEvents = Event::where('status', 'ongoing')->count();
        $upcomingEvents = Event::where('status', 'upcoming')->count();
        $registeredUsers = User::where('role', 'user')->count();
        // $totalRevenue = Reservation::sum('amount'); // Assuming there's an 'amount' field in reservations
        $totalRevenue = Event::whereHas('payment', function($query) {
        $query->where('pro_approval', 'confirmed'); // Assuming 'status' is the field that marks payment confirmation
        })
        ->with(['payment.reservation.venue'])
        ->get()
        ->sum(function ($event) {
            return $event->payment->reservation->venue->Price;
        });

        $pendingPayments = Payment::where('payment_status', 'pending')->count();
        //$newPayments = Reservation::where('created_at', '>', now()->subDay())->count();
                $newPayments = Payment::where('created_at', '>', now()->subDay())
            ->where('pro_approval', 'pending')->count();


        // Pending approvals based on user role
        $pendingApprovals = 0;
        if ($user->role == 'admin') {
            $pendingApprovals = Reservation::where('admin_approval', 'pending')->count();
        } elseif ($user->role == 'DVC') {
            $pendingApprovals = Reservation::where('dvc_approval', 'pending')->count();
        } elseif ($user->role == 'PRO') {
            $pendingApprovals = Payment::where('pro_approval', 'pending')->count();
        }

        // $mostUsedVenues = Venue::withCount('reservations')
        //                        ->orderBy('reservations_count', 'desc')
        //                        ->take(5)
        //                        ->get(); // Top 5 most used venues
        // $reservationTrendLabels = ['January', 'February', 'March', 'April', 'May', 'June']; // Example labels
        // $reservationTrendData = [15, 20, 25, 30, 35, 40]; // Example data

        return view('dashboard', compact(
            'totalReservations', 'newPayments',
            'newReservations',
            'registeredVenues',
            'ongoingEvents',
            'upcomingEvents',
            'pendingApprovals', 'registeredUsers', 'totalRevenue', 'pendingPayments',
        ));
    }



    public function user()
    {
        $user = Auth::user();

        // Basic data
        $reservation = Reservation::where('user_id', $user->id)->get();
        $totalReservations = $reservation->count();
        //$newReservations = Reservation::where('created_at', '>', now()->subDay())->count();
        $registeredVenues = Venue::count();
        $userEvents = Event::whereHas('payment.reservation', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
        $ongoingEvents = $userEvents->where('status', 'ongoing')->count();
        $upcomingEvents = $userEvents->where('status', 'upcoming')->count();
        //$registeredUsers = User::where('role', 'user')->count();
        // $totalRevenue = Reservation::sum('amount'); // Assuming there's an 'amount' field in reservations
            $totalPayments = Event::whereHas('payment.reservation', function ($query) use ($user){
            $query->where('user_id', $user->id) // Ensure you filter by the current user's events
                    ->where('pro_approval', 'confirmed'); // Assuming 'pro_approval' is the field for payment confirmation
        })        
        ->with(['payment.reservation.venue'])
        ->get()
        ->sum(function ($event) {
            return $event->payment->reservation->venue->Price;
        });
            
        $pendingPayments = Payment::where('payment_status', 'pending')
                ->whereHas('reservation', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->count();

        $paymentApprovals = Payment::where('pro_approval', 'confirmed')
                ->whereHas('reservation', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->count();
        //$newPayments = Reservation::where('created_at', '>', now()->subDay())->count();


        // Pending approvals based on user role
        $status = $reservation->where('status', 'pending');
        $pendingApprovals = 0;
        if ($user->role == 'user' && $status == 'pending') {
            $pendingApprovals = Reservation::where('admin_approval', 'pending' || 'dvc_approval', 'pending')->count();
            
        } 

            return view('welcome', compact(
            'totalReservations', 'registeredVenues',
            'paymentApprovals',
            'ongoingEvents','totalPayments',
            'upcomingEvents',
            'pendingApprovals', 'pendingPayments',
        ));
    }

}
