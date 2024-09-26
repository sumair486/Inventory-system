<?php
// Initialize the session
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8"/>
  <title>Transfer List</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
  <meta content="" name="author"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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
   

{{-- @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif --}}

                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Transfer List</h2>
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

                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

             
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">  <a class="btn btn-success" href="{{ route('transfer.create') }}"> Create New Transfer</a></h4>
                            </div><!--end card-header-->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="datatable_1">
                                        <thead class="thead-light">
                                          <tr>
                                            <th>No</th>
                                            <th>invoice No</th>

                                            <th>Commission</th>
                                            <th>Border Warehouse</th>

                                            <th>Warehouse</th>
                                            {{-- <th>Warehouse</th> --}}
                                            <th>Sub Item</th>

                                            <th>Transfer Date</th>
                                            <th>Fine Quantity</th>
                                            <th>Demage Quantity</th>
                                            <th>Loss Quantity</th>

                                            {{-- <th>Status</th> --}}
                                            <th>Action</th>
                                          
                                          </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transfer as $key=>$transfers)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $transfers->invoice_no}}</td>
                                                <td>{{ $transfers->commissions->name ?? 'none' }}</td>
                                                <td>{{ $transfers->warehouseborder->name ?? '' }}</td>

                                                {{-- <td>{{ $transfers->transaction->date ?? ''}}</td> --}}
                                                {{-- <td>{{ date('d-m-Y', strtotime($transfers->transaction->date ?? '')) }}</td> --}}
                                                <td>{{ $transfers->warehouse->name ?? '' }}</td>

                                                
                                                {{-- <td>{{ $transfers->warehouse->name ?? '' }}</td> --}}
                                                <td>{{ $transfers->product->product_name ?? '' }}</td>

                                                <td>{{ date('d-m-Y', strtotime($transfers->date)) }}</td>
                                                <td>{{ $transfers->total_fine_quantity }}</td>

                                                <td>{{ $transfers->total_demage_quantity }}</td>
                                                <td>{{ $transfers->total_loss_quantity }}</td>
                                                {{-- <td><a class="btn btn-success" href="{{ route('transfer.detail',$transfers->border_warehouse_id->id ?? '') }}">Details</a> </td> --}}




                                                <td>
                                                    <form action="{{ route('transfer.delete',$transfers->id) }}" method="POST">
                                                        <a class="btn btn-primary" data-toggle="modal" data-target="#myModal{{ $transfers->id }}"><i class="fa fa-eye"></i></a>
                                                       
                                                        <a class="btn btn-primary" href="{{ route('transfer.edit',$transfers->id) }}"><i class="fa fa-edit"></i></a>
                                                        
                                    
                                                     
                                    
                                                        @csrf
                                                        @method('DELETE')
                                                        {{-- @can('plan-delete') --}}
                                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                        {{-- @endcan --}}
                                                    </form>
                                                </td>
                                            </tr>

                                            
                <div class="container">
                    {{-- <h1>Bootstrap Modal Example</h1> --}}
                    <!-- Button to trigger the modal -->
                  
            
                    <!-- The Modal -->
                    <div class="modal" id="myModal{{ $transfers->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Slip</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
            
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <img style="width: 100%" src="border_transfer/{{$transfers->image}}">
                                    {{-- <p>This is a simple Bootstrap modal example. You can put any content you want in here.</p> --}}
                                </div>
            
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                 
                {{-- image --}}




                
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


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Javascript  -->
    <script src="{{ asset('assets/plugins/datatables/simple-datatables.js')}}"></script>
    <script src="{{ asset('assets/pages/datatable.init.js')}}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js')}}"></script>

</body>

</html>