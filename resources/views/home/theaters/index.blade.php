@extends('home.user_layout')
@section('title', 'Theaters')
@section('style', '/home/css/movies-page.css')


@section('cinema_page')
<div class=" text-sm-start py-2 minHeight">
    <div class="container pt-3 " >
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
            



            
            
        </div>
    </div>
</div>
@endsection