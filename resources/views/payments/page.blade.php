@extends('layouts.sidebar_user')
@section('title', 'Payments')

@section('content2')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">My Payments</h4>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- User View -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Venue</th>
                                <th>Event</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                @if($reservation->payment)
                                    <tr>
                                        <td>{{ $reservation->id }}</td>
                                        <td>{{ $reservation->venue->name }}</td>
                                        <td>{{ $reservation->event_id }}</td>
                                        <td>{{ $reservation->date }}</td>
                                        <td>
                                            @if($reservation->payment->pro_approval == 'confirmed')
                                                <span class="badge bg-success">Confirmed</span>
                                            @elseif($reservation->payment->payment_status == 'paid')
                                                <span class="badge bg-primary">Paid</span>  
                                            @elseif($reservation->payment->payment_status == 'failed')
                                                <span class="badge bg-danger">Failed</span>                                      
                                            @elseif($reservation->status == 'expired')
                                                <span class="badge bg-secondary">Expired</span>                                                         
                                            @else
                                                <span class="badge bg-label-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal{{ $reservation->id }}">
                                                View Payment
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Payment Modal -->
                                    <div class="modal fade" id="paymentModal{{ $reservation->id }}" tabindex="-1" aria-labelledby="paymentModalLabel{{ $reservation->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="paymentModalLabel{{ $reservation->id }}">Payment for Reservation #{{ $reservation->id }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">  
                                                    <p>Venue: {{ $reservation->venue->name }}</p>
                                                    <p>Event: {{ $reservation->event_id }}</p>
                                                    <p>Date: {{ $reservation->date }}</p>
                                                    <p>Amount(TZS): {{ $reservation->venue->Price }}</p>
                                                    <p>Control Number: {{ $reservation->payment->control_number }}</p>
                                                    @if($reservation->payment->payment_status == 'pending' && $reservation->status != 'expired')
                                                        <!-- Payment form -->
                                                        <form action="{{ route('payment.initialize', $reservation->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success">Pay Now</button>
                                                        </form>
                                                    @else
                                                        <p>Status: 
                                                            @if($reservation->payment->pro_approval == 'confirmed')
                                                                <span class="badge bg-success">Confirmed</span>
                                                            @elseif($reservation->payment->payment_status == 'paid')
                                                                <span class="badge bg-primary">Paid</span>  
                                                            @elseif($reservation->payment->payment_status == 'failed')
                                                                <span class="badge bg-danger">Failed</span>                                      
                                                            @elseif($reservation->status == 'expired')
                                                                <span class="badge bg-secondary">Expired</span>                                                            
                                                            @endif
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
