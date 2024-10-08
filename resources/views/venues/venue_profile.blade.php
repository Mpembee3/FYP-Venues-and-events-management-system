@extends('layouts.sidebar')
@section('title', 'Venue Profile')
@section('content2')

          <!-- Content wrapper(venues to display in 3 columns) -->
          <div class="content-wrapper">
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="demo-inline-spacing">
        <h4 class="fw-bold py-3 mb-4">Venue description</h4>
    </div>
    <div class="card">
            <div class="card-body">

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
                    <a href="https://www.google.com/maps/search/?api=1&query={{ $venue->latitude }},{{ $venue->longitude }}" class="btn btn-secondary" target="_blank">Venue Location</a>
                </li>
                <li class="list-group-item">Price(Tshs): {{$venue->Price}}</li>
                <li class="list-group-item">Other description: {{$venue->Other_description}}</li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ url('see_venue_edit', $venue->id) }}" class="btn btn-primary">Edit</a>
                        </div>

                        <div class="col-md-6">
                            <form action="{{ route('see_venue_delete', $venue->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>
</div>
<!-- / Content -->



@endsection
