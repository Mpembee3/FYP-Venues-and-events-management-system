@extends('layouts.sidebar')
@section('title', 'Payments')
@section('content2')

         <!-- Content wrapper -->
         <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">Payments dashboard</h4>
          
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
                      <th>Control number</th> 
                      <th>Amount (Tshs)</th>              
                      <th>Status</th>                     
                    </tr>
                  </thead>
                  @foreach($data as $payment)
                  <tbody>
                    <tr>
                      <td>{{$payment->id}}</td>
                      <td>
                        <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$payment->name}}</strong>
                      </td>
                      <td>{{$payment->venue}}</td>  
                      <td>{{$payment->event}}</td>
                      <td>{{$payment->email}}</td>  
                      <td>{{$payment->contact}}</td>
                      <td>{{$payment->control_number}}</td>
                      <td>{{$payment->amount}}</td>
                      <td><span class="badge bg-label-success me-1">Paid</span></td>
                    </tr>                  
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