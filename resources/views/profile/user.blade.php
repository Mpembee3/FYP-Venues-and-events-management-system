@extends('layouts.sidebar_user')
@section('title', 'Profile')
@section('content2')


      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>
                  @if (session('status') === 'password-updated')
                   <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="alert alert-success text-sm text-gray-600 dark:text-gray-400"
                    >{{ __('Password changed successfully') }}</p>

                  @endif

                  @if (session('status') === 'profile-updated')
                  <p
                      x-data="{ show: true }"
                      x-show="show"
                      x-transition
                      x-init="setTimeout(() => show = false, 2000)"
                      class="alert alert-success text-sm text-gray-600 dark:text-gray-400"
                  >{{ __('Saved') }}</p>
                @endif


          <div class="row">
            <div class="col-md-12">
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('patch')

              <div class="card mb-4">
                <h5 class="card-header">Profile Details ({{ strtoupper($user->role) }})</h5>
                <!-- profile details -->
                <!-- Account -->              
                <div class="card-body">                                  

                    <div class="row">
                      <div class="mb-3 col-md-6">
                        <label for="firstname" class="form-label">First Name</label>
                        <input class="form-control" type="text" id="firstname" name="firstname" value="{{$user->firstname}}" />
                        <x-input-error class="mt-2" :messages="$errors->get('firstname')" />
                      </div>
                      
                      <div class="mb-3 col-md-6">
                        <label for="surname" class="form-label">Surname</label>
                        <input class="form-control" type="text" name="surname" id="surname" value="{{$user->surname}}" />
                        <x-input-error class="mt-2" :messages="$errors->get('surname')" />
                      </div>                       
                      <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" type="text" name="email" id="email" value="{{$user->email}}"  />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input class="form-control" type="text" name="phone" id="phone" value="{{$user->phone}}"  />
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                      </div>                                            
                    </div>
                    <div class="mt-2">
                      <button type="submit" class="btn btn-primary me-2">Save</button>
                      <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                    </div>
              </form>


                </div>
              </div>  

            <!-- profile details -->






            <!-- password manage  -->
            <div class="card mb-4">
                <h5 class="card-header">Update Password</h5>
                <!-- <p class= "mt- 1"> Ensure your account is using a long, random password to stay secure </p> -->
                                <!-- passwords-->
                
              <div class="card-body">
                <form id="formAccountSettings" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                  <div class="row">
                    <div class="row">
                      <div class="mb-3 col-md-6">
                        <label for="currentpassword" class="form-label">Current password</label>
                        <input class="form-control" type="password" id="currentpassword" name="current_password" />
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                      </div>
                    </div>

                      <div class="row">
                        <div class="mb-3 col-md-6">
                          <label for="updatepassword" class="form-label">New Password</label>
                          <input class="form-control" type="password" name="password" id="updatepassword"  />
                          <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>  
                      </div>
                      
                      <div class="row">
                        <div class="mb-3 col-md-6">
                          <label for="updatepasswordconfirmation" class="form-label">Confirm password</label>
                          <input class="form-control" type="password" name="password_confirmation" id="updatepasswordconfirmation" />
                          <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                        </div> 
                      </div>
                                           
                    </div>
                      <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Save</button>
                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                      </div>
                </form>
              </div>
              </div>  
            </div>
          </div>
        </div>
        <!-- / Content -->






@endsection