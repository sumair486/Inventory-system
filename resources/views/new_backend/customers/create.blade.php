<?php
// Initialize the session
session_start();

?>
<!DOCTYPE html>
<html lang="en">
    <head>

  

        {{-- title --}}
        <meta charset="utf-8"/>
        <title>Add Customer</title>
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
                        <h2>Add Customer</h2>
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


                    <form action="{{ route('customer.store') }}" method="POST">
                        @csrf
                
                
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                   <input type="text" placeholder="Name" required name="name" class="form-control">
                                </div>
                            </div>
                          <div class="col-md-4">
                            <div class="form-group">
                                <strong>Address:</strong>
                           <input type="text" name="address" required  placeholder="Address"   class="form-control">

                               
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <strong>Mobile:</strong>
                           <input type="number"  name="mobile"  required placeholder="Mobile"   class="form-control">
                                
                            </div>
                        </div>
                      </div>

                      
                      <div class="row">
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <strong>Email:</strong>
                           <input type="email"  name="email" required  placeholder="Email"   class="form-control">
                                
                            </div>
                      </div>

                     

                    <div class="col-md-4">
                        <div class="form-group">
                            <strong>Opening Balance:</strong>
                           <input type="number" name="opening_balance" required placeholder="Opening Balance" class="form-control">
                        </div>
                    </div>


                    </div>

                    

                    {{-- <div class="col-md-4">
                        <div class="form-group">
                            <strong>Quantity:</strong>
                           <input type="hiddeen" id="quantity"  readonly  placeholder="Quantity" class="form-control">
                        </div>
                    </div> --}}


                    
                    <div class="row">
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <strong>Quantity:</strong>
                               <input type="number" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <strong>Date:</strong>
                              <input type="date" class="form-control">

                          </div>
                      </div> --}}
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

<script>
    $(document).ready(function () {
    
        $('select[name="commission_agent_id"]').change(function () {
            var commissionAgent= $(this).val();

            // Send an AJAX request to fetch the quantity
            $.ajax({
                type: 'GET',
                url: '/get-transaction-date/' + commissionAgent, 
                success: function (data) {
                  
                    $('#quantity').val(data.qty);
                },
                error: function (error) {
                    console.error('Error fetching quantity:', error);
                }
            });
        });
    });
</script>

{{-- <script>
    // Get the current date in yyyy-MM-dd format
    var currentDate = new Date().toISOString().split('T')[0];
    
    // Set the value of the input field to the current date
    document.getElementById('fetched-date').value = currentDate;
</script> --}}


{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

{{-- <script>
    $(document).ready(function() {
        // Get the maximum allowed quantity from the hidden input
        const maxAllowedQuantity = parseInt($('#max-allowed-quantity').val());
        

        // Handle input change events
        $('#damaged-quantity, #loss-quantity, #fine-quantity').on('input', function() {
            // Calculate the total quantity in transfers
            const damagedQuantity = parseInt($('#damaged-quantity').val()) || 0;
            const lossQuantity = parseInt($('#loss-quantity').val()) || 0;
            const fineQuantity = parseInt($('#fine-quantity').val()) || 0;
            const totalQuantity = damagedQuantity + lossQuantity + fineQuantity;
            alert(totalQuantity);

            // Check if totalQuantity exceeds maxAllowedQuantity
            if (totalQuantity > maxAllowedQuantity) {
                // Display an alert
                alert('Total quantity in transfers cannot exceed the transaction quantity.');
                // Reset the input values
                $(this).val('');
            }
        });
    });
</script> --}}

</body>
<!--end body-->
</html>