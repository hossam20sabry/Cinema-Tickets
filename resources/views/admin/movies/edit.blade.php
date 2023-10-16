@extends('admin.parts.css')
@section('head_name', 'Update '.$movie->name)
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
                    movie is updated successfully
                </div>
            </div>
           <div class="row content_center px-5">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">update {{$movie->name}}</h4>



                    <form class="forms-sample" id="movie_update" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="movie_id" name="movie_id" value="{{$movie->id}}">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text"  class="form-control" name="name" id="name" placeholder="Name" value="{{{$movie->name}}}">
                        </div>
                        <div class="form-error">
                            <p class="text-danger mb-3" id="name_error"></p>
                        </div>


                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input type="text"  class="form-control" name="duration" id="duration" placeholder="Duration" value="{{$movie->duration}}">
                        </div>
                        <div class="form-error">
                            <p class="text-danger mb-3" id="duration_error"></p>
                        </div>
                        

                        <div class="form-group">
                            <label for="director">Director</label>
                            <input type="text"  class="form-control" name="director" id="director" placeholder="director" value="{{$movie->director}}">
                        </div>
                        <div class="form-error">
                            <p class="text-danger mb-3" id="director_error"></p>
                        </div>

                        
                        <div class="form-group">
                            <label for="lang">Langnuage</label>
                            <input type="text"  class="form-control" name="lang" id="lang" placeholder="lang" value="{{$movie->lang}}">
                        </div>
                        <div class="form-error">
                            <p class="text-danger mb-3" id="lang_error"></p>
                        </div>
                        

                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <input type="text"  class="form-control" name="rating" id="rating" placeholder="rating" value="{{$movie->rating}}">
                        </div>
                        <div class="form-error">
                            <p class="text-danger mb-3" id="rating_error"></p>
                        </div>
                        
                        <div class="form-group">
                            <label for="kind">kind</label>
                            <select class="form-control"  id="kind" name="kind[]" multiple>
                            @foreach($movie->kinds as $kind)
                            <option value="{{$kind->id}}" selected>{{$kind->title}}</option>
                            @endforeach
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
                            @foreach($categories as $category)
                            <option @if($category->id == $movie->category->id) selected @endif value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-error">
                            <p class="text-danger mb-3" id="category_error"></p>
                        </div>
                        

                        <div class="form-group">
                            <label for="release_date">Release Date</label>
                            <input type="date"  class="form-control" name="release_date" id="release_date" placeholder="release_date"  value="{{$movie->release_date}}">
                        </div>
                        <div class="form-error">
                            <p class="text-danger mb-3" id="release_date_error"></p>
                        </div>



                        <div class="form-group ">
                            <label for="poster_url">Current Poster Url</label>
                            <img src="/posters/{{$movie->poster_url}}" class="poster-size" alt="" id="poster_url">
                        </div>
                        <div class="form-group ">
                            <label for="poster_url">Poster Url</label>
                            <input type="file"  class="form-control" id="poster_url" name="poster_url"  value="{{$movie->poster_url}}">
                        </div>
                        <div class="form-error">
                            <p class="text-danger mb-3" id="poster_url_error"></p>
                        </div>



                        <div class="form-group ">
                            <label for="photo_url">Current Photo Url</label>
                            <img src="/photos/{{$movie->photo_url}}" alt="" class="photo-size" id="photo_url">
                        </div>
                        <div class="form-group ">
                            <label for="photo_url">Photo Url</label>
                            <input type="file"  class="form-control" id="photo_url" name="photo_url"  value="{{$movie->photo_url}}">
                        </div>
                        <div class="form-error">
                            <p class="text-danger mb-3" id="photo_url_error"></p>
                        </div>



                        <div class="form-group ">
                            <label for="trailer_url">Current Trailer Url</label>
                            <iframe src="/trailers/{{$movie->trailer_url}}"id="trailer_url" name="trailer_url" title="MOVIE TRAILER" allowfullscreen></iframe>
                        </div>
                        <div class="form-group">
                            <label for="trailer_url">Trailer Url</label>
                            <input type="file"  class="form-control" id="trailer_url" name="trailer_url"  value="{{$movie->trailer_url}}">
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
        $("#movie_update").submit( function(e){
            e.preventDefault();
            console.log('hi');
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
            let formData = new FormData(document.getElementById('movie_update'));


            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "{{route('movies.update')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data){
                    if(data.status == true){
                        $('#success').show();
                    }
                },
                error: function(reject){
                    let response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, value){
                        $("#"+key+"_error").text(value);
                    })
                }
            })
        });
    
    
    </script>

  </body>
</html>