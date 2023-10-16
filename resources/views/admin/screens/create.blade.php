@extends('admin.parts.css')
@section('head_name', $theater->name.' Create Screen')
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
                @if(session()->has('error'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        x
                    </button>
                    {{session()->get('error')}}
                </div>
                @endif
            </div>
           <div class="row content_center px-5">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Create Screen in {{$theater->name}}</h4>

                    <form class="forms-sample" method="POST" action="{{ route('screen.store') }}">
                        @csrf
                        <input type="hidden" name="theater_id" value="{{$theater_id}}">
                        <div class="form-group">
                            <label for="screen_number">screen_number</label>
                            <input  type="text"  class="form-control mystyle" name="screen_number" id="screen_number" placeholder="screen_number" value="{{old('screen_number')}}">
                            
                        </div>
                        @error('screen_number')
                        <div class="form-error">
                            <p class="text-danger mb-3">{{$message}}</p>
                        </div>
                        @enderror
                        

                        

                        <div class="form-group">
                            <label for="total_rows">total_rows</label>
                            <input  type="text"  class="form-control mystyle" name="total_rows" id="total_rows" placeholder="total_rows" value="{{old('total_rows')}}">
                            
                        </div>
                        @error('total_rows')
                        <div class="form-error">
                            <p class="text-danger mb-3">{{$message}}</p>
                        </div>
                        @enderror

                        <div class="form-group">
                            <label for="total_columns">total_columns</label>
                            <input  type="text"  class="form-control mystyle" name="total_columns" id="total_columns" placeholder="total_columns" value="{{old('total_columns')}}">
                            
                        </div>
                        @error('total_columns')
                        <div class="form-error">
                            <p class="text-danger mb-3">{{$message}}</p>
                        </div>
                        @enderror

                        
                        

                        <div class="form-group">
                            <label for="seat_price">seat_price</label>
                            <input  type="text"  class="form-control mystyle" name="seat_price" id="seat_price" placeholder="seat_price" value="{{old('seat_price')}}">
                            
                        </div>
                        @error('seat_price')
                        <div class="form-error">
                            <p class="text-danger mb-3">{{$message}}</p>
                        </div>
                        @enderror
                        
                        
                        
                        
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{ url('screens', $theater->id) }}" class="btn btn-dark">Screens</a>
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