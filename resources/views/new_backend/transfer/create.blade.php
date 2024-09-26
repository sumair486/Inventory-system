<?php
// Initialize the session
session_start();

?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <style>
            
        </style>

  

        {{-- title --}}
        <meta charset="utf-8"/>
        <title>Add Transfer</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
        <meta content="" name="author"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
         {{-- title end --}}
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                        <h2 class="class1">Add Transfer</h2>
                    </div>
                    <div class="pull-right">
                        {{-- <a class="btn btn-primary" href="{{ route('products.index') }}">Back</a> --}}
                    </div>
                </div>
            </div>

            @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

           
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


                    <form  id="item-form" action="{{ route('transfer.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                
                
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <strong>Invoice No:</strong>
                                        <input  placeholder="Invoice number"  type="number" name="invoice_no" class="form-control">
        
                                  
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <strong>Commission:</strong>
                                    <select name="commission_agent_id"  id="commissionSelect" required class="form-control">
                                    <option value="Not select">Choose</option>

                                      @foreach ($commission as $commissions)
                                          <option value="{{ $commissions->id}}">{{ $commissions->name}}</option>
                                      @endforeach
                                      
                                    </select>
                                </div>
                            </div>

                            
                            
                    <div class="col-md-3">
                        <div class="form-group">
                            <strong>Date:</strong>
                            <input type="date" value="{{ date('Y-m-d') }}"  required name="date" class="form-control">
                        </div>
                    </div>


                  
                    

                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <strong>Image:</strong>
                                <input   type="file" name="file" class="form-control">

                          
                        </div>
                    </div>
                   

                        </div>

                            {{-- double --}}
                            
                           
            <div id="field-container">
                <!-- Initial set of fields -->
                <div class="row field-row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <strong>Border Warehouse:</strong>
                            <select name="border_warehouse_id[]" class="form-control border-warehouse-select">
                                <option value="Not select">Choose</option>
                                @foreach ($warehouse_border as $warehouse_borders)
                                    <option value="{{ $warehouse_borders->warehouseborder->id }}">{{ $warehouse_borders->warehouseborder->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <strong>Sub Item:</strong>
                            <select name="product_id[]" class="form-control product-select">
                                <!-- Options will be dynamically populated via JavaScript -->
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <strong>Warehouse:</strong>
                            <select name="warehouse_id[]" required class="form-control">
                                @foreach ($warehouse as $warehouses)
                                    <option value="{{ $warehouses->id }}">{{ $warehouses->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <strong>Fine:</strong>
                            <input type="number"  value="0"  name="fine_quantity[]" id="fine-quantity" placeholder="Fine Quantity" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-group">
                            <strong>Damage:</strong>
                            <input type="number"  value="0" name="demage_quantity[]" id="damage-quantity" placeholder="Damage Quantity" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-group">
                            <strong>Loss:</strong>
                            <input type="number"  value="0" name="loss_quantity[]" id="loss-quantity" placeholder="Loss Quantity" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="remove-row btn btn-danger mt-4">Remove</button>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-2"> --}}
                {{-- <button type="button" class="remove-row btn btn-danger mt-4">Remove</button> --}}
            {{-- </div> --}}
            <button type="button" class="add-fields btn btn-success mt-4">Add More</button>
                          
                       

                     

                    

                  

                  

                 

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
    // Initialize Select2 for the initial "Border Warehouse" and "Product" dropdowns

    // Add a new field set
    $('.add-fields').on('click', function () {
        var newFieldSet = $('.field-row').first().clone();
        newFieldSet.find('select, input').val('');
        newFieldSet.find('button').text('Remove');
        newFieldSet.find('button').removeClass('add-fields btn-success').addClass('remove-row btn-danger');
        $('#field-container').append(newFieldSet);
    });

    // Remove a field set
    $('#field-container').on('click', '.remove-row', function () {
        $(this).closest('.field-row').remove();
    });
});

$(document).on('change', '.border-warehouse-select', function () {
    var borderWarehouseSelect = $(this);
    var productSelect = borderWarehouseSelect.closest('.field-row').find('.product-select');

    var borderWarehouseId = borderWarehouseSelect.val();

    $.ajax({
        url: '/getProducts', // Replace with your actual route URL
        method: 'GET',
        data: {
            borderWarehouseId: borderWarehouseId
        },
        success: function (data) {
            productSelect.empty();
            $.each(data, function (product_id, product) {
                if (product.quantity > 0) {
                    productSelect.append(new Option(product.name + ' (Total Quantity: ' + product.quantity + ')', product_id));
                }
            });
        }
    });
});

</script>




{{-- <script>
    $(document).ready(function () {
        // Initialize Select2 for the initial "Border Warehouse" and "Product" dropdowns
        // $('.border-warehouse-select').select2();
        // $('.product-select').select2();
    
        // Add a new field set
        $('.add-fields').on('click', function () {
            var newFieldSet = $('.field-row').first().clone();
            newFieldSet.find('select, input').val('');
            $('#field-container').append(newFieldSet);
    
            // Initialize Select2 for the new "Border Warehouse" and "Product" dropdowns
            // newFieldSet.find('.border-warehouse-select').select2();
            // newFieldSet.find('.product-select').select2();
        });
    });
    
    $(document).on('change', '.border-warehouse-select', function () {
        var borderWarehouseSelect = $(this);
        var productSelect = borderWarehouseSelect.closest('.field-row').find('.product-select');
    
        var borderWarehouseId = borderWarehouseSelect.val();
    
        $.ajax({
            url: '/getProducts', 
            method: 'GET',
            data: {
                borderWarehouseId: borderWarehouseId
            },
            success: function (data) {
                productSelect.empty();
                $.each(data, function (product_id, product) {
                    if(product.quantity>0)
                    {
                        productSelect.append(new Option(product.name + ' (Total Quantity: ' + product.quantity + ')', product_id));

                    }
                });
                // productSelect.select2();
            }
        });
    });
    </script> --}}





</body>
<!--end body-->
</html>