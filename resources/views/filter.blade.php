@extends('layouts.sidebar_user')
@section('title', 'User')
@section('content2')
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Content wrapper (event organizer landing page) -->
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="demo-inline-spacing">
                    <h4 class="fw-bold py-3 mb-4">Find a Venue</h4>
                    <form action="{{ url('see_filter_venues') }}" method="GET">
                        <div class="mb-3">
                            <label class="form-label">Select Your Event:</label>
                            <select class="form-select" name="event" id="event">
                                <option value="" selected disabled>Select an event</option>
                                <option value="seminar">Seminar</option>
                                <option value="workshop">Workshop</option>
                                <option value="meeting">Meeting</option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="capacity">Capacity</label>
                            <input type="number" name="capacity" class="form-control" id="capacity" placeholder="Enter capacity">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="availability_date">Event Date</label>
                            <input type="date" name="availability_date" class="form-control" id="availability_date" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+3 months')) }}" placeholder="Select availability date">
                        </div>
                        <button type="submit" class="btn rounded-pill btn-primary">Search</button>
                    </form>


                <!-- Filter results here -->
                    <div class="mt-5">
                        @if(isset($venues))
                            <h4 class="fw-bold mb-3">Results</h4>
                            @if(count($venues) > 0)
                                <div class="list-group">
                                    @foreach($venues as $venue)
                                        <a href="{{ url('venue_details', $venue->id) }}" class="list-group-item list-group-item-action">
                                            <h5 class="mb-1">{{ $venue->name }}</h5>
                                            <p class="mb-1">Capacity: {{ $venue->capacity }}</p>
                                            <p class="mb-1">Availability: {{ $venue->availability_date }}</p>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-info" role="alert">
                                    No venues found
                                </div>
                            @endif
                        @endif
                    </div>

                <!-- Filter results end here -->



                </div>
            </div>
        </div>
    </div>
</div>


@endsection

