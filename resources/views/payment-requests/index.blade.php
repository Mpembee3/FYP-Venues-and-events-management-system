@extends('layouts.sidebar')
@section('content2')

<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
         <h4 class="fw-bold py-3 mb-4">Payments requests</h4>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Button to Open the Create Payment Request Modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createPaymentRequestModal">
        Create Payment Request
    </button>
    <div class="card">
  <div class="card-body">
    <div class="table-responsive text-nowrap">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Reference Number</th>
                <th>Service</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paymentRequests as $request)
                <tr>
                    <td>{{ $request->id }}</td>
                    <td>{{ $request->reference_number }}</td>
                    <td>{{ $request->service }}</td>
                    <td>{{ $request->amount }}</td>
                    <td>{{ ucfirst($request->status) }}</td>
                    <td>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#paymentRequestModal{{ $request->id }}">
                            View
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
</div>
</div>

@foreach($paymentRequests as $request)
<!-- Payment Request Details Modal -->
<div class="modal fade" id="paymentRequestModal{{ $request->id }}" tabindex="-1" aria-labelledby="paymentRequestModalLabel{{ $request->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentRequestModalLabel{{ $request->id }}">Payment Request Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">                
                <p><strong>Reference Number:</strong> {{ $request->reference_number }}</p>
                <p><strong>Service:</strong> {{ $request->service }}</p>
                <p><strong>Amount:</strong> {{ $request->amount }}</p>
                <p><strong>Status:</strong> {{ ucfirst($request->status) }}</p>
                <p><strong>Admin Status:</strong> {{ ucfirst($request->admin_status) }}</p>
                <p><strong>DVC Status:</strong> {{ ucfirst($request->dvc_status) }}</p>
                <p><strong>PRO Status:</strong> {{ ucfirst($request->pro_status) }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @if(auth()->user()->role == 'admin' && $request->admin_status == 'pending')
                    <form action="{{ route('payment-requests.approve.admin', $request->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">Approve as Admin</button>
                    </form>
                @endif

                @if(auth()->user()->role == 'dvc' && $request->admin_status == 'approved' && $request->dvc_status == 'pending')
                    <form action="{{ route('payment-requests.approve.dvc', $request->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">Approve as DVC</button>
                    </form>
                @endif

                @if(auth()->user()->role == 'pro' && $request->dvc_status == 'approved' && $request->pro_status == 'pending')
                    <form action="{{ route('payment-requests.approve.pro', $request->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">Approve as PRO</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Create Payment Request Modal -->
<div class="modal fade" id="createPaymentRequestModal" tabindex="-1" aria-labelledby="createPaymentRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPaymentRequestModalLabel">Create Payment Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('payment-requests.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="service">Service</label>
                        <input type="text" name="service" id="service" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" name="amount" id="amount" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>






@endsection
