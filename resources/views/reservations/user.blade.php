@extends('layouts.sidebar_user')
@section('title', 'My Reservations')
use Carbon\Carbon;
@section('content2')



<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">My reservations</h4>
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
          
                <!-- User View -->
        <div class="card">
        <div class="card-body">
            <div class="table-responsive text-nowrap">
            <div class="row mb-4">

  
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Venue</th>
                <th>Event</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->venue->name }}</td>
                    <td>{{ $reservation->event_id }}</td>
                    <td>{{ $reservation->date }}</td>
                    <td>
                        @if (Carbon\Carbon::parse($reservation->date . ' ' . $reservation->end_time) < now())
                            <span class="badge bg-secondary">Expired</span>
                            <!-- display first the paid details and no more  -->
                        @elseif($reservation->status == 'withdrawn')
                            <span class="badge bg-secondary">Withdrawn</span>    
                        @elseif ($reservation->status == 'pending_payment')
                            <span class="badge bg-success">Approved</span>    
                        @elseif ($reservation->admin_approval == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif ($reservation->admin_approval == 'rejected')
                            <span class="badge bg-danger">Rejected</span>
                        @elseif ($reservation->dvc_approval == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif ($reservation->dvc_approval == 'rejected')
                            <span class="badge bg-danger">Rejected by DVC</span>
                        @elseif ($reservation->dvc_approval == 'approved')
                            <span class="badge bg-info">Payment Required</span>                                        

                        @endif
                    </td>
                    <td>
                        @if (Carbon\Carbon::parse($reservation->date . ' ' . $reservation->end_time) < now())
                            <span class="badge bg-secondary">Expired</span>
                        @else
                            @if ($reservation->status == 'withdrawn')
                                <span class="badge bg-secondary">Withdrawn</span>
                              
                            @else
                                @if ($reservation->dvc_approval == 'approved')
                                    <a href="{{ route('payment.page') }}" class="btn btn-primary">Make payment</a>
                                @endif
                            @if ($reservation->admin_approval == 'pending' && $reservation->dvc_approval == 'pending')
                                <form action="{{ route('reservations.withdraw', $reservation->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Withdraw</button>
                                </form>
                            @endif
                            
                          @endif
                        @endif  
                    </td>
                </tr>
             @endforeach
        </tbody>
    </table>


         </div>
        </div>
      </div>
    </div>
  </div>
  </div>



@endsection
