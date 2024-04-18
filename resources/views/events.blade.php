@extends('layouts.sidebar')
@section('title', 'Events Dashboard')
@section('content2')

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">Events dashboard</h4>
          
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
                      <th>Event</th>
                      <th>email</th>                      
                      <th>Contact</th>                     
                      <th>Status</th>
                      <th>Schedule</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>
                        <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Albert Cook</strong>
                      </td>
                      <td>Venue 4</td>  
                      <td>Seminar</td>
                      <td>albertcook@gmail.com</td>  
                      <td>+255 123 456 789</td>                   
                      <td><span class="badge bg-label-success me-1">Ongoing</span></td>
                      <td>
                        <div class="d-flex flex-column">
                        <span>2024-03-25</span>
                        <span>10:00</span>
                        </div>
                      </td>
                    </tr>                    
                    <tr>
                      <td>2</td>
                      <td><i class="fab fa-react fa-lg text-info me-3"></i> <strong>Barry Hunter</strong></td>
                      <td>Venue 3</td>  
                      <td>Workshop</td>
                      <td>barryhunter@gmail.com</td>
                      <td>+255 123 456 789</td>    
                      <td><span class="badge bg-label-success me-1">Approved</span></td>
                      <td>                        
                        <div class="d-flex flex-column">
                          <span>2024-03-25</span>
                          <span>10:00</span>
                        </div>                  

                      </td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td><i class="fab fa-vuejs fa-lg text-success me-3"></i> <strong>Trevor Baker</strong></td>
                      <td>Venue 2</td>  
                      <td>Meeting</td>
                      <td>trevorbaker@gmail.com</td>
                      <td>+255 123 456 789</td>    
                      <td><span class="badge bg-label-warning me-1">Pending</span></td>
                      <td>
                        <div class="d-flex flex-column">
                          <span>2024-03-25</span>
                          <span>10:00</span>
                        </div>  
                      </td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>
                        <i class="fab fa-bootstrap fa-lg text-primary me-3"></i> <strong>Jerry Milton</strong>
                      </td>
                      <td>Venue 1</td>  
                      <td>Worship</td>
                      <td>jerrymilton@gmail.com</td>  
                      <td>+255 123 456 789</td>                        
                      <td><span class="badge bg-label-warning me-1">Pending</span></td>
                      <td>
                        <div class="d-flex flex-column">
                          <span>2024-03-25</span>
                          <span>10:00</span>
                        </div>  
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
          </div>

          @endsection