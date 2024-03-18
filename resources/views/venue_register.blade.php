@extends('layouts.sidebar')
@section('content2')

        <!-- venue registration form credintials) -->
        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">Venue Registration</h4>

            <!-- Basic Layout -->
            <div class="row">
              <div class="col-xl">
                <div class="card mb-4">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Venue details</h5>                    
                  </div>
                  <div class="card-body">
                    <form>
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Venue name</label>
                        <input type="text" class="form-control" id="basic-default-fullname" placeholder="" />
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-company">Capacity</label>
                        <input type="number" class="form-control" id="basic-default-company" placeholder="Enter accomodating capacity" />
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-price">Price (Tshs)</label>
                        <div class="input-group input-group-merge">
                          <input
                            type="number"
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
                            id="basic-default-latitude"
                            class="form-control"
                            placeholder="Latitude"
                            aria-label="Latitude"
                          />
                          <input
                            type="text"
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
                          class="form-control"
                          id="inputGroupFile04"
                          aria-describedby="inputGroupFileAddon04"
                          aria-label="Upload"
                        />
                        <button class="btn btn-outline-primary" type="button" id="inputGroupFileAddon04">Upload</button>
                      </div>
                    </div>
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-message">Other descriptions</label>
                        <textarea
                          id="basic-default-message"
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