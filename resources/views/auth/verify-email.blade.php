@extends('layouts.main')
@section('title', 'Verify email')
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

            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-weight-bold text-sm" style="color: #16a34a;">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif


            <div class="mt-4 flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf                    
                    <button type="submit" class="btn btn-primary d-grid w-100">{{ __('Resend Verification Email') }} </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-secondary mt-4 w-100">{{ __('Log Out') }}</button>
                </form>                
            </div>
                </div>
            </div>         
        </div>
    </div>
</div>

@endsection
