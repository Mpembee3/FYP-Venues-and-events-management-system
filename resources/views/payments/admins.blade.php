@extends('layouts.sidebar')
@section('title', 'Payments')

@section('content2')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Reservation Payments</h4>
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
        
        <!-- Admin View -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped table-hover datatable" id="table">
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
                            @foreach ($payments as $reservation)
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
                                                    
                                                    @if(Auth::user()->role == 'PRO')
                                                        <!-- Payment form for PRO to confirm -->
                                                        @if($reservation->payment->payment_status == 'paid' && $reservation->payment->pro_approval == 'pending')
                                                            <!-- Payment form for PRO to confirm -->
                                                            <form action="{{ route('payment.confirm', $reservation->payment->id) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success">Confirm</button>
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
