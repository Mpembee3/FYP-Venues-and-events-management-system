@extends('layouts.sidebar_user')
@section('title', 'Venue Profile')
@section('content2')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        @if(session('availabilityMessage'))
            <div class="alert alert-{{ session('availabilityMessage') == 'The venue is available for the selected time slot.' ? 'success' : 'danger' }}" role="alert">
                {{ session('availabilityMessage') }}
                @if(session('availabilityMessage') == 'The venue is available for the selected time slot.')
                    <a href="{{ route('reservation.create', [
                        'venue_id' => $venue->id, 
                        'date' => session('date'), 
                        'start_time' => session('start_time'), 
                        'end_time' => session('end_time')
                    ]) }}" class="btn btn-success">Reserve</a>
                @endif
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="demo-inline-spacing">
            <h4 class="fw-bold py-3 mb-4">Venue description</h4>
        </div>

        <div class="row">
            <!-- Image Carousel -->
            <div class="col-md-6">
                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            @if($venue->image)
                            <img src="{{ asset($venue->image) }}" class="d-block w-100" alt="Venue Image">
                            @else
                            <p>No image available</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Venue Details -->
            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item">Name: {{$venue->name}}</li>
                    <li class="list-group-item">Event(s): {{$venue->event}}</li>
                    <li class="list-group-item">Capacity: {{$venue->capacity}}</li>
                    <li class="list-group-item">Location:
                        <a href="https://www.google.com/maps/search/?api=1&query={{ $venue->latitude }},{{ $venue->longitude }}" 
                        class="btn btn-secondary" target="_blank">Venue Location</a>
                    </li>
                    <li class="list-group-item">Price(TZS): {{$venue->Price}}</li>
                    <li class="list-group-item">Other description: {{$venue->Other_description}}</li> 

                    <!-- Button to trigger modal -->
                    <li class="list-group-item">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#availabilityModal">
                            Check Venue Availability
                        </button>
                    </li>            
                </ul>
            </div>
        </div>       
    </div>
</div>

<!-- Availability Modal -->
<div class="modal fade" id="availabilityModal" tabindex="-1" aria-labelledby="availabilityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('check_availability', ['id' => $venue->id]) }}" method="GET">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="availabilityModalLabel">Check Venue Availability (3 months in advance)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date" class="form-label">Event Date</label>
                        <input type="date" class="form-control" id="date" name="date" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+3 months')) }}" required>
                    </div>
                    <div class="mb-3 row">
                        <label for="start_time" class="col-sm-3 col-form-label">Start Time</label>
                        <div class="col-sm-9">
                            <input type="time" class="form-control" id="start_time" name="start_time" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="end_time" class="col-sm-3 col-form-label">End Time</label>
                        <div class="col-sm-9">
                            <input type="time" class="form-control" id="end_time" name="end_time" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Check Availability</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
