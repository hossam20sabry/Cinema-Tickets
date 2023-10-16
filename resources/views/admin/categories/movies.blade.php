@extends('admin.parts.css')
@section('head_name', 'Movies Category '.$category->title)
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
          </div>
          <div class="row content_center">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">{{$category->title}} Movies</h4>
                    </p>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr >
                            <th>Name</th>
                            <th>info</th>
                            <th>rating</th>
                            <th>kind</th>
                            <th>release date</th>
                            {{-- <th>category</th> --}}
                            <th>duration</th>
                            <th>language</th>
                            <th>poster</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($category->movies as $movie)
                            <tr>
                              <td>{{$movie->name}}</td>
                              <td><a class="badge badge-warning" href="{{route('movies.show', $movie->id)}}">info</a></td>
                              <td>{{$movie->rating}}</td>
                              @php $ch=0; @endphp
                              <td>@foreach($movie->kinds as $kind) @php $ch++; @endphp @if($ch != 1) , @endif {{$kind->title}} @endforeach</td>
                              <td>{{$movie->release_date}}</td>
                              {{-- <td>{{$movie->category->title}}</td> --}}
                              <td>{{$movie->duration}}</td>
                              <td>{{$movie->lang}}</td>
                              <td class="img-center"><img src="{{asset('/posters/'.$movie->poster_url)}}" alt=""></td>

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
              // processData: false,
              // contentType: false,
              // cache: false,
              success: function(data){
                  if(data.status == true){
                      $('#success').show();
                      $('.movieRow'+data.id).remove();
                  }
              },
              error: function(data){
                  
              }
          })
      })
  </script>
  </body>
</html>