<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="{{asset('home/bootstrap-5.2.3-dist/css/bootstrap.min.css')}}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('/home/css/style.css')}}">
    <link rel="stylesheet" href="@yield('style')">
    <link rel="icon" href="{{asset('/home/img/logo 102.png')}}">
    <title>@yield('title')</title>
    
</head>
<body>
    <header class="navbar navbar-expand-md text-white fixed-top bg-light navbar_color search_center">
        <div class="container">
            

            
            <div class="collapse navbar-collapse">
                <a href="/" style="width: 40px;
                height: 40px;">
                    <img src="{{asset('/home/img/logo 102.png')}}" style="width: 40px;
                    height: 40px;" class="nav_img img-fluid" alt="">
                </a>
                <ul class="navbar-nav mid ms-auto ul_margin" id="without_login">
                    {{-- <li class="nav-item item_style"><a href="/"  class=" mx-md-3">Home</a></li> --}}
                    <li class="nav-item pl"><a href="{{route('movies.index')}}"  class=" itemColor mx-md-2">Movies</a></li>
                    <li class="nav-item"><a href="{{route('theaters.index')}}"  class=" itemColor mx-md-2">Theaters</a></li>
                    <li class="nav-item"><a href="{{route('movies.top')}}" class=" itemColor mx-md-2">Top 5</a></li>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle itemColor  mx-md-2" href="#"  role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kinds
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($kinds as $kind)
                            <li><a class="dropdown-item" href="{{route('kind.show', $kind->id)}}">{{$kind->title}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>

            <form action="{{route('search')}}" class="d-flex search_form" method="GET">
                @csrf
                <input class="form-control search_input typeahead" style="
                    margin-right: 0rem !important;
                    padding: 3px 0 3px 9px;
                    border: none;
                    border-top-left-radius: 5px;
                    border-top-right-radius: 0px;
                    border-bottom-right-radius: 0px;
                    " type="search" placeholder="Movies, Theaters..." name="search" aria-label="Search">
                <button class="btn btn-outline-primary" style="
                background-color: #2980b9;
                color: white;
                border: none;
                border-bottom-right-radius: 5px;
                border-bottom-left-radius: 0;
                border-top-right-radius: 0px;
                border-top-left-radius: 0;
                cursor: pointer;
                padding: 3px 10px;
                " type="submit">Search</button>
            </form>

            @if (Route::has('login'))
            @auth
                <x-app-layout>

                </x-app-layout>
            @else
            <button class="navbar-toggler" 
                type="button" 
                data-bs-toggle="collapse"  
                data-bs-target="#mainMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainMenu">
                
                <ul class="navbar-nav ms-auto" id="without_login">
                    <li class="nav-item"><a href="{{ route('login') }}" class="btn btn-outline-light  my-1 mx-md-1">Log in</a></li>
                    <li class="nav-item"><a href="{{ route('register') }}" class="btn btn-light  my-1 mx-md-1">Register</a></li>
                </ul>
            </div>
            @endauth
            @endif
            
        </div>
    </header>
    
    @yield('main')
    @yield('movies_page')
    @yield('cinema_page')
    @yield('show_theater')
    @yield('ajax_test')
    @yield('booking_content')
    @yield('Booking_Revision')
    @yield('booking_index')

    <footer>
        <p>&copy; 2023 Cinema Booking Website. All rights reserved.</p>
    </footer>
    

    {{-- <script src="{{asset('home/bootstrap-5.2.3-dist/js/bootstrap.min.js')}}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    @yield('ajax_script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{asset('/jquery-3.7.1.min.js')}}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script> --}}
    

    {{-- <script>
        var path = "{{route('auto_search')}}";
        $('input.typeahead').typeahead({
            source: function(terms, process){
                return $.get(path, {terms:terms}, function(data){
                    return process(data);
                });
            }
        });
    </script> --}}
</body>
</html>