<?php
// Initialize the session
session_start();

?>
<!DOCTYPE html>
<html lang="en">
    <head>

  

        {{-- title --}}
        <meta charset="utf-8"/>
        <title>Add Brand</title>
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


            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Add New Brand</h2>
                    </div>
                    <div class="pull-right">
                        {{-- <a class="btn btn-primary" href="{{ route('products.index') }}">Back</a> --}}
                    </div>
                </div>
            </div>
           
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="row ">
                <div class="col-md-12 col-lg-12">

                    
                    {{-- form --}}


                    <form action="{{ route('brand.store') }}" method="POST">
                        @csrf
                
                
                        <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <strong>Brand Name:</strong>
                                  <input required type="text" name="brand_name" class="form-control" placeholder="Brand Name">
                              </div>
                          </div>
                          <div class="col-md-12 text-center mt-3">
                              <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                      </div>
                
                
                    </form>
                    {{-- end form --}}
                   
                </div> <!--end col-->
                
            </div><!--end row-->

           
        </div>
        <!-- container -->

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