@extends('admin.parts.css')
@section('head_name', 'avilable movies in'.' '.$theater->name )
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
          <div class="container mt-3">
            <div class="alert alert-danger " id="success" style="display: none">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    x
                </button>
                deleted successfully
            </div>
            <div class="container mt-3">
              <div class="alert alert-danger " id="error" style="display: none">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                      x
                  </button>
                  error
              </div>
        </div>
          <div class="row content_center">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card ">
                  <div class="card-body ">
                    <h4 class="card-title ">{{$movie->name}} in {{$theater->name}} screens</h4>
                    @if($showTimes->count() > 0)
                    <div class="table-responsive ">
                      <table class="table ">
                        <thead>
                          <tr>
                            <th>date</th>
                            <th>start time</th>
                            <th>end time</th>
                            <th>screens</th>
                            <th>update</th>
                            <th>delete</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                              
                                @foreach($showTimes as $showtime)
                                <tr class="showTimeRow{{$showtime->id}}">
                                <td>{{$showtime->date}}</td>
                                <td>{{$showtime->start_time}}</td>
                                <td>{{$showtime->end_time}}</td>
                                <td>@foreach($showtime->screens as $screen) {{$screen->screen_number}} , @endforeach</td>
                                <td><a href="{{route('showtime.edit', $showtime->id)}}" class="btn btn-primary">update</a></td>
                                <td><a showTime_id="{{$showtime->id}}" class="delete btn btn-danger">delete</a></td>
                                </tr>
                                @endforeach
                                
                            </tr>
                        </tbody>
                      </table>
                    </div>
                    @else
                    <h3 class="text-center text-capitalize py-5">no showtimes</h3>
                    @endif                    
                    </form>
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
    <script>
      $('.delete').click(function(e){
        e.preventDefault();
        let showTime_id = $(this).attr('showTime_id');
        $.ajax({
          method: "POST",
          url: "{{route('showtime.destroy')}}",
          data: {
            '_token': "{{csrf_token()}}",
            'showTime_id': showTime_id
          },
          success: function(data){
            if(data.status == true){
              $('#success').show();
            }else{
              $('#error').show();
            }
            $('.showTimeRow'+data.showTime_id).remove();
          },
        });
      });
    </script>
  </body>
</html>