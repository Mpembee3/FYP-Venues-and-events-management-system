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
        $newReservations = Reservation::where('created_at', '>', now()->subDay())->count();
        $registeredVenues = Venue::count();
        $ongoingEvents = Event::where('status', 'ongoing')->count();
        $upcomingEvents = Event::where('status', 'upcoming')->count();
        $registeredUsers = User::where('role', 'user')->count();
        // $totalRevenue = Reservation::sum('amount'); // Assuming there's an 'amount' field in reservations
        $totalRevenue = Event::with(['payment.reservation'])
            ->get()
            ->sum(function ($totalRevenue) {
                $price = $totalRevenue->payment->reservation->venue->Price;
                $totalRevenue->price;
                $totalRevenue->save();

            });

        $pendingPayments = Payment::where('payment_status', 'pending')->count();
        $newPayments = Reservation::where('created_at', '>', now()->subDay())->count();


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
}
