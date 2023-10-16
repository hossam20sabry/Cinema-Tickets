@section('head_name', 'Dashboard')
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
        <div class="main-panel mt-2" style="background-color: black;">
            <div class="main2 m-2">

            
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">${{$totalPrice}}</h3>
                                <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>
                            </div>
                            </div>
                            <div class="col-3">
                            <div class="icon icon-box-success ">
                                <span class="mdi mdi-arrow-top-right icon-item"></span>
                            </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Total Renevue Today</h6>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">${{$totalPriceWeek}}</h3>
                                <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>
                            </div>
                            </div>
                            <div class="col-3">
                            <div class="icon icon-box-success ">
                                <span class="mdi mdi-arrow-top-right icon-item"></span>
                            </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Total Renevue Last Week</h6>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">${{$totalPriceMonth}}</h3>
                                <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>
                            </div>
                            </div>
                            <div class="col-3">
                            <div class="icon icon-box-success ">
                                <span class="mdi mdi-arrow-top-right icon-item"></span>
                            </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Total Renevue Last Month</h6>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{$movies_count}}</h3>
                                <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>
                            </div>
                            </div>
                            <div class="col-3">
                            <div class="icon icon-box-success ">
                                <span class="mdi mdi-arrow-top-right icon-item"></span>
                            </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Total Movies</h6>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{$theaters_count}}</h3>
                                <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>
                            </div>
                            </div>
                            <div class="col-3">
                            <div class="icon icon-box-success ">
                                <span class="mdi mdi-arrow-top-right icon-item"></span>
                            </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Total Theaters</h6>
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