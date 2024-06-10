@extends('layouts.main')
@section('title', 'Confirm Password')
@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Confirm password-->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center align-items-center flex-column">
                <span class="app-brand-logo demo mb-2">
                  <img src="../assets/img/favicon/favicon.ico" alt class="w-px-50 h-auto rounded-circle" />
                </span>
                <span class="app-brand-text demo text-body fw-bolder">UDSM Reservation System</span>
              </div>

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      required autocomplete="current-password"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>                    
                  </div>
                  <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
        <div class="flex justify-end mt-4">            
            <button type="submit" class="btn btn-primary w-100">{{ __('Confirm') }}</button>               
        </div>
    </form>

                 </div>
            </div>         
        </div>
    </div>
</div>

    @endsection
