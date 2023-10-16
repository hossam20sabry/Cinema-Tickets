@extends('home.user_layout')
@section('title', 'Movies')
@section('style', '/home/css/movies-page.css')



@section('movies_page')
<div class=" text-sm-start py-2">
    <div class="container pt-3 main_size">
        <h1 class="head-title text-center text-sm-start py-1 mb-3">movies</h1>

        <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 g-4" id="movies-page">


            @foreach ($movies as $key => $movie)
            <div class="col relative">
                <div class="card" style="border: none">
                    <img src="photos/{{$movie->photo_url}}" class="card-img-top" alt="...">
                    <div class="card-body" style="--bs-card-spacer-y: 1rem; --bs-card-spacer-x: 0rem">
                        <h5 class="card-title">{{$movie->name}}</h5>
                        {{-- <p class="card-text capi">Duration: {{$movie->duration}}<br>Director: {{$movie->director}}</p> --}}
                        <p class="card-text red capi">Number: <span>{{$key + 1}}</span></p>
                        <a href="{{ route('new_booking', $movie->id) }}" class="btn btn-primary">
                            <img src="{{asset('home/img/logo 102.png')}}" class="img-fluid" alt="..">
                            <p>Tickets</p>
                        </a>
                    </div>
                        
                </div>
            </div>
            @if($key == 4) @php break @endphp @endif
            @endforeach



            
            
        </div>

            
    </div>
</div>
@endsection