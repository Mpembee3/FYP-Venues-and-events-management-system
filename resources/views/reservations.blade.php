@extends('layouts.sidebar')
@section('title', 'Reservation requests')
@section('content2')

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">Reservation requests</h4>
          
        <!-- Admin View -->
@if(Auth::user()->role == 'admin')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Venue</th>
                            <th>Event</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $reservation)
                            @if ($reservation->admin_approval == 'pending')
                                <tr>
                                    <td>{{ $reservation->id }}</td>
                                    <td>{{ $reservation->user->name }}</td>
                                    <td>{{ $reservation->venue->name }}</td>
                                    <td>{{ $reservation->event }}</td>
                                    <td>{{ $reservation->user->email }}</td>
                                    <td>{{ $reservation->user->phone }}</td>
                                    <td><span class="badge bg-label-warning me-1">Pending</span></td>
                                    <td>
                                        <form action="{{ route('reservations.approve', $reservation->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Approve</button>
                                        </form>
                                        <form action="{{ route('reservations.reject', $reservation->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif

          <!--/ Bordered Table -->
          @endsection