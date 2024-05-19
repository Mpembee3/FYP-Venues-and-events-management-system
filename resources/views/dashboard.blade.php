@extends('layouts.sidebar')
@section('title', 'Admin dashboard')
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
                                <h5 class="card-title text-primary">Login as Admin!!</h5>
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
    <!-- Small segments in a row -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-4 col-md-4 order-1">
                <!-- Segment 1 -->
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img
                                            src="{{ asset('assets/img/icons/unicons/cc-success.png') }}"
                                            alt=""
                                            class="rounded"
                                        />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Registered venues</span>
                                <h3 class="card-title mb-2">8 halls</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img
                                            src="{{ asset('assets/img/icons/unicons/chart-success.png') }}"
                                            alt=""
                                            class="rounded"
                                        />
                                    </div>
                                </div>
                                <span>Upcoming events</span>
                                <h3 class="card-title text-nowrap mb-1">12 events</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                <!-- Segment 3 -->
                <div class="row">
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/img/icons/unicons/wallet.png') }}" alt="Credit Card" class="rounded" />
                                    </div>
                                </div>
                                <span class="d-block mb-1">Total revenues</span>
                                <h3 class="card-title text-nowrap mb-2">Tshs</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/img/icons/unicons/cc-primary.png') }}" alt="" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Total Reservations</span>
                                <h3 class="card-title mb-2">50 events</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


  
                    
            <!-- / Content -->
@endsection