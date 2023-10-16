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
                    <h4 class="card-title">Create Screen</h4>

                    <form class="forms-sample" method="POST" action="{{ route('screen.update', $screen->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="screen_number">screen_number</label>
                            <input  type="text"  class="form-control mystyle" name="screen_number" id="screen_number" placeholder="screen_number" value="{{$screen->screen_number}}">
                            
                        </div>
                        @error('screen_number')
                        <div class="form-error">
                            <p class="text-danger mb-3">{{$message}}</p>
                        </div>
                        @enderror
                        
                        <div class="form-group">
                            <label for="seat_price">seat_price</label>
                            <input  type="text"  class="form-control mystyle" name="seat_price" id="seat_price" placeholder="seat_price" value="{{$seat_price}}">
                            
                        </div>
                        @error('seat_price')
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
    @include('admin.parts.script')
  </body>
</html>