@extends('admin.parts.css')
@section('head_name', 'Theaters')
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
          {{-- <div class="container mt-3">
            @if(session()->has('message'))
            <div class="alert alert-danger ">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    x
                </button>
                {{session()->get('message')}}
            </div>
            @endif
        </div> --}}
          <div class="row content_center">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Show Theaters Table</h4>
                    </p>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Theater Info</th>
                            <th>screens</th>
                            <th>add movies</th>
                            <th>add screens</th>
                            <th>update</th>
                            <th>delete</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($theaters as $theater)
                            <tr>
                                <td>{{$theater->name}}</td>
                                <td><a href="{{ route('theater.info', $theater->id) }}" class="badge badge-info">Info</a></td>
                                <td>
                                  <a href="{{ url('screens', $theater->id) }}" class="badge badge-warning">screens</a>
                                </td>
                                <td>
                                  <a href="{{ url('avilable_movies', $theater->id) }}" class="badge badge-info">avilable movies</a>
                                </td>
                                <td>
                                <a href="{{ route('screen.create', $theater->id) }}" class="badge badge-warning">add screen</a>
                                </td>
                                <td>
                                    <a href="{{route('theaters.edit', $theater->id)}}" class="badge badge-success">update</a>
                                </td>
                                <td>
                                    <form action="{{route('theaters.destroy', $theater->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirmDelete()"  class="btn btn-danger">delete</button>
                                    </form>
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

    @if(session()->has('message'))
    <script>
      toastr.success("{!! session()->get('message') !!}");
    </script>
    @endif

    @if(session()->has('message'))
    <script>
      swal("Every thing is working", "{!! session()->get('message') !!}", "success",{
        button: "ok",
      });
    </script>
    @endif

    

    

  </body>
</html>