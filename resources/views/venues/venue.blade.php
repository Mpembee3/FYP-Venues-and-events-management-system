@extends('layouts.sidebar')
@section('title', 'Venues')
@section('content2')
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

        <!-- Content wrapper(venues to display in 2 columns) -->
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="demo-inline-spacing">
                    <h4 class="fw-bold py-3 mb-4">Registered venues</h4>
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    
                </div>
                <div class="card">
            <div class="card-body">
            <a href="{{ url('see_venue_register') }}" class="btn rounded-pill btn-info">Add new</a>
            <h4 class="fw-bold py-3 mb-2"></h4>
                <div class="row">
                    @foreach ($data as $venue)
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
                                <a href="{{ url('see_venue_profile', $venue->id) }}" class="btn rounded-pill btn-primary">Details</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- / Content -->
        </div>
    </div>
</div>
</div>
</div>


@endsection