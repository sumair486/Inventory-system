<?php
// Initialize the session
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8"/>
  <title>Border Detail List</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
  <meta content="" name="author"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <link href="{{ asset('assets/plugins/datatables/datatable.css')}}" rel="stylesheet" type="text/css" />

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    {{-- css file --}}

     <!-- App css -->
     <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
</head>


<body id="body" class="dark-sidebar">


  
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
                <!-- Page-Title -->
           
                <!-- end page title end breadcrumb -->
                {{-- <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Customers Details </h4>
                            </div><!--end card-header-->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="datatable_1">
                                        <thead class="thead-light">
                                          <tr>
                                            <th>Name</th>
                                            <th>Ext.</th>
                                            <th>City</th>
                                            <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
                                            <th>Completion</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Unity Pugh</td>
                                                <td>9958</td>
                                                <td>Curicó</td>
                                                <td>2005/02/11</td>
                                                <td>37%</td>
                                            </tr>
                                            <tr>
                                                <td>Theodore Duran</td><td>8971</td><td>Dhanbad</td><td>1999/04/07</td><td>97%</td>
                                            </tr>
                                            <tr>
                                                <td>Kylie Bishop</td><td>3147</td><td>Norman</td><td>2005/09/08</td><td>63%</td>
                                            </tr>
                                            <tr>
                                                <td>Willow Gilliam</td><td>3497</td><td>Amqui</td><td>2009/29/11</td><td>30%</td>
                                            </tr>
                                            <tr>
                                                <td>Blossom Dickerson</td><td>5018</td><td>Kempten</td><td>2006/11/09</td><td>17%</td>
                                            </tr>
                                            <tr>
                                                <td>Elliott Snyder</td><td>3925</td><td>Enines</td><td>2006/03/08</td><td>57%</td>
                                            </tr>
                                            <tr>
                                                <td>Castor Pugh</td><td>9488</td><td>Neath</td><td>2014/23/12</td><td>93%</td>
                                            </tr>
                                            <tr>
                                                <td>Pearl Carlson</td><td>6231</td><td>Cobourg</td><td>2014/31/08</td><td>100%</td>
                                            </tr>
                                            <tr>
                                                <td>Deirdre Bridges</td><td>1579</td><td>Eberswalde-Finow</td><td>2014/26/08</td><td>44%</td>
                                            </tr>
                                            <tr>
                                                <td>Daniel Baldwin</td><td>6095</td><td>Moircy</td><td>2000/11/01</td><td>33%</td>
                                            </tr>  
                                            <tr>
                                                <td>Pearl Carlson</td><td>6231</td><td>Cobourg</td><td>2014/31/08</td><td>100%</td>
                                            </tr>                                                                                        
                                        </tbody>
                                      </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row --> --}}
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Border Detail List</h2>
                        </div>
                        <div class="pull-right">
                            {{-- <a class="btn btn-primary" href="{{ route('products.index') }}">Back</a> --}}
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                  <p>{{ $message }}</p>
                </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                {{-- <h4 class="card-title">  <a class="btn btn-success" href="{{ route('border.transaction') }}"> Create Border Transaction</a></h4> --}}
                            </div><!--end card-header-->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="datatable_1">
                                        <thead class="thead-light">
                                          <tr>
                                            <th>No</th>
                                            {{-- <th>Border Name</th> --}}
                                            <th>Invoice No</th>
                                            <th>From Border Warehouse</th>
                                            {{-- <th>Invoice No</th> --}}
                                            

                                            <th>Date</th>
                                            <th>Item</th>
                                            <th>Sub Item</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                          
                                          </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($border_detail as $key=>$border_details)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                               
                                                {{-- <td>{{ $border_details->bordertransaction->id ?? '' }}</td> --}}
                                                <td>{{ $border_details->bordertransaction->invoice_no ?? '' }}</td>

                                                <td>{{ $border_details->bordertransaction->warehouseborder->name ?? '' }}</td>

                                               
                                                {{-- <td>{{ $border_details->bordertransaction->date ?? '' }}</td> --}}
                                                <td>{{ date('d-m-Y', strtotime($border_details->bordertransaction->date ?? '')) }}</td>
                                               
                                                {{-- <td>{{ date('d-m-Y', strtotime($border_details->date)) }}</td>  --}}
                                                {{-- <td>{{ $border_details->border_transaction_id}}</td> --}}

                                                <td>{{ $border_details->category->category_name ?? '' }}</td>
                                                <td>{{ $border_details->product->product_name ?? '' }}</td>
                                                <td>{{ $border_details->quantity}}</td>

                                                {{-- <td>{{ $sales->date }}</td> --}}
                                                {{-- <td>{{ date('d-m-Y', strtotime($sales->date)) }}</td> --}}





                                                <td>
                                                    <form action="{{ route('border.detail.delete',$border_details->id) }}" method="POST">
                                                        <a class="btn btn-info" href="{{ route('border.transaction.edit',$border_details->border_transaction_id) }}"><i class="fas fa-edit"></i></a>
                                                        {{-- <a class="btn btn-info" href="{{ route('border.detail.edit',$border_details->border_transaction_id) }}"><i class="fas fa-eye"></i></a> --}}
                                                        
                                                        {{-- @can('plan-edit')
                                                        <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                                                        @endcan --}}
                                    
                                    
                                                        @csrf
                                                        @method('DELETE')
                                                        {{-- @can('plan-delete') --}}
                                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                        {{-- @endcan --}}
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                           
                                                                                                                               
                                        </tbody>
                                    </table>
                                    {{-- <button type="button" class="btn btn-sm btn-de-primary csv">Export CSV</button>
                                    <button type="button" class="btn btn-sm btn-de-primary sql">Export SQL</button>
                                    <button type="button" class="btn btn-sm btn-de-primary txt">Export TXT</button>
                                    <button type="button" class="btn btn-sm btn-de-primary json">Export JSON</button> --}}
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

                
            </div><!-- container -->

            <!--Start Rightbar-->
            <footer class="footer text-center text-sm-start">
              &copy; <script>
                  document.write(new Date().getFullYear())
              </script> Unikit <span class="text-muted d-none d-sm-inline-block float-end">Crafted with <i
                      class="mdi mdi-heart text-danger"></i> by Mannatthemes</span>
          </footer>
            <!--end Rightbar-->
            
           <!--Start Footer-->
                  
           <!--end footer-->
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->




    <!-- Javascript  -->
    <script src="{{ asset('assets/plugins/datatables/simple-datatables.js')}}"></script>
    <script src="{{ asset('assets/pages/datatable.init.js')}}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js')}}"></script>

</body>

</html>