@extends('admin.parts.css')
@section('head_name', 'avilable movies in'.' '.$theater->name )
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
            @if(session()->has('message'))
            <div class="alert alert-danger ">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    x
                </button>
                {{session()->get('message')}}
            </div>
            @endif
        </div>
          <div class="row content_center">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card px-5">
                  <div class="card-body ">
                    <h4 class="card-title px-5">Show {{$theater->name}} Table</h4>
                    
                    <div class="table-responsive px-5">
                    <form action="{{url('add_avilable_movies', $theater->id)}}" method="post">
                    @csrf
                      <table class="table ">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Select</th>
                            <th>add show Times</th>
                            <th>avilable showtimes</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                          @foreach($movies as $movie)
                            <tr>
                              <td>{{$movie->name}}</td>
                              <td>
                                @php
                                    $movieExistsInTheaters = false; // Initialize the flag
                                    $movie_theater_id = 0;
                                @endphp
                                @foreach($movies_theaters as $movie_theater)
                                  @if($movie->id == $movie_theater->movie_id)
                                  @php
                                    $movieExistsInTheaters = true;
                                    $movie_theater_id = $movie_theater->id;
                                  @endphp
                                  @break
                                  @endif
                                @endforeach
                                @if($movieExistsInTheaters)
                                <a href="{{url('delete_avilable_movies', $movie_theater_id)}}" class="btn btn-danger">delete</a>
                                @else
                                  <input type="checkbox" name="movies_ids[]" value="{{$movie->id}}">
                                @endif
                                  
                              </td>
                              <td>
                                @if($movieExistsInTheaters)
                                <a href="{{route('showtime.create',['movie_id' => $movie->id, 'theater_id' => $theater->id])}}" class="btn btn-primary"> add show times</a>
                                @endif
                              </td>
                              <td>
                                @if($movieExistsInTheaters)
                                <a href="{{route('showtime.show', ['movie_id' => $movie->id, 'theater_id' => $theater->id])}}" class="btn btn-warning">showtimes</a>
                                @endif
                              </td>

                            </tr>
                          @endforeach
                          
                        </tbody>
                      </table>
                    </div>
                    <div class="center-buuton">
                    <button type="submit" class="btn btn-primary">submit seleted</button>
                    </div>
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
  </body>
</html>