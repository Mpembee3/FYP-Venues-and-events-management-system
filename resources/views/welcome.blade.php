@extends('layouts.sidebar_user')
@section('title', 'Welcome')
@section('content2')
<!-- Layout wrapper -->

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <!-- Welcome back section -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Welcome back!!</h5>
                                <!-- Add any additional content for the welcome back section here -->
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img
                                    src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}"
                                    height="140"
                                    alt=""
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
  
                    
            <!-- / Content -->
@endsection