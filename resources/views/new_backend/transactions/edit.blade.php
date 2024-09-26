<?php
// Initialize the session
session_start();

?>
<!DOCTYPE html>
<html lang="en">
    <head>

  

        {{-- title --}}
        <meta charset="utf-8"/>
        <title>Add Transaction</title>
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
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Edit Loader</h2>
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


                    <form action="{{ route('transaction.update', $transaction->id) }}" method="POST">
                        @csrf
                        {{-- @method('PUT') <!-- Add this line to specify that you are using the PUT method for updating --> --}}
                    
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>Commission:</strong>
                                    <select required name="commission_agent_id" class="form-control">
                                        <option value="Nothing Selection">Choose</option>
                                        @foreach ($commission as $commissions)
                                            <option value="{{ $commissions->id }}" {{ $transaction->commission_agent_id == $commissions->id ? 'selected' : '' }}>
                                                {{ $commissions->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>Border:</strong>
                                    <select required name="border_id" class="form-control">
                                        @foreach ($border as $borders)
                                            <option value="{{ $borders->id }}" {{ $transaction->border_id == $borders->id ? 'selected' : '' }}>
                                                {{ $borders->address }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>Category:</strong>
                                    <select name="category_id" required class="form-control">
                                        @foreach ($category as $categories)
                                            <option value="{{ $categories->id }}" {{ $transaction->category_id == $categories->id ? 'selected' : '' }}>
                                                {{ $categories->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Add more fields as needed -->
                        <!-- Example: Add a "Product" field -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>Product:</strong>
                                    <select required name="product_id" class="form-control">
                                        @foreach ($product as $products)
                                            <option value="{{ $products->id }}" {{ $transaction->product_id == $products->id ? 'selected' : '' }}>
                                                {{ $products->product_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>Quantity:</strong>
                                   {{-- <input type="number" id="fetched-quantity"  readonly name="quantity" placeholder="Quantity" class="form-control"> --}}
                                   <input required type="number" value="{{ $transaction->quantity }}" name="quantity" placeholder="Quantity" class="form-control">
                                
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>Date:</strong>
                                    {{-- <input required type="date" value="{{ date('Y-d-m') }}" required name="date" class="form-control"> --}}
                                    <input required type="date" value="{{ date('Y-m-d') }}"  name="date" class="form-control">
        
                                </div>
                            </div>
        
                    
                            <!-- Add more fields here -->
                    
                        </div>
                    
                        <!-- Other existing fields -->
                    
                        <div class="col-md-12 text-center mt-3">
                            <button type="submit" class="btn btn-primary">Update</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
    
        $('select[name="commission_agent_id"]').change(function () {
            var selectedCommissionAgentId = $(this).val();

           
            $.ajax({
                type: 'GET',
                url: '/get-commission-quantity/' + selectedCommissionAgentId, 
                success: function (data) {
                  
                    $('#fetched-quantity').val(data.quantity);
                },
                error: function (error) {
                    console.error('Error fetching quantity:', error);
                }
            });
        });
    });
</script>


</body>
<!--end body-->
</html>