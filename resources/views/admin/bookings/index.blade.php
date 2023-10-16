@extends('admin.parts.css')
@section('head_name', 'All Bookings')
<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.parts.css')
</head>
<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_sidebar.html -->
        @include('admin.parts.sidebar')
        
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
          <!-- partial:../../partials/_navbar.html -->
        @include('admin.parts.header')
          
          <!-- partial -->
        <div class="main-panel">
          {{-- <div class="container mt-3">
            <div class="alert alert-success" id="success" style="display: none">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    x
                </button>
                movie is deleted successfully
            </div>
            <div class="alert alert-success" id="explore_success" style="display: none">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                  x
              </button>
              movie is added to explore successfully
          </div>
          </div> --}}
          <div class="row content_center">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">All Bookings</h4>
                    </p>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>User</th>
                            <th>Movie</th>
                            <th>Theater</th>
                            <th>Total Seats</th>
                            <th>Booking Status</th>
                            <th>Date</th>
                            <th>ShowTime</th>
                            <th>Notification</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <td>{{$booking->User->name}}</td>
                                <td>{{$booking->ShowTime->movie->name}}</td>
                                <td>{{$booking->ShowTime->theater->name}}</td>
                                <td>{{$booking->total_seats}}</td>
                                <td>{{$booking->booking_status}}</td>
                                <td>{{$booking->ShowTime->date}}</td>
                                <td>{{$booking->ShowTime->start_time}}</td>
                                <td><a href="{{route('send_email', $booking->User->id)}}" class="btn btn-info">Send</a></td>
                            </tr>
                            @endforeach
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
          </div>
            
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            
            <!-- partial -->
          </div>
          <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
      </div>
    <!-- container-scroller -->
    @include('admin.parts.script')
    
  </body>
</html>