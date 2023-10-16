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
                    <h4 class="card-title">Create Movies</h4>

                    <form class="forms-sample" id="create_movie" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text"  class="form-control" name="name" id="name" placeholder="Name" value="{{old('name')}}">
                        </div>
                        
                        <div class="form-error">
                            <p class="text-danger mb-3" id="name_error"></p>
                        </div>
                        
                        

                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input type="text"  class="form-control" name="duration" id="duration" placeholder="Duration" value="{{old('duration')}}">
                        </div>
                        
                        <div class="form-error">
                            <p class="text-danger mb-3" id="duration_error"></p>
                        </div>
                       

                        <div class="form-group">
                            <label for="director">Director</label>
                            <input type="text"  class="form-control" name="director" id="director" placeholder="director" value="{{old('director')}}">
                        </div>
                        
                        <div class="form-error">
                            <p class="text-danger mb-3" id="director_error"></p>
                        </div>
                        

                        <div class="form-group">
                            <label for="lang">Langnuage</label>
                            <input type="text"  class="form-control" name="lang" id="lang" placeholder="lang" value="{{old('lang')}}">
                        </div>
                        
                        <div class="form-error">
                            <p class="text-danger mb-3" id="lang_error"></p>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <input type="decimal" min="1.0" max="10.0"  class="form-control" name="rating" id="rating" placeholder="rating" value="{{old('rating')}}">
                        </div>
                        
                        <div class="form-error">
                            <p class="text-danger mb-3" id="rating_error"></p>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="kind">kind</label>
                            <select class="form-control"  id="kind" name="kind[]" multiple>
                            @foreach($kinds as $kind)
                            <option value="{{$kind->id}}">{{$kind->title}}</option>
                            @endforeach
                            </select>
                        </div>
                        
                        <div class="form-error">
                            <p class="text-danger mb-3" id="kind_error"></p>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control"  id="category" name="category">
                            <option value="">Select Category </option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                            </select>
                        </div>
                        
                        <div class="form-error">
                            <p class="text-danger mb-3" id="category_error"></p>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="release_date">Release Date</label>
                            <input type="date"  class="form-control" name="release_date" id="release_date" placeholder="release_date"  value="{{old('release_date')}}">
                        </div>
                        
                        <div class="form-error">
                            <p class="text-danger mb-3" id="release_date_error"></p>
                        </div>
                        
                        
                        <div class="form-group ">
                            <label for="poster_url">Poster Url</label>
                            <input type="file"  class="form-control" id="poster_url" name="poster_url"  value="{{old('poster_url')}}">
                        </div>
                        
                        <div class="form-error">
                            <p class="text-danger mb-3" id="poster_url_error"></p>
                        </div>
                        
                        
                        <div class="form-group ">
                            <label for="photo_url">Photo Url</label>
                            <input type="file"  class="form-control" id="photo_url" name="photo_url"  value="{{old('photo_url')}}">
                        </div>
                        
                        <div class="form-error">
                            <p class="text-danger mb-3" id="photo_url_error"></p>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="trailer_url">Trailer Url</label>
                            <input type="file"  class="form-control" id="trailer_url" name="trailer_url"  value="{{old('trailer_url')}}">
                        </div>
                        
                        <div class="form-error">
                            <p class="text-danger mb-3" id="trailer_url_error"></p>
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
    <script>
        $('#create_movie').submit( function(e){
            e.preventDefault();
            $('#name_error').text('');
            $('#duration_error').text('');
            $('#director_error').text('');
            $('#lang_error').text('');
            $('#rating_error').text('');
            $('#kind_error').text('');
            $('#category_error').text('');
            $('#release_date_error').text('');
            $('#poster_url_error').text('');
            $('#photo_url_error').text('');
            var formData = new FormData($('#create_movie')[0]); 
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "{{route('movies.store')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data){
                    if(data.status == true){
                        $('#success').show();
                        $('#create_movie')[0].reset();
                    }
                },
                error: function(reject){
                    let response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, value){
                        $("#"+key+"_error").text(value);
                    })
                }
            });
        });
    </script>
  </body>
</html>