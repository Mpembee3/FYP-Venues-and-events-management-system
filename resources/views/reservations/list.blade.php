@extends('layouts.sidebar')
@section('title', 'Reservation requests')
@section('content2')

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">Reservation requests</h4>
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
          
        <!-- Admin View -->
        <div class="card">
  <div class="card-body">
    <div class="table-responsive text-nowrap">
    <div class="row mb-4">
          <!-- <div class="col-md-3">
            <!-- Filter
            <label for="sortStatus" class="form-label">Sort by Status</label>
            <select class="form-select" id="sortStatus" onchange="sortTable()">
              <option value="">Select Status</option>
              <option value="pending">Pending Approval</option>
              <option value="approved">Approved</option>
              <option value="rejected">Rejected</option>
            </select>
          </div>
          <div class="col-md-3">
            <label for="sortDate" class="form-label">Sort by Date</label>
            <select class="form-select" id="sortDate" onchange="sortTable()">
              <option value="">Select Date</option>
              <option value="asc">Ascending</option>
              <option value="desc">Descending</option>
            </select>
          </div> -->
        </div>
        <!-- Filter -->
      <table class="table table-bordered" id="reservationsTable">
        <thead>
          <tr>
            <th>S/N</th>
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
            @if ($reservation->date < now())
                <span class="badge bg-secondary">Expired</span>
            @elseif ($reservation->status == 'payment_required')
                <span class="badge bg-label-success me-1">Approved</span>
            @elseif ($reservation->admin_approval == 'pending')
                <span class="badge bg-label-warning me-1">Pending Admin Approval</span>
            @elseif ($reservation->admin_approval == 'rejected')
                <span class="badge bg-label-danger me-1">Rejected by Admin</span>
            @elseif ($reservation->dvc_approval == 'pending')
                <span class="badge bg-label-warning me-1">Pending DVC Approval</span>
            @elseif ($reservation->dvc_approval == 'rejected')
                <span class="badge bg-label-danger me-1">Rejected by DVC</span>
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
          @if ($reservation->date < now())
              <span class="badge bg-label-secondary me-1">Expired</span>
          @elseif ($reservation->status == 'payment_required')          
              <span class="badge bg-label-success me-1">Approved</span>
          @elseif ($reservation->admin_approval == 'pending')              
              <span class="badge bg-label-warning me-1">Pending Admin Approval</span>
          @elseif ($reservation->admin_approval == 'rejected')             
              <span class="badge bg-label-danger me-1">Rejected by Admin</span>
          @elseif ($reservation->dvc_approval == 'pending')              
              <span class="badge bg-label-warning me-1">Pending DVC Approval</span>
          @elseif ($reservation->dvc_approval == 'rejected')              
              <span class="badge bg-label-danger me-1">Rejected by DVC</span>
          @endif
          </p>
        </div>

        
        <div class="modal-footer">
        @if ($reservation->date >= now())
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

          <!--/ Bordered Table -->
          @endsection