@extends('admin.parts.css')
@section('head_name', 'Theater screen')
<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.parts.css')
<link rel="stylesheet" href="{{asset('home/css/theater.css')}}">
</head>
<body>

    
    <!-- partial -->

    <div class="row content_center">
    <div class="container  my">
        <div class="row" id="movies-page">
            <div class="movie-container">
                
                {{-- <label class="p-2">INTERSTEllAR</label> --}}
                <label class="p-2">{{$screen->screen_number}}</label>
                
                
                <ul class="showcase mt-3">
                    <li>
                        <div class="seat"></div>
                        <small>N/A</small>
                    </li>
                    <li>
                        <div class="seat selected"></div>
                        <small>Selected</small>
                    </li>
                    <li>
                        <div class="seat occupied"></div>
                        <small>Occupied</small>
                    </li>    
                </ul>
                
                <div class="container" id="container">
                    <div class="screen"></div>
                </div>
                <form action="{{ route('fake_seat', $screen->id) }}" method="POST">
                    @csrf
                    <div class="mmy">
                        <div class="row">
                            @php $count = 1; $ch = 1; $letter ='A'; $check_apearance = 0; @endphp
                            <div class="col" id="col">
                                @foreach ($screen->rows as $row)
                                    <div class="my_row">    
                                        <div class="row_letter">{{$row->letter}}</div>
                                        @foreach ($row->seats as $seat)
                                            @if($seat->apearance == 1)
                                            <div class="fake_seat"> </div>
                                            @php $check_apearance = 1; @endphp
                                            @else
                                            <div class="seat" data-seat-id="{{$seat->id}}">{{$seat->number}}</div>
                                            @endif
                                        @endforeach
                                        <div class="row_letter">{{$row->letter}}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="container my" id="container">
                        <button type="submit" onclick="return confirm('are you sure')" class="btn btn-primary mb-5 mt-3" id="btn">Make Fake</button>
                        <a href="{{ url('screens', $theater->id) }}" class="btn btn-dark">Screens</a>
                    </div>
                </form>

                @if($check_apearance == 1)
                <label class="p-2">
                    <h3>Seats Deleted</h3>
                </label>
                
                
                    <div class="mmy">
                        <div class="row">
                            @php $count = 1; $ch = 1; $letter ='A'; @endphp
                            <div class="col" id="col">
                                @foreach ($screen->rows as $row)
                                    <div class="my_row">    
                                        @foreach ($row->seats as $seat)
                                            @if($seat->apearance == 1)
                                            <a href="{{ route('real_seat', $seat->id) }}" class="seat">{{$seat->number}}</a>
                                            @else
                                            <div class="fake_seat"> </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    @endif
            </div>
                
                
        </div>
        
    </div>

    </div>
<script>
    const screenData = {!! json_encode($screen) !!};
</script>


<script src="{{asset('home/js/theater.js')}}"></script>

  </body>
</html>