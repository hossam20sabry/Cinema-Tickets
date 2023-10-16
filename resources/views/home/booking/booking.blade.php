@extends('home.user_layout')
@section('title', 'New Booking')
@section('style', '/home/css/book.css')

@section('booking_content')


<div class="mainSpinner d-none" id="mainSpinner">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only"></span>
    </div>
</div>

<div class=" text-light  text-center text-sm-start py-1 " id="section-1">
    <div class="container py-3">
        <div class="row" id="container_1">

            <div class="col-lg-4 col-md-5 col-12" id="poster">
                <img src="/posters/{{$movie->poster_url}}" class="img-thumbnail" alt="...">
            </div>
            <div class="col-lg-4 col-md-6 col-12" id="select">
                <form class="mid" id="formInfo1" action="{{route('get_info1')}}" method="GET">
                    @csrf
                    <input type="hidden" name="movie_id" id="movie_id" value="{{$movie->id}}">
                    @if(isset($theater))
                        <select class="form-select my-1 mt-3" aria-label="Default select example" name="theater_id" id="theater_id"> 
                            <option value="{{$theater->id}}" id="selected_theater_id" selected>{{$theater->name}}</option>
                            
                        </select>
                    @else
                        <select class="form-select my-1 mt-3" aria-label="Default select example" name="theater_id" id="theater_id"> 
                            <option value="" disabled selected>Select Cenima</option>
                            @foreach($theaters as $theater)
                            <option value="{{$theater->id}}">{{$theater->name}}</option>
                            @endforeach
                        </select>
                    @endif
                    @error('theater_id')
                        <div class="form-error" id="theater_id_error">
                            <p class="text-danger validation-error">{{$message}}</p>
                        </div>
                    @enderror
                    {{-- <div class="form-error">
                        <p class="text-danger validation-error" id="theater_id_error"></p>
                    </div> --}}
                    <div class="spinner d-none" id="theater_id_spinner">
                        <img src="{{asset('/home/img/Spinner-0.5s-371px.gif')}}" alt="">
                    </div>




                    <select class="form-select my-1" aria-label="Default select example" name="date" id="date">
                        <option value="" disabled selected>Date</option>
                    </select>
                    @error('date')
                        <div class="form-error">
                            <p class="text-danger validation-error" id="date_error">{{$message}}</p>
                        </div>
                    @enderror
                    {{-- <div class="form-error">
                        <p class="text-danger validation-error" id="date_error"></p>
                    </div> --}}
                    <div class="spinner d-none" id="date_spinner">
                        <img src="{{asset('/home/img/Spinner-0.5s-371px.gif')}}" alt="">
                    </div>




                    <select class="form-select my-1 " aria-label="Default select example" name="time" id="time">
                        <option value="" disabled selected>Time</option>
                    </select>
                    @error('time')
                        <div class="form-error">
                            <p class="text-danger validation-error" id="time_error">{{$message}}</p>
                        </div>
                    @enderror
                    {{-- <div class="form-error">
                        <p class="text-danger validation-error" id="time_error"></p>
                    </div> --}}
                    <div class="spinner d-none" id="time_spinner">
                        <img src="{{asset('/home/img/Spinner-0.5s-371px.gif')}}" alt="">
                    </div>
                    



                    
                    <select class="form-select my-1 " aria-label="Default select example" name="screen_id" id="screen_id">
                        <option value="" disabled selected>Screen</option>
                    </select>
                    @error('screen_id')
                        <div class="form-error">
                            <p class="text-danger validation-error" id="screen_id_error">{{$message}}</p>
                        </div>
                    @enderror
                    {{-- <div class="form-error">
                        <p class="text-danger validation-error pb-3" id="screen_id_error"></p>
                    </div> --}}
                    <div class="spinner d-none" id="screen_spinner">
                        <img src="{{asset('/home/img/Spinner-0.5s-371px.gif')}}" alt="">
                    </div>

                    <button type="submit" class="btn submit-css"> Next <span>></span></button>

                </form>
            </div>
            <div class="col-lg-4 col-md-12 col-12">
                <div class="table-responsive py-3 booking-table">
                    <table class="table table-success table-striped">
                        <tbody>
                            
                            <tr>
                                <td class="left-td">Name</td>
                                <td>{{$movie->name}}</td>
                            </tr>
                            <tr>
                                <td class="left-td">Rate</td>
                                <td>{{$movie->rating}}</td>
                            </tr>
                            <tr>
                                <td class="left-td">Language</td>
                                <td>{{$movie->lang}}</td>
                            </tr>
                            <tr>
                                <td class="left-td">Kind</td>
                                <td> @php $ch =0; @endphp
                                    @foreach($movie->kinds as $kind)
                                    @php $ch++ @endphp
                                    @if($ch !== 1) , @endif
                                    {{$kind->title}}
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="left-td">Category</td>
                                <td>{{$movie->category->title}}</td>
                            </tr>
                            <tr>
                                <td class="left-td">Duration</td>
                                <td>{{$movie->duration}} </td>
                            </tr>
                            <tr>
                                <td class="left-td">Release Date</td>
                                <td>{{$movie->release_date}}</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        

