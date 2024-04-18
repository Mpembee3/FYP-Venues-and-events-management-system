@extends('layouts.sidebar')
@section('title', 'Reservation requests')
@section('content2')

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">Reservation requests</h4>
          
          <!-- Content (table with requests and actions) -->
           <!-- Bordered Table -->
          
           <div class="card">     
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>S/N</th>                      
                      <th>Name</th>
                      <th>Venue</th>
                      <th>Event</th>
                      <th>email</th>                      
                      <th>Contact</th>                     
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  @foreach ($data as $reservation)
                  <tbody>
                    <tr>
                      <td>{{$reservation->id}}</td>
                      <td>
                        <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$reservation->name}}</strong>
                      </td>
                      <td>{{$reservation->venue}}</td>  
                      <td>{{$reservation->event}}</td>  
                      <td>{{$reservation->email}}</td>  
                      <td>{{$reservation->contact}}</td>                   
                      <td><span class="badge bg-label-success me-1">Approved</span></td>
                      <td>
                        <div class="btn-group" role="group" aria-label="Button group">
                          <button type="button" class="btn btn-success">
                            <i class="bx bx-check me-1"></i> Approve
                          </button>
                          <button type="button" class="btn btn-primary">
                            <i class="bx bx-check me-1"></i> Accept
                          </button>
                          <button type="button" class="btn btn-danger">
                            <i class="bx bx-x-circle me-1"></i> Reject
                          </button>
                        </div>  
                      </td>
                    </tr>                    
                    <tr>                                          
                  </tbody>
                  @endforeach
                </table>                
              </div>
            </div>
          </div>
        </div>
          </div>
          
          <!--/ Bordered Table -->
          @endsection