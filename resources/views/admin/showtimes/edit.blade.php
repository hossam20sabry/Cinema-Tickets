@extends('admin.parts.css')
@section('head_name', $showTime->theater->name.' '.$showTime->movie->name.' Theaters-Update')
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
                <div class="alert alert-success" id="success" style="display: none">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        x
                    </button>
                    updated successfully
                </div>
                <div class="alert alert-success" id="error" style="display: none">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        x
                    </button>
                   error
                </div>
            </div>
           <div class="row content_center px-5">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">update ShowTime for {{$showTime->movie->name}} in {{$showTime->theater->name}}</h4>

                    <form class="forms-sample" id="showTimeForm">
                        @csrf
                        <input type="hidden" name="showTime_id" id="showTime_id" value="{{$showTime->id}}">
                        

                        <div class="form-group">
                            <label for="date">date</label>
                            <input  type="date"  class="form-control mystyle" name="date" id="date" placeholder="date" value="{{$showTime->date}}">
                        </div>

                        <div class="form-group">
                            <label for="start_time">start_time</label>
                            <input  type="time"  class="form-control mystyle" name="start_time" id="start_time" placeholder="start_time" value="{{$showTime->start_time}}">
                        </div>

                        <div class="form-group">
                            <label for="end_time">end_time</label>
                            <input  type="time"  class="form-control mystyle" name="end_time" id="end_time" placeholder="end_time" value="{{$showTime->end_time}}">
                        </div>
                        
                        <div class="form-group" >
                            <label for="screens">screens</label>
                            <select class="form-control"  id="screens" name="screen[]" multiple>
                            @foreach($showTime->theater->screens as $screen)
                                @php $ch = 0; @endphp
                                @foreach($screen->showtimes as $showtime)
                                @if($showtime->id == $showTime->id) {{$ch = 1;}} @endif
                                @endforeach
                                <option value="{{$screen->id}}" @if($ch == 1) selected @endif>{{$screen->screen_number}}</option>
                                
                            @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
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
        $("#showTimeForm").submit(function(e){
            e.preventDefault();
            let showTime_id = $("#showTime_id").val();
            let screens = $("#screens").val();
            let date = $("#date").val();
            let start_time = $("#start_time").val();
            let end_time = $("#end_time").val();
            let _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{route('showtime.update')}}",
                method: "POST",
                data: {
                    showTime_id: showTime_id,
                    screens: screens,
                    date: date,
                    start_time: start_time,
                    end_time: end_time,
                    _token: _token
                },
                success: function(data){
                    if(data.status === true){
                        $("#success").show();
                    }else{
                        $("#error").show();
                    }
                }
            })
        })
    </script>
  </body>
</html>