@extends('layouts.sidebar_user')
@section('title', 'Reservation form')
@section('content2')



 <!-- Content -->

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Reservation form -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center align-items-center flex-column">
                        <span class="app-brand-logo demo mb-2">
                            <img src="{{ asset('assets/img/favicon/favicon.ico') }}" alt
                                class="w-px-50 h-auto rounded-circle" />
                        </span>
                        <span class="app-brand-text demo text-body fw-bolder">Reservation Request</span>
                    </div>
                    <!-- /Logo -->

                    <form id="formAuthentication" action="{{ route('reservation.store') }}" method="POST" class="mb-3">
                        @csrf
                        <input type="hidden" name="venue_id" value="{{ $venue->id }}">
                        <input type="hidden" name="date" value="{{ $date }}">
                        <div class="mb-3">
                            <label for="firstname" class="form-label">First name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $user->firstname }}" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="surname" class="form-label">Surname</label>
                            <input type="text" class="form-control" id="surname" name="surname" value="{{ $user->surname }}" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="venue" class="form-label">Venue</label>
                            <input type="text" class="form-control" id="venue" name="venue" value="{{ $venue->name }}" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Date of Reservation</label>
                            <input type="text" class="form-control" id="date" name="date" value="{{ $date }}" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="event" class="form-label">Event</label>
                            <select class="form-select" id="event" name="event_id" required>
                                <option value="">Select an event</option>
                                @if (isset($venue->event))
                                    <option value="{{ $venue->event }}">{{ $venue->event }}</option>
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="start_time" class="form-label">Starting Time</label>
                            <input type="time" class="form-control" id="start_time" name="start_time" value="{{ $start_time }}" readonly/>
                        </div>
                        <div class="mb-3">
                            <label for="end_time" class="form-label">Ending Time</label>
                            <input type="time" class="form-control" id="end_time" name="end_time" value="{{ $end_time }}" readonly />
                        </div>
                        <button type="submit" class="btn btn-primary d-grid w-100">Confirm reservation</button>
                    </form>

                </div>
            </div>
            <!-- Reservation form -->
        </div>
    </div>
</div>

<!-- / Content -->

@endsection