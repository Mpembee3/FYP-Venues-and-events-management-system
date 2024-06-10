@extends('layouts.main')
@section('title', 'Reset Password')
@section('content')
 <!-- Content -->

 <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Verify email-->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center align-items-center flex-column">
                <span class="app-brand-logo demo mb-2">
                  <img src="../assets/img/favicon/favicon.ico" alt class="w-px-50 h-auto rounded-circle" />
                </span>
                <span class="app-brand-text demo text-body fw-bolder">UDSM Reservation System</span>
              </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
                <div class="mb-3">
                  <label for="email" class="form-label" >Email</label>
                  <x-text-input class="form-control" type="email" id="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username"/>
                  <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

        <!-- Password -->
        <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" name="password"  required autocomplete="new-password"  />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                  </div>
                </div>

        <!-- Confirm Password -->
        <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password_confirmation">Confirm Password</label>
                  <div class="input-group input-group-merge">
                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required autocomplete="new-password" />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                  </div>
                </div>

        <div class="flex justify-end mt-4">            
            <button type="submit" class="btn btn-primary w-100">{{ __('Reset Password') }}</button>               
        </div>
    </form>


                </div>
            </div>         
        </div>
    </div>
</div>    
@endsection
