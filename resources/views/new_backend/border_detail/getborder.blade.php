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
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
     {{-- title end --}}

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> --}}
    
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


            <div class="row">
               
                    <div class="card overflow-hidden">
                        {{-- <div class="card-body"> --}}
                            {{-- <div class="pt-3"> --}}
                                <h3 class="text-dark text-center font-24 fw-bold line-height-lg">
                                    <br>Border Warehouses</h3>
                                

                               
                                {{-- <img src="assets/images/small/business.png" alt="" class="img-fluid px-3 mb-2"> --}}
                            {{-- </div> --}}
                        {{-- </div><!--end card-body--> --}}
                    </div><!--end card-->
                </div>
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                       
                       
@foreach ($border as $borders)
                        <div class="col-lg-3">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="row d-flex">
                                        <div class="col-3">
                                            <i class="ti ti-activity font-36 align-self-center text-dark"></i>
                                        </div><!--end col-->
                                        <div class="col-12 ms-auto align-self-center">
                                            {{-- <div id="dash_spark_4" class="mb-3"></div> --}}
                                        </div><!--end col-->
                                        <div class="col-12 ms-auto align-self-center">
                                                
                                            <a href="{{ route('border.product',$borders->id) }}">
                                            <h2 class="text-dark my-0 font-22 fw-bold">{{ $borders->name }}</h2>
                                        </a>
                                            {{-- <h3 class="text-muted mb-0 fw-semibold">{{ $borders->total_quantity }}</h3> --}}
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div> <!--end col-->
@endforeach

                      

                       

                    </div><!--end row-->

                  

                </div><!--end col-->
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
        </script> <span class="text-muted d-none d-sm-inline-block float-end">Develop By by MindGigs </span>
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