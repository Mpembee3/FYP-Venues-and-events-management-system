@extends('layouts.sidebar')
@section('title', 'Venue Registration')
@section('content2')

        <!-- venue registration form credintials) -->
        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">Venue Registration</h4>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}

                </div>
            @endif

            <!-- Basic Layout -->
            <div class="row">
              <div class="col-xl">
                <div class="card mb-4">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Venue details</h5>                    
                  </div>
                  <div class="card-body">
                    <form action="{{ route('create_venue') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Venue name</label>
                        <input type="text" name="name" class="form-control" id="basic-default-fullname" placeholder="Enter venue name" />
                      </div>

                      <!-- events selection -->
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Events</label>
                        <input type="text" name="event" class="form-control" id="basic-default-fullname" placeholder="Enter all allowed activities" />
                      </div>

                    <!-- events selection, i can modify later-->

                      <div class="mb-3">
                        <label class="form-label" for="basic-default-company">Capacity</label>
                        <input type="number" name="capacity" class="form-control" id="basic-default-company" placeholder="Enter accomodating capacity" />
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-price">Price (Tshs)</label>
                        <div class="input-group input-group-merge">
                          <input
                            type="number"
                            name="price"
                            id="basic-default-price"
                            class="form-control"
                            placeholder="Enter price in Tshs"
                            aria-label="Enter price in Tshs"
                            aria-describedby="basic-default-price2"
                            step="1"
                          />
                          <span class="input-group-text" id="basic-default-price2">Tshs</span>
                        </div>
                      </div>
                      
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-location">Location</label>
                        <div class="input-group">
                          <input
                            type="text"
                            name="latitude"
                            id="basic-default-latitude"
                            class="form-control"
                            placeholder="Latitude"
                            aria-label="Latitude"
                          />
                          <input
                            type="text"
                            name="longitude"
                            id="basic-default-longitude"
                            class="form-control"
                            placeholder="Longitude"
                            aria-label="Longitude"
                          />
                        </div>
                      </div>
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-image">Venue image</label>
                      <div class="input-group">
                        <input
                          type="file"
                          name="image"
                          class="form-control"
                          id="basic-default-image"
                          aria-describedby="inputGroupFileAddon04"
                          aria-label="Upload"
                        />
                        
                      </div>
                    </div>
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-message">Other descriptions</label>
                        <textarea
                          id="basic-default-message"
                          name="description"
                          class="form-control"
                          placeholder="Activities, resources etc"
                        ></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          <!-- / Content -->


@endsection