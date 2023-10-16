@extends('admin.parts.css')
@section('head_name', 'Movies')
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
                category is deleted successfully

            </div>
          </div>
          <div class="row content_center">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Kinds</h4>
                    @if(count($kinds) > 0)
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr >
                            <th>Name</th>
                            <th>movies</th>
                            <th>update</th>
                            <th>delete</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($kinds as $kind)
                            <tr class="kindRow{{$kind->id}}">
                                <td>{{$kind->title}}</td>
                                <td><a href="{{route('kind.movies', $kind->id)}}" class="btn btn-primary">movies</a></td>
                                <td><a href="{{route('kind.edit', $kind->id)}}" class="btn btn-success update">update</a></td>
                                <td><a kind_id="{{$kind->id}}" class="delete btn btn-danger ">delete</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                    @else
                    <h2>No Kinds</h2>
                    @endif
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
        $('.delete').click(function(e){
            e.preventDefault();
            let kind_id = $(this).attr('kind_id');
            $.ajax({
                type: "POST",
                url: "{{route('kind.destroy')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'kind_id': kind_id,
                },
                success: function(data){
                    if(data.status == true){
                        $('#success').show();
                    }
                    $('.kindRow'+data.kind_id).remove();
                }
            })
        });
    </script>
  </body>
</html>