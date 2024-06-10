@extends('layouts.sidebar_user')
@section('title', 'Venues')
@section('content2')
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Content wrapper(venues to display in 2 columns) -->
        <div class="content-wrapper">
            <!-- Filter -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="demo-inline-spacing">
                    <h4 class="fw-bold py-3 mb-4">Filter Venues</h4>
                    <!-- Filter form -->
                    <form action="{{ route('venue_explorer') }}" method="GET" class="mb-4">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="capacity" class="form-label">Capacity</label>
                                <input type="text" class="form-control" id="capacity" name="capacity">
                            </div>
                            <div class="col-md-4">
                                <label for="event" class="form-label">Event Type</label>
                                <select class="form-select" id="event" name="event">
                                    <option value="">Select Event Type</option>
                                    <option value="Seminar">Seminar</option>
                                    <option value="Workshop">Workshop</option>
                                    <option value="Meeting">Meeting</option>
                                </select>
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- / Filter -->

            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="demo-inline-spacing">
                    <h4 class="fw-bold py-3 mb-4">Available venues</h4>
                </div>
                @if ($venues->isEmpty())
                        <div class="alert alert-info">No venues found.</div>
                @else
                <div class="row">
                    @foreach ($venues as $venue)
                    <div class="col-md-6 mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Image -->
                                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            @if($venue->image)
                                            <img src="{{ asset($venue->image) }}" class="img-fluid" alt="Venue Image">
                                            @else
                                            <p>No image available</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Details -->
                                <h5 class="my-4">{{ $venue->name }}</h5>
                                <a href="{{ url('venue_view', $venue->id) }}" class="btn rounded-pill btn-primary">Details</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- / Content -->
        </div>
        @endif
    </div>
</div>




@endsection