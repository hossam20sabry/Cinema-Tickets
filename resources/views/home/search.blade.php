@extends('home.user_layout')
@section('title', ' Movies')
@section('style', '/home/css/movies-page.css')



@section('movies_page')
<div class="text-sm-start py-2 main_size">
    @if(count($movies) > 0 || count($theaters) > 0)
    <div class="container pt-3">
        @if(count($movies) > 0)
        <h1 class="head-title text-center text-sm-start py-1 mb-3">movies</h1>

        <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 g-4" id="movies-page">
            
            @foreach ($movies as $movie)
            <div class="col relative">
                <div class="card" style="border: none">
                    <img src="{{asset('/photos/'.$movie->photo_url)}}" class="card-img-top" alt="...">
                    <div class="card-body" style="--bs-card-spacer-y: 1rem; --bs-card-spacer-x: 0rem">
                        <h5 class="card-title">{{$movie->name}}</h5>
                        <p class="card-text capi">Duration: {{$movie->duration}}<br>Director: {{$movie->director}}</p>
                        <a href="{{ route('new_booking', $movie->id) }}" class="btn btn-primary">
                            <img src="{{asset('/home/img/logo 102.png')}}" class="img-fluid" alt="">
                            <p>Tickets</p>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            <div>
                {!! $movies->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
            
        </div>
        @endif
        @if(count($theaters) > 0)
            <h1 class="head-title text-center text-sm-start">cenimas</h1>
            <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 g-4" id="movies-page">
                
                @foreach($theaters as $theater)
                <div class="col relative">
                    <a href="{{route('theaters.show', $theater->id)}}" class="card" style="border: none">
                        <img src="/cinema_photos/{{$theater->img}}" class="card-img-top" alt="...">
                        <div class="card-body" style="--bs-card-spacer-y: 1rem; --bs-card-spacer-x: 0rem">
                            <h5 class="card-title">{{$theater->name}}</h5>
                            <p class="card-text">Address: <span class="text-uppercase">{{$theater->city}} - {{$theater->location}}</span></p>
                        </div>
                    </a>    
                </div>
                @endforeach
                <div>
                    {!! $theaters->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        @endif    
    </div>
    @else
    <h1 class="text-center">No Result</h1>
    @endif
    
</div>
@endsection