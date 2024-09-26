<?php
// Initialize the session
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>

  

    {{-- title --}}
    <meta charset="utf-8"/>
    <title>Tobacco Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
     {{-- title end --}}

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    {{-- css file --}}

     <!-- App css -->
     <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body id="body" class="dark-sidebar">




{{-- top navbar --}}

<!-- Top Bar Start -->


@include('new_backend.partials.navbar')
<!-- Top Bar End -->

{{-- end top bar --}}

{{-- left side bar --}}

@include('new_backend.partials.left-sidebar')
<!-- end left-sidenav-->
{{-- end left side bar --}}




<div class="page-wrapper">

    <!-- Page Content-->
    <div class="page-content-tab">

        <div class="container-fluid">

  
          @if (count($errors) > 0)
          <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
               @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
               @endforeach
            </ul>
          </div>
        @endif

            <div class="row mt-5">
                <div class="col-md-12 col-lg-12">

                  {{-- form --}}

                  <form action="{{ route('products.update',$product->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Item:</strong>
                                <select name="category_id" class="form-control">
                                    @foreach ($category as $categories)
                                    <option value="{{ $categories->id }}" {{ $product->category_id == $categories->id ? 'selected' : '' }}>
                                        {{ $categories->category_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                      <div class="col-md-6">

                          <div class="form-group">
                              <strong>Sub Item:</strong>
                              <input type="text" value="{{ $product->product_name }}"  name="product_name" class="form-control" placeholder="Sub Item">
                          </div>
                      </div>
                     
                    {{-- <div class="col-md-6">
                        <div class="form-group">
                            <strong>Brand:</strong>
                            <select name="brand_id" class="form-control">
                                @foreach ($brand as $brands)
                                <option value="{{ $brands->id }}">
                                    {{ $brands->brand_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    {{-- <div class="col-md-6">
                        <div class="form-group">
                            <strong>Company:</strong>
                            <select name="company_id" class="form-control">
                                @foreach ($company as $companies)
                                <option value="{{ $companies->id }}" {{ $product->company_id == $companies->id ? 'selected' : '' }}>
                                    {{ $companies->company_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    {{-- <div class="col-md-6">
                        <div class="form-group">
                            <strong>Size:</strong>
                            <input type="text" name="size" value="{{ $product->size }}" class="form-control" placeholder="Size">
                        </div>
                    </div> --}}
                     
                      
                      <div class="col-md-12 text-center mt-3">
                          <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                  </div>
            
            
                </form>
                  
                  
                 
          
                  
                     {{-- end --}}
                    {{-- <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="pt-3">
                                <h3 class="text-dark text-center font-24 fw-bold line-height-lg">Unikit
                                    <br>Multi Application</h3>
                                <div class="text-center text-muted font-16 fw-bold pt-3 pb-1">We Design and Develop
                                    Clean and High Quality Web Applications
                                </div>

                                <div class="text-center py-3 mb-3">
                                    <a href="#" class="btn btn-primary">Buy Now</a>
                                </div>
                                <img src="assets/images/small/business.png" alt="" class="img-fluid px-3 mb-2">
                            </div>
                        </div><!--end card-body-->
                    </div><!--end card--> --}}
                </div> <!--end col-->
                {{-- <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-3">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="row d-flex">
                                        <div class="col-3">
                                            <i class="ti ti-users font-36 align-self-center text-dark"></i>
                                        </div><!--end col-->
                                        <div class="col-12 ms-auto align-self-center">
                                            <div id="dash_spark_1" class="mb-3"></div>
                                        </div><!--end col-->
                                        <div class="col-12 ms-auto align-self-center">
                                            <h3 class="text-dark my-0 font-22 fw-bold">24000</h3>
                                            <p class="text-muted mb-0 fw-semibold">Sessions</p>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div> <!--end col-->
                        <div class="col-lg-3">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="row d-flex">
                                        <div class="col-3">
                                            <i class="ti ti-clock font-36 align-self-center text-dark"></i>
                                        </div><!--end col-->
                                        <div class="col-auto ms-auto align-self-center">
                                            <span class="badge badge-soft-success px-2 py-1 font-11">Active</span>
                                        </div><!--end col-->
                                        <div class="col-12 ms-auto align-self-center">
                                            <div id="dash_spark_2" class="mb-3"></div>
                                        </div><!--end col-->
                                        <div class="col-12 ms-auto align-self-center">
                                            <h3 class="text-dark my-0 font-22 fw-bold">00:18</h3>
                                            <p class="text-muted mb-0 fw-semibold">Avg.Sessions</p>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div> <!--end col-->
                        <div class="col-lg-3">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="row d-flex">
                                        <div class="col-3">
                                            <i class="ti ti-activity font-36 align-self-center text-dark"></i>
                                        </div><!--end col-->
                                        <div class="col-12 ms-auto align-self-center">
                                            <div id="dash_spark_3" class="mb-3"></div>
                                        </div><!--end col-->
                                        <div class="col-12 ms-auto align-self-center">
                                            <h3 class="text-dark my-0 font-22 fw-bold">$2400</h3>
                                            <p class="text-muted mb-0 fw-semibold">Bounce Rate</p>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div> <!--end col-->

                        <div class="col-lg-3">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="row d-flex">
                                        <div class="col-3">
                                            <i class="ti ti-confetti font-36 align-self-center text-dark"></i>
                                        </div><!--end col-->
                                        <div class="col-auto ms-auto align-self-center">
                                            <span class="badge badge-soft-danger px-2 py-1 font-11">-2%</span>
                                        </div><!--end col-->
                                        <div class="col-12 ms-auto align-self-center">
                                            <div id="dash_spark_4" class="mb-3"></div>
                                        </div><!--end col-->
                                        <div class="col-12 ms-auto align-self-center">
                                            <h3 class="text-dark my-0 font-22 fw-bold">85000</h3>
                                            <p class="text-muted mb-0 fw-semibold">Goal Completions</p>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div> <!--end col-->
                    </div><!--end row-->

                  

                </div><!--end col--> --}}
            </div><!--end row-->

           
        </div><!-- container -->

        <!--Start Rightbar-->
     <!--Start Rightbar/offcanvas-->

<!--end Rightbar/offcanvas-->
        <!--end Rightbar-->

        <!--Start Footer-->
       <!-- Footer Start -->

<footer class="footer text-center text-sm-start">
    &copy; <script>
        document.write(new Date().getFullYear())
    </script> Unikit <span class="text-muted d-none d-sm-inline-block float-end">Crafted with <i
            class="mdi mdi-heart text-danger"></i> by Mannatthemes</span>
</footer>

<!-- end Footer -->


        <!--end footer-->
    </div>
    <!-- end page content -->
</div>
<!-- end page-wrapper -->

<!-- Javascript  -->

<script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/pages/analytics-index.init.js') }}"></script>


<!-- App js -->
<script src="{{ asset('assets/js/app.js')}}"></script>

</body>
<!--end body-->
</html>