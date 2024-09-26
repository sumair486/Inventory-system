<?php
// Initialize the session
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8"/>
  <title>Loader Report</title>
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
<style>
    body {font-family: Arial, Helvetica, sans-serif;}
    * {box-sizing: border-box;}
    
    .form-inline {  
      display: flex;
      flex-flow: row wrap;
      align-items: center;
    }
    
    .form-inline label {
      margin: 5px 10px 5px 0;
    }
    
    .form-inline input,select {
      vertical-align: middle;
      margin: 5px 10px 5px 0;
      padding: 10px;
      background-color: #fff;
      border: 1px solid #ddd;
    }
    
    .form-inline button {
      padding: 10px 20px;
      background-color: dodgerblue;
      border: 1px solid #ddd;
      color: white;
      cursor: pointer;
    }
    
    .form-inline button:hover {
      background-color: royalblue;
    }
    
    @media (max-width: 800px) {
      .form-inline input {
        margin: 10px 0;
      }
      
      .form-inline {
        flex-direction: column;
        align-items: stretch;
      }
    }
    </style>

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
              <div style="display: none" class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Customers Details </h4>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="datatable_1">
                                   
                                  </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
            
           
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Loader Report</h2>
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
                                
                                <form class="form-inline"method="get" action="{{ route('report.index') }}">
                                    @csrf
                                    <label for="email">From:</label>
                                    <input  type="date"  name="start_date">
                                    <label for="pwd">To:</label>
                                    <input type="date" name="end_date">
                                    <label for="product">Commission:</label>
                                    <select  name="commission_name">
                                      {{-- <option value="">Choose</option> --}}
                                      <option value="all">All</option>

                                      @foreach ($delivery as $deliverys)
                                        <option value="{{ $deliverys->name }}">{{ $deliverys->name }}</option>
                                      @endforeach
                                    </select>
                                    <label for="product">Sub Item:</label>
                                        <select name="product_name">
                                          {{-- <option value="">Choose</option> --}}
                                          <option value="all">All</option>
                                          @foreach ($product as $products)
                                            <option value="{{ $products->product_name }}">{{ $products->product_name }}</option>
                                          @endforeach
                                        </select>

                                    {{-- <input placeholder="Product" type="text" name="product_name">  --}}
                                  
                                    <button  type="submit"><i class="fas fa-search"></i></button>
                                  </form>

                                  <div class="row">
                                    <div class="col-md-3">
                                      <span><b>From</b>: {{ $startDate ? \Carbon\Carbon::parse($startDate)->format('m-d-Y') : '' }}</span>
                                  </div>
                                  
                                  <div class="col-md-3">
                                      <span><b>To</b>: {{ $endDate ? \Carbon\Carbon::parse($endDate)->format('m-d-Y') : '' }}</span>
                                  </div>
                                  
                                    <div class="col-md-3">
                                      <span ><b>Commission</b> : {{ $commissionName }} </span> 
                                      {{-- <span ><b>Commission</b> : {{ $productName }} </span>  --}}

                                    </div>
      
                                    <div class="col-md-3">
                                      <span ><b>Sub Item</b> : {{ $productName }} </span> 
                                    </div>
                                  </div>
      
                                
                                {{-- <h4 class="card-title">  <a class="btn btn-success" href="{{ route('sale.create') }}"> Create Sale</a></h4> --}}
                            </div><!--end card-header-->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="datatable_2">
                                        <thead class="thead-light">
                                          <tr>
                                            <th>ID</th>
                                            <th>Commission</th>
                                            <th>Border</th>
                                            <th>Sub Item</th>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            {{-- <th>Loaded Date</th> --}}
                                          
                                          </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transactions as $key=>$transaction)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $transaction->commissions->name ?? ''}}</td>
                                                <td>{{ $transaction->border->address ?? '' }}</td>
                                                <td>{{ $transaction->category->category_name ?? '' }}</td>
                                                <td>{{ $transaction->product->product_name ?? '' }}</td>
                                                <td>{{ $transaction->total_quantity }}</td>
                                                {{-- <td>{{ $transaction->date }}</td> --}}
                                                {{-- <td>{{ date('d-m-Y', strtotime($transaction->date)) }}</td> --}}

                                            </tr>
                                            @endforeach

                                            <thead class="thead-light">
                                              <tr>
                                                <th colspan="5"></th>
                                               
  
                                               
                                                     
                                                      <th>Total Quantity : {{ $transactions->sum('total_quantity') }}</th>
                                                     
  
                                                {{-- <th>Total</th> --}}
                                                {{-- <th></th> --}}
                                              </tr>
                                              </thead>
                                        </tbody>
                                           
                                             
                                        
                                        {{-- <tbody>
                                          @foreach ($total_quantity as $total_quantities)
                                                <tr>
                                                  <td>{{ $total_quantities->total_quantity }}</td>
                                                </tr>
                                          @endforeach
                                        </tbody> --}}
                                        
                                    </table>
                                    <button type="button" class="btn btn-sm btn-de-primary csv">Export CSV</button>
                                    <button type="button" class="btn btn-sm btn-de-primary sql">Export SQL</button>
                                    <button type="button" class="btn btn-sm btn-de-primary txt">Export TXT</button>
                                    <button type="button" class="btn btn-sm btn-de-primary" id="printTableButton">Print Table</button>
                                    {{-- <button type="button" class="btn btn-sm btn-de-primary json">Export JSON</button> --}}
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
              </script> <span class="text-muted d-none d-sm-inline-block float-end">Develop By by MindGigs </span>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js')}}"></script>
    <script>
      document.getElementById('printTableButton').addEventListener('click', function() {
          var printWindow = window.open('', '', 'width=800,height=600');
          var tableContent = document.getElementById('datatable_2').outerHTML;
          
          // Define CSS styles for the printed table
          var tableStyles = `
              <style>
                  /* Add your table styles here */
                  table {
                      width: 100%;
                      border-collapse: collapse;
                  }
                  th, td {
                      border: 1px solid #dddddd;
                      text-align: left;
                      padding: 8px;
                  }
                  th {
                      background-color: #f2f2f2;
                  }
                  tr:nth-child(even) {
                      background-color: #f2f2f2;
                  }
              </style>
          `;
          
          printWindow.document.open();
          printWindow.document.write('<html><head><title>Print Table</title>' + tableStyles + '</head><body><h1>Loader Report</h1>' + tableContent + '</body></html>');
          printWindow.document.close();
          printWindow.print();
          printWindow.close();
      });
  </script>
  
</body>

</html>