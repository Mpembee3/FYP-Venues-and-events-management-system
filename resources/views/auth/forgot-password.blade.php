@extends('layouts.main')
@section('title', 'Password Reset')
@section('content')

 <!-- Content -->

 <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Forgot Password -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center align-items-center flex-column">
                <span class="app-brand-logo demo mb-2">
                  <img src="../assets/img/favicon/favicon.ico" alt class="w-px-50 h-auto rounded-circle" />
                </span>
                <span class="app-brand-text demo text-body fw-bolder">UDSM Reservation System</span>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Forgot Password? </h4>
              <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>
              <!-- Session status -->
              <x-auth-session-status class="mb-4" :status="session('status')" />

              <form id="formAuthentication" class="mb-3" action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus  />
                  <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <button type="submit" class="btn btn-primary d-grid w-100">Send Reset Link</button>
              </form>
              <div class="text-center">
                <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                  <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                  Back to login
                </a>
              </div>
            </div>
          </div>
          <!-- /Forgot Password -->
        </div>
      </div>
    </div>

    <!-- / Content -->



@endsection