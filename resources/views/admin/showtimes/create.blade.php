@extends('admin.parts.css')
@section('head_name', $theater->name.' '.$movie->name.' Showtimes-Create')
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
                <div class="alert alert-success d-none" id="message" >
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        x
                    </button>
                    created successfully
                </div>
            </div>
            <div class="container mt-3">
                <div class="alert alert-danger" id="error" style="display: none">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        x
                    </button>
                    There is an overlapping showtime for the same screen and date.
                </div>
            </div>
           <div class="row content_center px-5">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Create ShowTome for {{$movie->name}} in {{$theater->name}}</h4>

                    <form class="forms-sample" id="showTimeForm">
                        @csrf
                        <input type="hidden" id="theater_id" name="theater_id" value="{{$theater->id}}">
                        <input type="hidden" id="movie_id" name="movie_id" value="{{$movie->id}}">

                        

                        <div class="form-group">
                            <label for="date">date</label>
                            <input  type="date" class="form-control mystyle" name="date" id="date" placeholder="date" value="{{old('date')}}">
                        </div>
                        <div class="form-error">
                            <p class="text-danger mb-3" id="date_error"></p>
                        </div>

                        <div class="form-group">
                            <label for="start_time">start_time</label>
                            <input  type="time"  class="form-control mystyle" name="start_time" id="start_time" placeholder="start_time" value="{{old('start_time')}}">
                        </div>
                        <div class="form-error">
                            <p class="text-danger mb-3" id="start_time_error"></p>
                        </div>

                        <div class="form-group">
                            <label for="end_time" >end_time - Movie Duration <span class="red_span">{{$movie->duration}}</span></label>
                            <input  type="time"  class="form-control mystyle" name="end_time" id="end_time" placeholder="end_time" value="{{old('end_time')}}">
                        </div>
                        <div class="form-error">
                            <p class="text-danger mb-3" id="end_time_error"></p>
                        </div>


                        
                        <div class="form-check">
                            @foreach($theater->screens as $screen)
                            <input class="form-check-input" type="checkbox" value="{{$screen->id}}" id="screens" name="screens[]">
                            <label class="form-check-label" for="screens">
                                {{$screen->screen_number}}
                            </label>
                            @endforeach
                          </div>
                          <div class="form-error">
                            <p class="text-danger mb-3" id="screens_error"></p>
                        </div>
                        
                        
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <a href="{{route('showtime.show',['movie_id' => $movie->id, 'theater_id' => $theater->id])}}" class="btn btn-primary">showtimes</a>
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
            // let message = document.querySelector('#message');
            // message..classList.remove('d-none');
            $("#message").hide();
            $('#start_time_error').text('');
            $('#end_time_error').text('');
            $('#date_error').text('');
            $('#screens_error').text('');
            let theater_id = $("#theater_id").val();
            let movie_id = $("#movie_id").val();
            let screens = []; 
            $('input[name="screens[]"]:checked').each(function() {
                screens.push($(this).val()); 
            });
            let date = $("#date").val();
            let start_time = $("#start_time").val();
            let end_time = $("#end_time").val();
            let _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{route('showtime.store')}}",
                method: "POST",
                data: {
                    theater_id: theater_id,
                    movie_id: movie_id,
                    screens: screens,
                    date: date,
                    start_time: start_time,
                    end_time: end_time,
                    _token: _token
                },
                success: function(data){
                    if(data.status === true){
                        $("#message").show();
                        $("#showTimeForm")[0].reset();
                    }
                    else{
                        $('#error').show();
                    }
                },
                error: function(reject){
                    
                    let response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, value){
                        $("#"+key+"_error").text(value);
                        // console.log(key);
                    })
                }
            })
        })
    </script>
  </body>
</html>