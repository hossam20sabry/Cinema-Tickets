
@extends('home.user_layout')
@section('title', 'Cinema Tickets')
@section('style', '/home/css/main.css')


@section('main')
<section id="banner">
    <h2>Welcome to our Cinemas</h2>
    <p>Book your favorite movies now and enjoy your time at our cinemas.</p>
    <!-- <a href="./movie-page.html">View Movies</a> -->
</section>

<section id="movies" class="contain">
    <button id="left-arrow" class="left_arrow"><</button>
    <button id="right-arrow" class="right_arrow">></button>
    <h2 class="main">MOVIES</h2>
    <div id="movie-container" class="movie_container">
        @foreach ($explores as $key => $movie)
        <div class="movie_card">
            <div class="head">
                <img src="/photos/{{ $movie['photo_url'] }}">
            </div>
            <div class="tail">
                <div class="left">
                    <h2 class="hh2 text-uppercase">{{ $movie['name'] }}</h2>
                    <p>Duration: {{ $movie['duration'] }}</p>
                    <p class="text-capitalize">Director: {{ $movie['director'] }}</p>
                </div>
                <div class="right">
                    <a href="{{ route('new_booking', $movie->id) }}">
                        <img src="{{asset('home/img/logo 102.png')}}" class="img-fluid" alt="">
                        <p class="@if(!Auth::user()) pt-3 @endif">Tickets</p>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
        
    </div>
    
</section>

<section id="theater" class="contain bg">
    <button id="theater-left-arrow" class="left_arrow"><</button>
    <button id="theater-right-arrow" class="right_arrow">></button>
    <h2 class="main">THEATERS</h2>
    <div id="theater-container" class="movie_container">
        @foreach ($theaters as $theater)
        <div class="movie_card">
            <a href="{{route('theaters.show', $theater->id)}}">
            <div class="head">
                <img src="/cinema_photos/{{$theater->img}}">
            </div>
            <div class="tail">
                <div class="left">
                    <h2 class="hh2 text-uppercase">{{ $theater->name }}</h2>
                    <p class="card-text">Address: <span class="text-uppercase">{{$theater->city}} - {{$theater->location}}</span></p>
                </div>
                <div class="right">
                    
                </div>
            </div>
            </a>
        </div>
        @endforeach
        
    </div>
    
</section>


<script>
    const movieContainer = document.getElementById("movie-container");
    const leftArrow = document.getElementById("left-arrow");
    const rightArrow = document.getElementById("right-arrow");

    const theaterContainer = document.getElementById("theater-container");
    const theater_leftArrow = document.getElementById("theater-left-arrow");
    const theater_rightArrow = document.getElementById("theater-right-arrow");

    let scrollPosition = 0;

    leftArrow.addEventListener("click", () => {
        scrollPosition -= 400;
        movieContainer.scrollTo({
            left: scrollPosition,
            behavior: "smooth"
        });
    });
    rightArrow.addEventListener("click", () => {
        scrollPosition += 400;
        movieContainer.scrollTo({
            left: scrollPosition,
            behavior: "smooth"
        });
    }); 
    

    theater_leftArrow.addEventListener("click", () => {
        scrollPosition -= 400;
        theaterContainer.scrollTo({
            left: scrollPosition,
            behavior: "smooth"
        });
    });
    theater_rightArrow.addEventListener("click", () => {
        scrollPosition += 400;
        theaterContainer.scrollTo({
            left: scrollPosition,
            behavior: "smooth"
        });
    }); 


</script>
{{-- <div id="movies-carousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($explores as $key => $movie)
            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                <img src="/photos/{{ $movie['photo_url'] }}" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <h5 class="card-title">{{ $movie['name'] }}</h5>
                    <p class="card-text">Duration: {{ $movie['duration'] }} | Director: <span class="text-capitalize">{{ $movie['director'] }}</span></p>
                    <p><a href=" {{ route('new_booking', ['movie_id' => $movie->id]) }} " class="btn  mt-3">Book Now</a></p>
                </div>
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#movies-carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#movies-carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div> --}}
@endsection


