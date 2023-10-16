@extends('home.user_layout')
@section('title','Cinema' .' . ' .  $theater->name)
@section('style', '/home/css/cinema.css')


@section('show_theater')


<section class="main">
    <img src="/wide_img_cinema_photos/{{$theater->wide_img}}" class="img-fluid bg" alt="...">
    <div class="bbody">
        <h2 style="text-transform: capitalize">Welcome to {{$theater->name}}</h2>
        <p class="text-capitalize">Book your favorite movies now and enjoy your time at our cinema. <br>
        Address: {{$theater->location}} | City: {{$theater->city}}</p>
    </div>
</section>

<div class="container pt-2 minHeight">
    <h1 class="head-title text-center my-3 py-1">{{$theater->name}}  movies</h1>
    @if(count($movies) > 0)
    <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 g-4" id="movies-page">
        @php $ch = 0; @endphp
        @foreach($movies as $movie)
        <div class="col relative">
            <div class="card" style="border: none">
                <img src="/photos/{{$movie->photo_url}}" class="card-img-top" alt="...">
                <div class="card-body" style="--bs-card-spacer-y: 1rem; --bs-card-spacer-x: 0rem">
                    <h5 class="card-title">{{$movie->name}}</h5>
                    <p class="card-text">Duration: {{$movie->duration}}<br>Director: {{$movie->director}}</p>
                    <a href="{{ route('new_booking', ['theater_id' => $theater->id, 'movie_id' => $movie->id]) }}" class="btn btn-primary">
                        <img src="/home/img/logo 102.png" class="img-fluid" alt="">
                        <p>Tickets</p>
                    </a>
                </div>
            </div>
        </div>
        
        @endforeach
    </div>
    @else
        <div class="centerhead pt-5 mt5">
            <h1>There is No Movies to Show in {{$theater->name}}</h1>
        </div>
    @endif
        
</div>
@endsection