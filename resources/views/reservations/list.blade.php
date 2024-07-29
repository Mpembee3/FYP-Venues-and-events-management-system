@extends('layouts.sidebar')

@section('title', 'Reservation Requests')

@section('content2')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Reservation Requests</h4>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped table-hover" id="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Event Organizer</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->id }}</td>
                                    <td>{{ $reservation->user->firstname }} {{ $reservation->user->surname }}</td>
                                    <td>{{ $reservation->date }}</td>
                                    <td>
                                        @php
                                            $reservationDateTime = Carbon\Carbon::parse($reservation->date . ' ' . $reservation->end_time);
                                        @endphp

                                        @if ($reservationDateTime < now())
                                            <span class="badge bg-secondary">Expired</span>
                                        @elseif ($reservation->status == 'payment_required')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif ($reservation->admin_approval == 'pending')
                                            <span class="badge bg-warning">Pending Admin Approval</span>
                                        @elseif ($reservation->admin_approval == 'rejected')
                                            <span class="badge bg-danger">Rejected by Admin</span>
                                        @elseif ($reservation->dvc_approval == 'pending')
                                            <span class="badge bg-warning">Pending DVC Approval</span>
                                        @elseif ($reservation->dvc_approval == 'rejected')
                                            <span class="badge bg-danger">Rejected by DVC</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservationModal{{ $reservation->id }}">
                                            View Reservation
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @foreach ($reservations as $reservation)
            <div class="modal fade" id="reservationModal{{ $reservation->id }}" tabindex="-1" aria-labelledby="reservationModalLabel{{ $reservation->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="reservationModalLabel{{ $reservation->id }}">Reservation Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Event Organizer:</strong> {{ $reservation->user->firstname }} {{ $reservation->user->surname }}</p>
                            <p><strong>Venue:</strong> {{ $reservation->venue->name }}</p>
                            <p><strong>Event:</strong> {{ $reservation->event_id }}</p>
                            <p><strong>Email:</strong> {{ $reservation->user->email }}</p>
                            <p><strong>Contact:</strong> {{ $reservation->user->phone }}</p>
                            <p><strong>Date:</strong> {{ $reservation->date }}</p>
                            <p><strong>Time:</strong> {{ $reservation->start_time }} - {{ $reservation->end_time }}</p>
                            <p><strong>Status:</strong>
                                @if ($reservationDateTime < now())
                                    <span class="badge bg-secondary">Expired</span>
                                @elseif ($reservation->status == 'payment_required')
                                    <span class="badge bg-success">Approved</span>
                                @elseif ($reservation->admin_approval == 'pending')
                                    <span class="badge bg-warning">Pending Admin Approval</span>
                                @elseif ($reservation->admin_approval == 'rejected')
                                    <span class="badge bg-danger">Rejected by Admin</span>
                                @elseif ($reservation->dvc_approval == 'pending')
                                    <span class="badge bg-warning">Pending DVC Approval</span>
                                @elseif ($reservation->dvc_approval == 'rejected')
                                    <span class="badge bg-danger">Rejected by DVC</span>
                                @endif
                            </p>
                        </div>
                        <div class="modal-footer">
                            @if ($reservationDateTime >= now())
                                @if ($user->role == 'admin' && $reservation->admin_approval == 'pending')
                                    <form action="{{ route('reservations.approve', $reservation->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Approve</button>
                                    </form>
                                    <form action="{{ route('reservations.reject', $reservation->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Reject</button>
                                    </form>
                                @elseif ($user->role == 'DVC' && $reservation->admin_approval == 'approved' && $reservation->dvc_approval == 'pending')
                                    <form action="{{ route('reservations.approve', $reservation->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Approve</button>
                                    </form>
                                    <form action="{{ route('reservations.reject', $reservation->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Reject</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
