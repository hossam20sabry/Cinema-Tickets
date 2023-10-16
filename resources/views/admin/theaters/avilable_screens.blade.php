@extends('admin.parts.css')
@section('head_name', $theater->name.' screens')
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
          
          <div class="row content_center">
            
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <h1 class="text-capitalize mx-3">{{$theater->name}} screens</h1>
                  <div class="card-body"> 
                    @if(count($screens) > 0)
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>screen</th>
                            <th>screen number</th>
                            <th>total rows</th>
                            <th>total columns</th>
                            <th>Seat Price</th>
                            <th>update</th>
                            <th>delete</th>
                          </tr>
                        </thead>
                        <tbody>

                          @foreach ($screens as $screen)
                          <tr>
                            <td>
                              <a href=" {{ route('screen.show', $screen->id) }} " class="btn btn-primary">show</a>
                            </td>
                            <td>{{$screen->screen_number}}</td>
                            <td>{{$screen->total_rows}}</td>
                            <td>{{$screen->total_columns}}</td>
                            <td>{{$screen->seats->first()->price}}</td>
                            <td><a href=" {{ route('screen.edit', $screen->id) }} " class="btn btn-success">update</a></td>
                            <td><a href=" {{ route('screen.destroy', $screen->id) }} " onclick="return confirm('are you sure')" class="btn btn-danger">delete</a></td>
                          </tr>
                          @endforeach   
                          
                        </tbody>
                      </table>
                    </div>
                    @else
                    <h1>No screens</h1>
                    @endif
                  </div>
                </div>
              </div>
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