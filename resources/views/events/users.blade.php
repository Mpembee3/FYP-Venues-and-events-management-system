@extends('layouts.sidebar_user')
@section('title', 'Events Dashboard')

@section('content2')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Your Events Schedule</h4>
        
        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped table-hover datatable" id="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Venue</th>
                                <th>Event</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                            <tr class="@if ($event->status == 'upcoming') table-warning @elseif ($event->status == 'ongoing') table-success @elseif ($event->status == 'completed') table-secondary @endif">
                                    <td>{{ $event->id }}</td>
                                    <td>{{ $event->payment->reservation->venue->name }}</td>
                                    <td>{{ $event->payment->reservation->event_id }}</td>
                                    <td>{{ ucfirst($event->status) }}</td>
                                    <td>{{ $event->payment->reservation->date }}</td>
                                    <td>{{ $event->payment->reservation->start_time }}</td>
                                    <td>{{ $event->payment->reservation->end_time }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- <h4 class="fw-bold py-3 mb-4">Other Events</h4>
        
        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Venue</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($otherEvents as $event)
                                <tr class="@if ($event->status == 'upcoming') table-warning @elseif ($event->status == 'ongoing') table-success @elseif ($event->status == 'completed') table-secondary @endif">
                                    <td>{{ $event->id }}</td>
                                    <td>{{ $event->payment->reservation->venue->name }}</td>
                                    <td>{{ ucfirst($event->status) }}</td>
                                    <td>{{ $event->payment->reservation->date }}</td>
                                    <td>{{ $event->payment->reservation->start_time }}</td>
                                    <td>{{ $event->payment->reservation->end_time }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> -->
    </div>
</div>
@endsection
