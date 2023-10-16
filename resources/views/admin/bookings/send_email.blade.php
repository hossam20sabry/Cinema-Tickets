@extends('admin.parts.css')
@section('head_name', 'Create Movies')
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
                {{-- @if(session()->has('message')) --}}
                <div class="alert alert-success" id="success" style="display: none">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        x
                    </button>
                    movie is created successfully
                    {{-- {{session()->get('message')}} --}}

                </div>
                {{-- @endif --}}
            </div>
           <div class="row content_center px-5">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Send Email to {{$user->email}}</h4>
                    <form class="forms-sample" action="{{route('send_user_email', $user->id)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="greeting">Email Greeting</label>
                            <input type="text"  class="form-control" name="greeting" id="greeting" placeholder="greeting">
                        </div>
                        <div class="form-group">
                            <label for="firstline">First Line</label>
                            <input type="text"  class="form-control" name="firstline" id="firstline" placeholder="firstline">
                        </div>
                        <div class="form-group">
                            <label for="body">Email Body</label>
                            <input type="text"  class="form-control" name="body" id="body" placeholder="body" >
                        </div>
                        <div class="form-group">
                            <label for="button">Email Button name :</label>
                            <input type="text"  class="form-control" name="button" id="button" placeholder="button" >
                        </div>
                        <div class="form-group">
                            <label for="url">Email Url :</label>
                            <input type="text"  class="form-control" name="url" id="url" placeholder="url">
                        </div>
                        <div class="form-group">
                            <label for="lastline">last Line</label>
                            <input type="text"  class="form-control" name="lastline" id="lastline" placeholder="lastline" >
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
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