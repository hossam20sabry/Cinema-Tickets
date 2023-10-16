@extends('admin.parts.css')
@section('head_name', 'Create Theaters')
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
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        x
                    </button>
                    {{session()->get('message')}}
                </div>
                @endif
            </div>
           <div class="row content_center px-5">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Create Theater</h4>

                    <form class="forms-sample" method="POST" action="{{ route('theaters.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input  type="text"  class="form-control mystyle" name="name" id="name" placeholder="Name" value="{{old('name')}}">
                            
                        </div>
                        @error('name')
                        <div class="form-error">
                            <p class="text-danger mb-3">{{$message}}</p>
                        </div>
                        @enderror
                        

                        <div class="form-group">
                            <label for="location">location</label>
                            <input  type="text"  class="form-control mystyle" name="location" id="location" placeholder="location" value="{{old('location')}}">
                        </div>
                        @error('location')
                        <div class="form-error">
                            <p class="text-danger mb-3">{{$message}}</p>
                        </div>
                        @enderror
                        

                        
                        
                        <div class="form-group">
                            <label for="city">city</label>
                            <input  type="text"  class="form-control mystyle" name="city" id="city" placeholder="city" value="{{old('city')}}">
                        </div>
                        @error('city')
                        <div class="form-error">
                            <p class="text-danger mb-3">{{$message}}</p>
                        </div>
                        @enderror
                        
                        
                        <div class="form-group">
                            <label for="phone">phone</label>
                            <input  type="text"  class="form-control mystyle" name="phone" id="phone" placeholder="phone" value="{{old('phone')}}">
                        </div>
                        @error('phone')
                        <div class="form-error">
                            <p class="text-danger mb-3">{{$message}}</p>
                        </div>
                        @enderror
                        
                        
                        
                        
                        <div class="form-group">
                            <label for="email">email</label>
                            <input  type="email"  class="form-control mystyle" name="email" id="email" placeholder="email"  value="{{old('email')}}">
                        </div>
                        @error('email')
                        <div class="form-error">
                            <p class="text-danger mb-3">{{$message}}</p>
                        </div>
                        @enderror
                        

                        
                        
                        <div class="form-group">
                            <label for="img">Image</label>
                            <input  type="file"  class="form-control mystyle" id="img" name="img"  value="{{old('img')}}">
                        </div>
                        @error('img')
                        <div class="form-error">
                            <p class="text-danger mb-3">{{$message}}</p>
                        </div>
                        @enderror

                        <div class="form-group">
                            <label for="wide_img">Wide Image</label>
                            <input  type="file"  class="form-control mystyle" id="wide_img" name="wide_img"  value="{{old('wide_img')}}">
                        </div>
                        @error('wide_img')
                        <div class="form-error">
                            <p class="text-danger mb-3">{{$message}}</p>
                        </div>
                        @enderror
                        
                        
                        
                        
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-dark">Cancel</button>
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
    {{-- @if(session()->has('message'))
    <script>
      Swal.fire("Every thing is working", "{!! session()->get('message') !!}", "success",{
        button: "ok",
      });
    </script>
    @endif --}}
    {{-- @if(session()->has('message'))
    <script>
      swal("Every thing is working", "{!! session()->get('message') !!}", "success",{
        button: "ok",
      });
    </script>
    @endif --}}
    @include('admin.parts.script')

  </body>
</html>