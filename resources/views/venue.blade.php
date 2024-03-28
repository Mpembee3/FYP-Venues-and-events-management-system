@extends('layouts.sidebar')
@section('content2')
 <!-- Layout wrapper -->
 <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
             
          <!-- Content wrapper(venues to display in 3 columns) -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="demo-inline-spacing">
              <h4 class="fw-bold py-3 mb-4"> Registered venues</h4>
              @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
              <a href="{{ url('see_venue_register') }} " class="btn rounded-pill btn-primary">Add new</a>
                </div>
              <div class="row">
                @foreach ($data as $venue)
                  <!-- Venue 1-->
                <div class="col-md">
                  <h5 class="my-4">{{$venue->name}}</h5>
                  <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">                    
                    <ol class="carousel-indicators">
                      <a href="{{ url('see_venue_profile', $venue->id)  }}" class="btn rounded-pill btn-primary">Details</a>                  
                    </ol>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="d-block w-100" src="../assets/img/elements/13.jpg" alt="First slide" />                       
                      </div>                      
                    </div>                    
                  </div>
                </div>
                @endforeach
               

              </div>
            </div>
            <!-- / Content -->

@endsection