</div>


<section class="text-light text-center text-sm-start  bg_white" id="section-2">
    <div class="container p-5">
        <div class="row">
            <h1 class="text-center">Trailer</h1>
            <div class="ratio ratio-16x9 my-3">
                <iframe src="/trailers/{{$movie->trailer_url}}" title="MOVIE TRAILER" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>


@endsection

<script src="{{asset('/jquery-3.7.1.min.js')}}"></script>
<script>
    $(document).ready(function(){

        let selected_theater_id = $('#selected_theater_id').val();

        if(selected_theater_id){
            console.log(selected_theater_id);
            $('#theater_id_spinner').removeClass('d-none');
            $('#date').addClass('d-none');
            var $date = $('#date');
            let movie_id = $('#movie_id').val();
            $.ajax({
                url:"{{ route('theater_id') }}",
                data:{
                    theater_id: selected_theater_id,
                    movie_id:movie_id,
                },
                success:function(data){
                    $date.html('<option value="" disabled selected>Date</option>');
                    var previousValue = null;
                    $.each(data, function(index, showtime){
                        if (showtime.date !== previousValue) {
                            $date.append('<option value="'+ showtime.id +'">'+ showtime.date +'</option>');
                            previousValue = showtime.date;
                        }
                    });
                    // $('#theater_id_error').text('');
                    if($('#theater_id_spinner').addClass('d-none')){
                        $('#date').removeClass('d-none');
                    }
                }
            });
            $('#date, #time, #screen_id').val("");
            
        }else{
            $('#theater_id').change(function(){
            $('#theater_id_spinner').removeClass('d-none');
            $('#date').addClass('d-none');
            var $date = $('#date');
            let movie_id = $('#movie_id').val();
            $.ajax({
                url:"{{ route('theater_id') }}",
                data:{
                    theater_id: $(this).val(),
                    movie_id:movie_id,
                },
                success:function(data){
                    $date.html('<option value="" disabled selected>Date</option>');
                    var previousValue = null;
                    $.each(data, function(index, showtime){
                        if (showtime.date !== previousValue) {
                            $date.append('<option value="'+ showtime.id +'">'+ showtime.date +'</option>');
                            previousValue = showtime.date;
                        }
                    });
                    $('#theater_id_error').text('');
                    if($('#theater_id_spinner').addClass('d-none')){
                        $('#date').removeClass('d-none');
                    }
                }
            });
            $('#date, #time, #screen_id').val("");
            
        });
        }

        

        

        $('#date').change(function(){
            $('#date_spinner').removeClass('d-none');
            $('#time').addClass('d-none');
            var $time = $('#time');
            let movie_id = $('#movie_id').val();
            $.ajax({
                url:"{{route('date')}}",
                data:{
                    showtime_id: $(this).val(),
                    movie_id:movie_id,
                },
                success:function(data){
                    $time.html('<option value="" disabled selected>time</option>');
                    var previousValue = null;
                    $.each(data, function(index, showtime){
                        if(showtime.start_time !== previousValue){
                            $time.append('<option value="'+ showtime.id +'">'+ showtime.start_time +'</option>');
                            previousValue = showtime.start_time;
                        }
                    });
                    $('#date_error').text('');
                    if($('#date_spinner').addClass('d-none')){
                        $('#time').removeClass('d-none');
                    }
                    
                }
            });
            $('#time, #screen_id').val("");
            
        });

        $('#time').change(function(){
            $('#time_spinner').removeClass('d-none');
            $('#screen_id').addClass('d-none');
            var $screen_id = $('#screen_id');
            let movie_id = $('#movie_id').val();

            $.ajax({
                url:"{{route('time')}}",
                data:{
                    showTime_id:$(this).val(),
                    movie_id:movie_id,
                },
                success:function(data){
                    var screens = data.screens;
                    var show_time = data.show_time;

                    $('#showTime_id_div').html('<input type="hidden" name="showTime_id" id="showTime_id" value="'+ show_time.id +'>');
                    $screen_id.html('<option value="" disabled selected>Screen</option>');
                    $.each(screens, function(index, screen){
                        $screen_id.append('<option value="'+ screen.id +'">'+ screen.screen_number +'</option>');
                    });
                    $('#time_error').text('');
                    if($('#time_spinner').addClass('d-none')){
                        $('#screen_id').removeClass('d-none');
                    }
                    
                },
                
            });
            $('#screen_id').val("");
        });

        
        // if(selected_theater_id){
        //     $('#formInfo1').submit(function(e){
        //         $('#mainSpinner').removeClass('d-none');
        //         e.preventDefault();
        //         $('#date_error').text('');
        //         $('#time_error').text('');
        //         $('#screen_id_error').text('');
                
        //         let theater_id = $('#selected_theater_id').val();
        //         let date = $('#date').val();
        //         let time = $('#time').val();
        //         let screen_id = $('#screen_id').val();
        //         let _token = $('input[name="_token"]').val();
                
        //         $.ajax({
        //             url:"{{route('get_info1')}}",
        //             method:"POST",
        //             data:{
        //                 theater_id:theater_id,
        //                 date:date,
        //                 time:time,
        //                 screen_id:screen_id,
        //                 _token:_token
        //             },
        //             success: function(data){
        //                 $('#mainSpinner').addClass('d-none');

        //             },
        //             error: function(reject){
        //                 $('#mainSpinner').addClass('d-none');
        //                 let response = $.parseJSON(reject.responseText);
        //                 $.each(response.errors, function(key, value){
        //                     if ($('#' + key).hasClass('d-none')){
        //                         return;
        //                     }
        //                     else
        //                     {
        //                         $("#"+key+"_error").text(value);
        //                     }
        //                 })
        //             },
        //         });
        //     });
        // }else{
        //     $('#formInfo1').submit(function(e){
        //         e.preventDefault();
        //         $('#mainSpinner').removeClass('d-none');
        //         $('#theater_id_error').text('');
        //         $('#date_error').text('');
        //         $('#time_error').text('');
        //         $('#screen_id_error').text('');

                
        //         let theater_id = $('#theater_id').val();
        //         let date = $('#date').val();
        //         let time = $('#time').val();
        //         let screen_id = $('#screen_id').val();
        //         let _token = $('input[name="_token"]').val();
                
        //         $.ajax({
        //             url:"{{route('get_info1')}}",
        //             method:"POST",
        //             data:{
        //                 theater_id:theater_id,
        //                 date:date,
        //                 time:time,
        //                 screen_id:screen_id,
        //                 _token:_token
        //             },
        //             success: function(data){
        //                 $('#mainSpinner').addClass('d-none')
        //             },
        //             error: function(reject){
        //                 $('#mainSpinner').addClass('d-none')
        //                 let response = $.parseJSON(reject.responseText);
        //                 $.each(response.errors, function(key, value){
        //                     if ($('#' + key).hasClass('d-none')){
        //                         return;
        //                     }
        //                     else
        //                     {
        //                         $("#"+key+"_error").text(value);
        //                     }
        //                 })
        //             },
        //         });
        //     });
        // }
        
    });
</script>