@extends('admin.parts.css')
@section('head_name',' Kind-Create')
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
                <div class="alert alert-success" id="message" style="display: none">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        x
                    </button>
                    created successfully
                </div>
            </div>
           <div class="row content_center px-5">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">update {{$category->title}}</h4>

                    <form class="forms-sample" id="showTimeForm">
                        @csrf
                        <input type="hidden" name="category_id" id="category_id" value="{{$category->id}}">
                        <div class="form-group">
                            <label for="title">title</label>
                            <input  type="text"  class="form-control mystyle" name="title" id="title" placeholder="title" value="{{$category->title}}">
                        </div>
                        <div class="form-error">
                            <p class="text-danger mb-3" id="title_error"></p>
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
        $("#showTimeForm").submit(function(e){
            e.preventDefault();
            $('#title_error').text('');
            let title = $("#title").val();
            let category_id = $("#category_id").val();
            let _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{route('category.update')}}",
                method: "POST",
                data: {
                    title: title,
                    category_id: category_id,
                    _token: _token
                },
                success: function(data){
                    if(data.status === true){
                        $("#message").show();
                        // $("#showTimeForm")[0].reset();
                    }
                },
                error: function(reject){
                    let response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, value){
                        $("#"+key+"_error").text(value);
                    })
                }
            })
        })
    </script>
  </body>
</html>