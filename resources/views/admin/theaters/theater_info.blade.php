@extends('admin.parts.css')
@section('head_name', $theater->name.' info')
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
        <div class="row content_center">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$theater->name}} info</h4>
                        
                        <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <tr>
                                        <td class="table-info-start">Name</td>
                                        <td class="table-info-start">{{$theater->name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-info-start">location</td>
                                        <td class="table-info-start">{{$theater->location}}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="table-info-start">city</td>
                                        <td class="table-info-start">{{$theater->city}}</td>
                                    </tr>  
                                    <tr>
                                        <td class="table-info-start">phone</td>
                                        <td class="table-info-start">{{$theater->phone}}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-info-start">email</td>
                                        <td class="table-info-start email-text">{{$theater->email}}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-info-start">img</td>
                                        <td ><img src="/cinema_photos/{{$theater->img}}" alt=""></td> 
                                    </tr>
                                </tr>
                            
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
</body>
</html>