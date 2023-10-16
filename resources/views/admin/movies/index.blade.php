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
            <div class="alert alert-success" id="success" style="display: none">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    x
                </button>
                movie is deleted successfully
            </div>
            <div class="alert alert-success" id="explore_success" style="display: none">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                  x
              </button>
              movie is added to explore successfully
          </div>
          </div>
          <div class="row content_center">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Show Movies Table</h4>
                    </p>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr >
                            <th>Name</th>
                            <th>info</th>
                            <th>Renevues</th>
                            <th>explore</th>
                            <th>update</th>
                            <th>delete</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($movies as $movie)
                            <tr class="movieRow{{$movie->id}}"> 
                              <td>{{$movie->name}}</td>
                              <td><a class="badge badge-warning" href="{{route('movies.show', $movie->id)}}">info</a></td>
                              <td>@if(!$movie->movie_renevues)$0 @else ${{$movie->movie_renevues}}@endif</td>
                              <td>
                                @if($movie->explore == '1')
                                  <a class="badge badge-danger delete_explore"href="{{route('delete_explore', $movie->id)}}" >Rm explore</a>
                                @else
                                  <a class="badge badge-info add_to_explore"href="{{route('add_to_explore', $movie->id)}}">explore</a>
                                @endif
                              </td>
                              <td>
                                <a href="{{route('movies.edit', $movie->id)}}" class="badge badge-success">update</a>
                              </td>
                              <td>
                                  <a  movie_id="{{$movie->id}}"  class="btn btn-danger delete_movie">delete</a>
                              </td>
                            </tr>
                          @endforeach
                          
                        </tbody>
                      </table>
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
    <script>
      $(document).on('click','.delete_movie',function(e){
          e.preventDefault();
          var movie_id = $(this).attr('movie_id');
          $.ajax({
              type: "POST",
              enctype: 'multipart/form-data',
              url: "{{route('movies.delete')}}",
              data: {
                  '_token': "{{csrf_token()}}",
                  'id': movie_id,
              },
              success: function(data){
                  if(data.status == true){
                      $('#success').show();
                      $('.movieRow'+data.id).remove();
                  }
              },
              error: function(data){
                  
              }
          })
      });

      
  </script>
  </body>
</html>