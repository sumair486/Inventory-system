{{-- 
<div class="container">



    
<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
  <title>Login Earninglance</title>
</head>
<body>


  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/fav.png')}}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

  <link href="{{ asset('frontend/vendors/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">


<link rel="stylesheet" href="{{ asset('frontend/assets/css/fontawesome.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/templatemo-space-dynamic.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/animated.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.css')}}">


  <div id="contact" class="contact-us section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0.25s">
          <div class="section-heading">
            <h2>Login</h2>
          </div>
        </div>
        <div class="col-lg-6 wow fadeInRight" data-wow-duration="0.5s" data-wow-delay="0.25s">
            <form id="contact" method="POST" action="{{ route('login') }}">
                @csrf
            
                <div class="row">
                    <div class="col-lg-12">
                        <br>
                        <fieldset>
                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>
                    <div class="col-lg-12">
                        <fieldset>
                            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    </div>
                   
                    <div class="col-lg-12">
                        <fieldset>
                            <button type="submit" class="main-button">
                                {{ __('Login') }}
                            </button>
                        </fieldset>
                    </div>
                    <div class="col-lg-12 mt-2">
                        
                         
                        
                    </div>
                </div>
                <div class="contact-dec">
                    <img src="{{ asset('frontend/assets/images/contact-decoration.png') }}" alt="">
                </div>
            </form>
            
        </div>
      </div>
    </div>
  </div>

  <a class="whatsapp" href="https://api.whatsapp.com/send?phone=03477734604" >
    <h1 ><i class="fa-brands fa-whatsapp"></i></h1>
</a>
<style>
    .whatsapp{
        width: 70px;
        height: 70px;
        background-color: white;
        position: fixed;
        bottom: 2%;
        right: 2%;
        border-radius: 50%; 
        text-align: center;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    .whatsapp h1{
        color: rgb(79, 206, 93);
        font-size: 40px;
        margin: 12px;
    }
</style>

  <script src="{{ asset('frontend/kit.fontawesome.com/f5a5bc4a23.js')}}" crossorigin="anonymous"></script>
  <script src="{{ asset('frontend/vendors/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset('frontend/vendors/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('frontend/assets/js/owl-carousel.js')}}"></script>
  <script src="{{ asset('frontend/assets/js/animation.js')}}"></script>
  <script src="{{ asset('frontend/assets/js/imagesloaded.js')}}"></script>
  <script src="{{ asset('frontend/assets/js/templatemo-custom.js')}}"></script>
</body>


</html>


  
 --}}


 <?php
// Initialize the session
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">
<head>

  

    {{-- title --}}
    <meta charset="utf-8"/>
    <title>Login</title>
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

<body id="body" class="auth-page" style="background-image: url('assets/images/p-1.png'); background-size: cover; background-position: center center;">
   <!-- Log In page -->
    <div class="container-md">
        <div  class="row vh-100 d-flex justify-content-center">
            <div class="col-12 align-self-center">
                <div  class="card-body">
                    <div class="row">
                        <div class="col-lg-4 mx-auto">
                            <div style="border:1px solid black" class="card">
                                <div class="card-body p-0 auth-header-box">
                                    <div class="text-center p-3">
                                        <a href="index.html" class="logo logo-admin">
                                            <img src="assets/images/logo-sm.png" height="50" alt="logo" class="auth-logo">
                                        </a>
                                        <h4 class="mt-3 mb-1 fw-semibold text-white font-18">Let's Get Started</h4>   
                                        <p class="text-muted  mb-0">Log In Here.</p>  
                                    </div>
                                </div>
                                <div class="card-body pt-0">                                    
                                    <form class="my-4" method="POST" action="{{ route('login') }}">
                                      @csrf            
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email">                               
                                       
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror   </div><!--end form-group--> 
            
                                        <div class="form-group">
                                            <label class="form-label" for="userpassword">Password</label>                                            
                                            <input type="password" id="password"  class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">                            
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                          </div><!--end form-group--> 
            
                                        {{-- <div class="form-group row mt-3">
                                            <div class="col-sm-6">
                                                <div class="form-check form-switch form-switch-success">
                                                    <input class="form-check-input" type="checkbox" id="customSwitchSuccess">
                                                    <label class="form-check-label" for="customSwitchSuccess">Remember me</label>
                                                </div>
                                            </div><!--end col--> 
                                            <div class="col-sm-6 text-end">
                                                <a href="auth-recover-pw.html" class="text-muted font-13"><i class="dripicons-lock"></i> Forgot password?</a>                                    
                                            </div><!--end col--> 
                                        </div><!--end form-group-->  --}}
            
                                        <div class="form-group mb-0 row">
                                            <div class="col-12">
                                                <div class="d-grid mt-3">
                                                    <button class="btn btn-primary" type="submit">Log In <i class="fas fa-sign-in-alt ms-1"></i></button>
                                                </div>
                                            </div><!--end col--> 
                                        </div> <!--end form-group-->                           
                                    </form><!--end form-->
                                    {{-- <div class="m-3 text-center text-muted">
                                        <p class="mb-0">Don't have an account ?  <a href="auth-register.html" class="text-primary ms-2">Free Resister</a></p>
                                    </div> --}}
                                    <hr class="hr-dashed mt-4">
                                    {{-- <div class="text-center mt-n5">
                                        <h6 class="card-bg px-3 my-4 d-inline-block">Or Login With</h6>
                                    </div> --}}
                                    {{-- <div class="d-flex justify-content-center mb-1">
                                        <a href="" class="d-flex justify-content-center align-items-center thumb-sm bg-soft-primary rounded-circle me-2">
                                            <i class="fab fa-facebook align-self-center"></i>
                                        </a>
                                        <a href="" class="d-flex justify-content-center align-items-center thumb-sm bg-soft-info rounded-circle me-2">
                                            <i class="fab fa-twitter align-self-center"></i>
                                        </a>
                                        <a href="" class="d-flex justify-content-center align-items-center thumb-sm bg-soft-danger rounded-circle">
                                            <i class="fab fa-google align-self-center"></i>
                                        </a>
                                    </div> --}}
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end card-body-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js')}}"></script>
    
</body>

</html>