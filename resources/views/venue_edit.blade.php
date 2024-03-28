@extends('layouts.sidebar')
@section('content2')

        <!-- venue registration form credintials) -->
        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">Venue Edit</h4>
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
                    <form action="{{ route('see_venue_update', $venue->id) }}" method="post">
                    @method('PUT')  
                    @csrf                    
                                                               
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Venue name</label>
                        <input type="text" 
                            name="name" 
                            class="form-control" 
                            value = "{{ $venue->name }}"
                            id="basic-default-fullname" 
                             />
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Events</label>
                        <input type="text" 
                            name="event" 
                            class="form-control" 
                            id="basic-default-fullname" 
                            value = "{{ $venue->event }}" />
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-company">Capacity</label>
                        <input type="number" 
                            name="capacity" 
                            class="form-control" 
                            id="basic-default-company" 
                            value = "{{ $venue->capacity }}" />
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-price">Price (Tshs)</label>
                        <div class="input-group input-group-merge">
                          <input
                            type="number"
                            name="price"
                            id="basic-default-price"
                            class="form-control"
                            value = "{{ $venue->Price }}"
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
                            value = "{{ $venue->latitude }}"
                            aria-label="Latitude"
                          />
                          <input
                            type="text"
                            name="longitude"
                            id="basic-default-longitude"
                            class="form-control"
                            value = "{{ $venue->longitude }}"
                            aria-label="Longitude"
                          />
                        </div>
                      </div>
                    <!-- <div class="mb-3">
                      <label class="form-label" for="basic-default-image">Venue image</label>
                      <div class="input-group">
                        <input
                          type="file"
                          name="image"
                          class="form-control"
                          id="inputGroupFile04"
                          value = "{{ $venue->image }}"
                          aria-describedby="inputGroupFileAddon04"
                          aria-label="Upload"
                        />
                        <button class="btn btn-outline-primary" type="button" id="inputGroupFileAddon04">Upload</button>
                      </div>
                    </div> -->
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-message">Other descriptions</label>
                        <textarea
                          id="basic-default-message"
                          name="description"
                          class="form-control"
                          value = "{{ $venue->description }}"
                        ></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          <!-- / Content -->


@endsection