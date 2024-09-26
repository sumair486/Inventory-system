<?php
// Initialize the session
session_start();

?>
<!DOCTYPE html>
<html lang="en">
    <head>

  

        {{-- title --}}
        <meta charset="utf-8"/>
        <title>Add Sales</title>
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
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Add Sale</h2>
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


                    <form action="{{ route('sale.store') }}" method="POST">
                        @csrf
                
                
                        <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                  <strong>Customer Name:</strong>
                                  <input type="text" required placeholder="Customer Name" name="customer_name" class="form-control">
                              </div>
                          </div>

                         

                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <strong>Mobile:</strong>
                                <input type="number" required name="mobile" placeholder="Mobile" class="form-control">
                            </div>
                        </div> --}}

                        <div class="col-md-4">
                            <div class="form-group">
                                <strong>Warehouse:</strong>
                                <select  required name="warehouse_id"  id="warehouseSelect" class="form-control">
                                    <option value="Not Selected">Choose</option>

                                    @foreach ($warehouses as $warehouse)
                                  <option value="{{ $warehouse->warehouse_id }}">{{ $warehouse->warehouse->name }}</option>
                                        
                                    @endforeach

                                </select>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <strong>Sub Item:</strong>
                                <select name="product_id[]" class="form-control" id="productSelect">
                           
                                </select>
                            </div>
                        </div>
                        

                        
                      </div>

                      
                      

                    <div class="row">

                       

                        <div class="col-md-4">
                            <div class="form-group">
                                <strong>Sale Quantity:</strong>
                               <input required type="number" name="sale_quantity" placeholder="Sale Quantity" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <strong>Sell Date:</strong>
                               <input required type="date" name="date" value="{{ date('Y-m-d') }}" class="form-control">
                            </div>
                        </div>



                    </div>

                    
                    

                          <div class="col-md-12 text-center mt-3">
                              <button type="submit" class="btn btn-primary">Submit</button>
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


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery --> --}}
<script>
    $(document).ready(function () {
        $('#warehouseSelect').select2();

        $('#warehouseSelect').change(function () {
            var warehouseID = $(this).val();
            var productSelect = $('#productSelect');

            $.ajax({
                type: 'GET',
                url: '/get-warehouse-data/' + warehouseID,
                success: function (data) {
                    // console.log(data);
                    var warehouses = data.warehouses;
                  
                    // alert(warehouseID);
                    productSelect.empty();
 
                    if (warehouses.length > 0) {
                        $.each(warehouses, function (index, warehouse) {
                            var optionValue = warehouse.product_id;
                    //   alert(optionValue);
                            var optionText = warehouse.products.product_name + ' (Fine Quantity: ' + Math.floor(warehouse.total_quantity) + ')' ;
                      
                            if (warehouse.total_quantity > 0) {
                            productSelect.append(new Option(optionText, optionValue));
                        }

                            // productSelect.append(new Option(optionText, optionValue));
                        });

                        productSelect.trigger('change');
                        // console.log(productSelect);
                    }
                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                }
            });
        });

        $('#productSelect').select2({
            width: '100%'
        });
    });
</script>


</body>
<!--end body-->
</html>