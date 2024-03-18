@extends('layouts.sidebar')
@section('content2')

          <!-- Content wrapper(venues to display in 3 columns) -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="demo-inline-spacing">
                <h4 class="fw-bold py-3 mb-4">Venue description</h4>
              </div>
              <div class="row">
                <!-- Image Carousel -->
                <div class="col-md">
                  <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="d-block flex-column" src="../assets/img/elements/13.jpg" alt="First slide" />

                      </div>
                    </div>
                  </div>
                </div>
 <!-- Venue Details -->
                <div class="col-md">
                  <ul class="list-group">
                    <li class="list-group-item">Name: Venue 1</li>
                    <li class="list-group-item">Capacity: 100</li>
                    <li class="list-group-item">
                      Location: <a href="#" class="btn btn-outline-secondary">Venue Location</a>
                    </li>
                    <li class="list-group-item">Price: Tshs 1000000</li>
                    <li class="list-group-item">Other descriptions: </li>
                    <li class="list-group-item">
                      <div class="row">
                        <div class="col-md-6">
                          <button type="button" class="btn btn-primary">
                            <i class="bx bx-edit-alt me-1"></i> Edit
                          </button>
                        </div>
                        <div class="col-md-6">
                          <button type="button" class="btn btn-danger">
                            <i class="bx bx-trash me-1"></i> Delete
                          </button>
                        </div>
                      </div>
                    </li>
                  
                  </ul>
                </div>
              </div>
            </div>
          </div>
          
            <!-- / Content -->


@endsection