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
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Welcome back {{ Auth::user()->firstname }} {{ Auth::user()->surname }}!!</h5>
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


    <!-- Main Dashboard Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-6 col-md-6 order-1">
                <!-- Segment 1 -->
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/img/icons/unicons/cc-success.png') }}" alt="" class="rounded"/>
                                    </div>
                                </div>
                                <span>Payments</span>
                                <h4 class="card-title mb-2">{{ $paymentApprovals }} Approved</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/img/icons/unicons/wallet.png') }}" alt="Credit Card" class="rounded"/>
                                    </div>
                                </div>
                                <span>Total Payments</span>
                                <h4 class="card-title text-nowrap mb-1"> TZS</h4>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/img/icons/unicons/chart-primary.png') }}" alt="" class="rounded"/>
                                    </div>
                                </div>
                                <!-- find useful info for user -->
                                <span>Venues </span>
                                <h4 class="card-title text-nowrap mb-1">{{ $registeredVenues }} Halls </h4>                       
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/img/icons/unicons/chart-primary.png') }}" alt="" class="rounded"/>
                                    </div>
                                </div>
                                <span>Pending payments</span>
                                <h4 class="card-title text-nowrap mb-1">{{ $pendingPayments }} payments</h4> 
                                <!-- <span class="text-muted">New: </span>                       -->
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-lg-6 col-md-6 order-2">
                <!-- Segment 2 -->
                <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/img/icons/unicons/chart-success.png') }}" alt="" class="rounded"/>
                                    </div>
                                </div>
                                <span>Upcoming Events</span>
                                <h4 class="card-title text-nowrap mb-1">{{ $upcomingEvents }} events</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/img/icons/unicons/cc-primary.png') }}" alt="" class="rounded"/>
                                    </div>
                                </div>
                                <span>Ongoing Events</span>
                                <h4 class="card-title text-nowrap mb-1">{{ $ongoingEvents }} events</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/img/icons/unicons/cc-primary.png') }}" alt="" class="rounded"/>
                                    </div>
                                </div>
                                <span>Total Reservations</span>
                                <h4 class="card-title text-nowrap mb-1">{{ $totalReservations }} requests</h4>
                                <!-- <span class="text-muted">New: </span> -->
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/img/icons/unicons/wallet.png') }}" alt="Credit Card" class="rounded"/>
                                    </div>
                                </div>
                                <span>Pending Approvals</span>
                                <h4 class="card-title text-nowrap mb-1">{{ $pendingApprovals }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>                      
            <!-- / Content -->
@endsection