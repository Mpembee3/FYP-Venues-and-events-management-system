@extends('layouts.main')
@section('title', 'Registration')
@section('content')

 <!-- Content -->

 <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register Card -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center align-items-center flex-column">
                <span class="app-brand-logo demo mb-2">
                  <img src="{{ asset('assets/img/favicon/favicon.ico') }}" alt class="w-px-50 h-auto rounded-circle" />
                </span>
                <span class="app-brand-text demo text-body fw-bolder">UDSM Reservation System</span>
              </div>
              <!-- /Logo -->
              

              <form id="formAuthentication" action="{{ route('register') }}" method="POST" class="mb-3"  >
                @csrf
                <div class="mb-3">
                  <label for="firstname" class="form-label">First name</label>
                  <input
                    type="text"
                    class="form-control"
                    id="firstname"
                    name="firstname"
                    placeholder="Enter your First name"
                    autofocus
                  />
                  <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="mb-3">
                  <label for="surname" class="form-label">Surname</label>
                  <input
                    type="text"
                    class="form-control"
                    id="surname"
                    name="surname"
                    placeholder="Enter your Surname"
                    autofocus
                  />
                  <x-input-error :messages="$errors->get('surname')" class="mt-2" />
                </div>

                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
                  <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                  </div>
                </div>

                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password_confirmation">Confirm Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password_confirmation"
                      class="form-control"
                      name="password_confirmation"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                  </div>
                </div>

                <!-- <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                    <label class="form-check-label" for="terms-conditions">
                      I agree to
                      <a href="javascript:void(0);">privacy policy & terms</a>
                    </label>
                  </div>
                </div> -->
                <button type="submit" class="btn btn-primary d-grid w-100">Sign up</button>
              </form>

              <p class="text-center">
                <span>Already have an account?</span>
                <a href="{{ url('login') }}">
                  <span>Sign in instead</span>
                </a>
              </p>
            </div>
          </div>
          <!-- Register Card -->
        </div>
      </div>
    </div>
    
    <!-- / Content -->


@endsection
