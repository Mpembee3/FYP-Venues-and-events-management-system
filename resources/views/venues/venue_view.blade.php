@extends('layouts.sidebar_user')
@section('title', 'Venue Profile')
@section('content2')

          <!-- Content wrapper(venues to display in 3 columns) -->
          <div class="content-wrapper">
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
            @if(isset($availabilityMessage))
                <div class="alert alert-{{ $venue->isAvailable($date, $start_time, $end_time) ? 'success' : 'danger' }}" role="alert">
                    {{ $availabilityMessage }}
                    @if($venue->isAvailable($date, $start_time, $end_time))
                        <a href="{{ route('reservation.create', ['venue_id' => $venue->id, 'date' => $date, 'start_time' => $start_time, 'end_time' => $end_time]) }}" class="btn btn-success">Reserve</a>
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
                <li class="list-group-item">Price(Tshs): {{$venue->Price}}</li>
                <li class="list-group-item">Other description: {{$venue->Other_description}}</li> 

                          <!-- Venue Availability Filter -->
                <li class="list-group-item">Check Venue Availability(3 months in advance)
                    <form action="{{ route('check_availability', ['id' => $venue->id]) }}" method="GET">
                        @csrf
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
                        <button type="submit" class="btn btn-primary">Check Availability</button>
                    </form>
                </li>  
                
                

                
            </ul>
        </div>
    </div>



            <!-- Venue Availability Filter
            <div class="row mt-4">
                <div class="col-md-6">
                    <h5>Check Venue Availability(3 months in advance)</h5>
                    <form action="{{ route('check_availability', ['id' => $venue->id]) }}" method="GET">
                        @csrf
                        <div class="mb-3">
                            <label for="date" class="form-label">Event Date</label>
                            <input type="date" class="form-control" id="date" name="date" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+3 months')) }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Check Availability</button>
                    </form>
                </div>
            </div> -->

            <!-- Available Slots
            @if(isset($availabilityMessage))
                <div class="alert alert-{{ $venue->isAvailable($date) ? 'success' : 'danger' }}" role="alert">
                    {{ $availabilityMessage }}
                    <a href="{{ route('reservation.create', ['venue_id' => $venue->id, 'date' => $date]) }}" class="btn btn-success">Reserve</a>
                </div>
            @endif -->

            <!-- Reserve button -->
           

            </div>


<!-- / Content -->



@endsection
