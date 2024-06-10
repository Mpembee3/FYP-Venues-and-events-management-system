@extends('layouts.main')
@section('content')
<div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo justify-content-center align-items-center flex-column">
            <a href="{{ url('dashboard') }}" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/favicon/favicon.ico') }}" alt class="w-px-50 h-auto rounded-circle" />
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2">URS</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
              <a href="{{ url('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

            <!-- Venues (add venue page at href)-->
            <li class="menu-item {{ Request::is('see_venue*') ? 'active' : '' }}">
              <a href="{{ url('see_venue') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Venues</div>
              </a>             
            </li>

            <!-- Reservation requests (show both accepted, rejected and pending) -->
            <li class="menu-item {{ Request::is('see_reservations') ? 'active' : '' }}">
              <a href="{{ url('see_reservations') }}" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Reservation requests</div>
              </a>              
            </li>
            <!-- Events(This show events status(ongoing, upcoming)) -->
            <li class="menu-item {{ Request::is('events') ? 'active' : '' }}">
              <a href="{{ url('events') }}" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-table"></i>
                <div data-i18n="Account Settings">Events</div>
              </a>              
            </li> 

             <!-- Payments(This show payments status(pending, paid)) -->
             <li class="menu-item {{ Request::is('see_payments') ? 'active' : '' }}">
              <a href="{{ url('see_payments') }}" class="menu-link ">
              <i class="menu-icon tf-icons bx bx-wallet"></i>


                <div data-i18n="Account Settings">Payments</div>
              </a>              
            </li>               

            <!-- Other stuffs can be added here -->
            <li class="menu-item">
              <a href=" " class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Misc">Misc</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href=" " class="menu-link">
                    <div data-i18n=" "></div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href=" " class="menu-link">
                    <div data-i18n=" "></div>
                  </a>
                </li>
              </ul>
            </li>       
          
           
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

              <ul class="navbar-nav flex-row align-items-center ms-auto">     

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <!-- dark mode will be implemented here -->
                           <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" id="dark-mode-toggle">
                              <i class="bx bx-moon"></i>
                            </a>
                          </li>
                  <!-- dark mode will be implemented here -->

                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{ Auth::user()->firstname }} {{ Auth::user()->surname }}</span>
                            <small class="text-muted">{{ Auth::user()->role }}</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    
                    
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </form>
                    </li>

                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>
          @yield('content2')

          <!-- / Navbar -->
@endsection