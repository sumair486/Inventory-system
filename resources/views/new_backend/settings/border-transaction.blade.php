<?php
// Initialize the session
session_start();

?>
<!DOCTYPE html>
<html lang="en">
    <head>

  

        {{-- title --}}
        <meta charset="utf-8"/>
        <title>Border Transaction</title>
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
                        <h2>Border Transaction</h2>
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


                    <form  id="item-form" action="{{ route('border.transaction.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                
                
                        <div class="row">
                          {{-- <div class="col-md-3">
                              <div class="form-group">
                                  <strong>Invoices:</strong>
                                  <select required name="commission_agent_id" class="form-control">
                                    <option value="Nothing Selection">0903</option>
                                   
                                 

                             
                                  </select>
                              </div>
                          </div> --}}
                          {{-- <div class="col-md-4">
                            <div class="form-group">
                                <strong>Border:</strong>
                                <select required name="border_id" class="form-control">
                                    @foreach ($border as $borders)
                                  <option value="{{ $borders->id }}">{{ $borders->address }}</option>
                                    
                                    @endforeach

                                </select>
                            </div>
                        </div> --}}



                        <div class="col-md-3">
                            <div class="form-group">
                                <strong>Invoice No:</strong>
                                    <input required  placeholder="Invoice number"  type="number" name="invoice_no" class="form-control">
  
                              
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <strong>Border Warehouse:</strong>
                                <select required name="border_warehouse_id"  class="form-control">
                                  @foreach ($border_warehouse as $border_warehouses)
                                      <option value="{{ $border_warehouses->id }}">{{ $border_warehouses->name }}</option>
                                  @endforeach
                                </select>
                             
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <strong>Date:</strong>
                                    <input value="{{ date('Y-m-d') }}"  type="date" name="date" class="form-control">
  
                              
                            </div>
                        </div>

                        


                        <div class="col-md-3">
                            <div class="form-group">
                                <strong>Image:</strong>
                                    <input required  type="file" name="file" class="form-control">
  
                              
                            </div>
                        </div>

                         

                      </div>

                     
                      <div id="input-fields">
                        <div class="row input-row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <strong>Item:</strong>
                                    <select name="category_id[]" id="category_id" required class="form-control">
                                        <option value="">Select</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <strong>Sub Item:</strong>
                                    <select name="product_id[]" id="product_id" required class="form-control">
                                        <option value="">Select</option>
                                     @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            
                            
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <strong>Quantity:</strong>
                                    <input type="number" name="quantity[]" required placeholder="Quantity" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {{-- <button type="button" id="add-row" class="btn btn-success mt-4">Add</button> --}}


                                    <button type="button" class="btn btn-danger remove-row mt-4">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="col-md-3">
                                <div class="form-group">
                                    <button type="button" id="add-row" class="btn btn-success mt-4">Add</button>


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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>





<!-- App js -->
<script src="{{ asset('assets/js/app.js')}}"></script>

{{-- <script>
    $(document).ready(function () {
        $('#category_id').on('change', function () {
            var categoryId = $(this).val();
            var productSelect = $('#product_id');
            
            // Clear the product dropdown
            productSelect.empty();
            
            if (categoryId) {
                $.ajax({
                    type: 'GET',
                    url: '/get-products-by-category',
                    data: {
                        category_id: categoryId,
                    },
                    success: function (response) {
                        if (response.products.length > 0) {
                            $.each(response.products, function (index, product) {
                                productSelect.append($('<option>', {
                                    value: product.product_id,
                                    text: 'Product ID ' + product.product_id,
                                }));
                            });
                        } else {
                            productSelect.append($('<option>', {
                                value: '',
                                text: 'No products available for this category',
                            }));
                        }
                    },
                    error: function () {
                        console.log('AJAX request failed');
                    }
                });
            } else {
                // Handle the case where no category is selected
                productSelect.append($('<option>', {
                    value: '',
                    text: 'Please select a category first',
                }));
            }
        });
    });
</script> --}}





<script>
    $(document).ready(function () {
    
        $('#add-row').on('click', function () {
            var newRow = $('.input-row').first().clone();
            newRow.find('select').val('');
            newRow.find('input').val('');
            $('#input-fields').append(newRow);
        });

        $('#item-form').on('click', '.remove-row', function () {
            $(this).closest('.input-row').remove();
        });
    });
</script>







</body>
<!--end body-->
</html>