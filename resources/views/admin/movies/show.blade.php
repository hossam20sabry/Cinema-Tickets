@extends('admin.parts.css')
@section('head_name', 'Movies')
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
          </div>
          <div class="row content_center">
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">{{$movie->name}} info</h4>
                    </p>
                    <div class="table-responsive">
                      <table class="table">
                        <tbody>
                            <tr>
                              <td class="table-info-start">Name</td>
                              <td class="table-info-start">{{$movie->name}}</td>
                            </tr> 
                            <tr> 
                              <td class="table-info-start">rating</td>
                              <td class="table-info-start">{{$movie->rating}}</td>
                            </tr>
                            <tr>  
                              <td class="table-info-start">kind</td>
                              <td class="table-info-start">@foreach($movie->kinds as $kind) {{$kind->title}}, @endforeach</td>
                            </tr>
                            <tr>  
                              <td class="table-info-start">release date</td>
                              <td class="table-info-start">{{$movie->release_date}}</td>
                            </tr>
                            <tr>  
                              <td class="table-info-start">category</td>
                              <td class="table-info-start">{{$movie->category->title}}</td>
                            </tr>
                            <tr>  
                              <td class="table-info-start">duration</td>
                              <td class="table-info-start">{{$movie->duration}}</td>
                            </tr>
                            <tr>  
                              <td class="table-info-start">language</td>
                              <td class="table-info-start">{{$movie->lang}}</td>
                            </tr>
                            <tr>  
                              <td class="table-info-start">Renevue</td>
                              <td class="table-info-start">${{$movie->movie_renevues}}</td>
                            </tr>
                            {{-- <tr>  
                              <td class="table-info-start">poster</td>
                              <td class="img-center"><img src="{{asset('/posters/'.$movie->poster_url)}}" alt=""></td>
                            </tr> --}}
                          
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <img src="{{asset('/posters/'.$movie->poster_url)}}" class="img-fluid admin_poster"  alt="...">
                  </div>
                </div>
              </div>

              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <img src="{{asset('/photos/'.$movie->photo_url)}}" class="img-fluid admin_photo"  alt="...">
                  </div>
                </div>
              </div>

              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="ratio  admin_trailer">
                      <iframe src="{{asset('/trailers/'.$movie->trailer_url)}}" title="MOVIE TRAILER" allowfullscreen></iframe>
                  </div>
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