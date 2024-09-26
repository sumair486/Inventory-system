<?php

namespace App\Http\Controllers;

use App\Models\BorderStock;
use App\Models\BorderWarehouse;
use App\Models\Category;
use App\Models\Commission;
use App\Models\CommissionLedger;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\Warehouse;
use App\Models\WarehouseStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class ReportController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:report-list', ['only' => ['index','transfer_report','stock_report','sale_report']]);
        //  $this->middleware('permission:report-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:report-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:report-delete', ['only' => ['destroy']]);
    }
    // public function generateReport(Request $request)
    // {
    //     // Get input data from the request
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');
    //     $productId = $request->input('product_id');

    //     // Query the "transactions" table to fetch the report data
    //     $reportData = DB::table('transactions')
    //         ->whereBetween('date', [$startDate, $endDate])
    //         ->when($productId, function ($query) use ($productId) {
    //             return $query->where('product_id', $productId);
    //         })
    //         ->get();

    //     return response()->json($reportData.JSON_PRETTY_PRINT);
        
    // }

    public function index(Request $request)
    {
        $product = Product::all();
        $delivery = Commission::all();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $productName = $request->input('product_name');
        $commissionName = $request->input('commission_name');
        $query = CommissionLedger::whereBetween('transection_date', [$startDate, $endDate])
        ->select('*', DB::raw('SUM(delivered_quantity) as total_quantity'))
        ->groupBy('commission_agent_id', 'border_id','product_id');

    
        if ($productName && $productName !== 'all') { // Check if "All" is not selected
            $query->join('products', 'commission_ledgers.product_id', '=', 'products.id')
                ->where('products.product_name', 'like', '%' . $productName . '%');
        }
    
        if ($commissionName && $commissionName !== 'all') {
            $query->join('commissions', 'commission_ledgers.commission_agent_id', '=', 'commissions.id')
                ->where('commissions.name', 'like', '%' . $commissionName . '%');
        }
    
        // Execute the query
        $transactions = $query->get();
    
        return view('new_backend.reports.form', compact('transactions', 'product', 'delivery','startDate','endDate','productName','commissionName'));
    }
    

    public function transfer_report(Request $request)
    {
        $product=Product::all();
        $delivery=Commission::all();
       $border_warehouse = BorderWarehouse::all();

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $productName = $request->input('product_name');
        $commissionName = $request->input('commission_name');
        $query = Transfer::whereBetween('date', [$startDate, $endDate])
        ->selectRaw('warehouse_id, product_id,commission_agent_id,date,invoice_no, SUM(demage_quantity) as total_demage_quantity, SUM(loss_quantity) as total_loss_quantity, SUM(fine_quantity) as total_fine_quantity')
        ->groupBy('commission_agent_id','warehouse_id', 'product_id');
       
        if ($productName  && $productName !== 'all') {
           
            $query->join('products', 'transfers.product_id', '=', 'products.id')
                ->where('products.product_name', 'like', '%' . $productName . '%');
        }

        if ($commissionName && $commissionName !== 'all') {
            $query->join('commissions', 'transfers.commission_agent_id', '=', 'commissions.id')
                ->where('commissions.name', 'like', '%' . $commissionName . '%');
        }
        $transfers = $query->get();
       
    
        return view('new_backend.reports.transfer-report', compact('transfers','product',
        'delivery','startDate','endDate','productName','commissionName'));
    }


    public function stock_report(Request $request)
    {
        $product = Product::all();
        $warehouse = Warehouse::all();
    
        
        $productName = $request->input('product_name');
        $warehouseName = $request->input('warehouse_name');
    
        // $query = WarehouseStock::whereBetween('stock_date', [$startDate, $endDate]);
        $query = WarehouseStock::
        selectRaw('warehouse_id, product_id, SUM(damage_quantity) as total_demage_quantity, SUM(loss_quantity) as total_loss_quantity, SUM(fine_quantity) as total_fine_quantity')
        ->groupBy('warehouse_id', 'product_id');

    
        if ($productName && $productName !== 'all') {
            $query->join('products', 'warehouse_stocks.product_id', '=', 'products.id')
                ->where('products.product_name', 'like', '%' . $productName . '%');
        }
    
        if ($warehouseName && $warehouseName !== 'all') { 
            $query->join('warehouses', 'warehouse_stocks.warehouse_id', '=', 'warehouses.id')
                ->where('warehouses.name', 'like', '%' . $warehouseName . '%');
        }
    
        $stocks = $query->get();


    
        return view('new_backend.reports.stock-report', compact('stocks',
         'product', 'warehouse','productName','warehouseName'));
    }
    

    public function sale_report(Request $request)
    {
        $product=Product::all();
        $warehouse=Warehouse::all();
        // $startDate = $request->input('start_date');
        // $endDate = $request->input('end_date');
        $productName = $request->input('product_name');
        $warehouseName = $request->input('warehouse_name');
        // $customerName = $request->input('customer_name');

   
        $query = Sale::select('*');

        
        if ($productName && $productName !== 'all') {
           
            $query->join('products', 'sales.product_id', '=', 'products.id')
                ->where('products.product_name', 'like', '%' . $productName . '%');
        }
        if ($warehouseName && $warehouseName !== 'all') {
            $query->join('warehouses', 'sales.warehouse_id', '=', 'warehouses.id')
                ->where('warehouses.name', 'like', '%' . $warehouseName . '%');
        }
        // if ($customerName) {
        //     $query->where('sales.customer_name', 'like', '%' . $customerName . '%');
        // }

        $sales = $query->get();

        return view('new_backend.reports.sale-report', compact('sales','product','warehouse','productName','warehouseName'));
    }    


    // public function delivery_report(Request $request)
    // {
    //     $product=Product::all();
    //     $warehouse=Warehouse::all();
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');
    //     $productName = $request->input('product_name');
    //     $warehouseName = $request->input('warehouse_name');
    //     // $customerName = $request->input('customer_name');

   
    //     $query = Sale::select('*')->whereBetween('date', [$startDate, $endDate]);

        
    //     if ($productName && $productName !== 'all') {
           
    //         $query->join('products', 'sales.product_id', '=', 'products.id')
    //             ->where('products.product_name', 'like', '%' . $productName . '%');
    //     }
    //     if ($warehouseName && $warehouseName !== 'all') {
    //         $query->join('warehouses', 'sales.warehouse_id', '=', 'warehouses.id')
    //             ->where('warehouses.name', 'like', '%' . $warehouseName . '%');
    //     }
       

    //     $sales = $query->get();

    //     return view('new_backend.reports.delivery-ledger-report', compact('sales','product','warehouse','startDate','endDate','productName','warehouseName'));
    // }    


    public function delivery_report(Request $request)
    {
        $product = Product::all();
        $warehouse = Warehouse::all();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $productName = $request->input('product_name');
        $warehouseName = $request->input('warehouse_name');
        
        $query = CommissionLedger::select(
            'commission_ledgers.*',
            'warehouse_stocks.damage_quantity',
            'warehouse_stocks.loss_quantity',
            'warehouse_stocks.fine_quantity'
        )
        ->leftJoin('products', 'commission_ledgers.product_id', '=', 'products.id')
        ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
        ->leftJoin('borders', 'commission_ledgers.border_id', '=', 'borders.id')
        ->leftJoin('warehouse_stocks', function($join) use ($warehouseName) {
            $join->on('commission_ledgers.product_id', '=', 'warehouse_stocks.product_id')
                ->where('warehouse_stocks.warehouse_id', '=', $warehouseName);
        })
        ->whereBetween('commission_ledgers.transection_date', [$startDate, $endDate]);
    
        if ($productName && $productName !== 'all') {
            $query->where('products.product_name', 'like', '%' . $productName . '%');
        }
    
        $commissionLedgers = $query->get();
        // dd($commissionLedgers);
    
        return view('new_backend.reports.delivery-ledger-report', compact('commissionLedgers', 'product', 'warehouse', 'startDate', 'endDate', 'productName', 'warehouseName'));
    }
    

    //border report




    public function border_stock_report(Request $request)
    {
        $product = Product::all();
        $border_warehouse = BorderWarehouse::all();
        // $startDate = $request->input('start_date');
        // $endDate = $request->input('end_date');
        $productName = $request->input('product_name');
        $borderwarehouseName = $request->input('border_warehouse');
        $query = BorderStock::select('*',DB::raw('SUM(quantity) as total_quantity'))->groupBy('product_id','border_warehouse_id');
        // ->select('*', DB::raw('SUM(delivered_quantity) as total_quantity'))
        // ->groupBy('commission_agent_id', 'border_id','product_id');

    
        if ($productName && $productName !== 'all') { // Check if "All" is not selected
            $query->join('products', 'border_stocks.product_id', '=', 'products.id')
                ->where('products.product_name', 'like', '%' . $productName . '%');
        }
    
        if ($borderwarehouseName && $borderwarehouseName !== 'all') {
            $query->where('border_warehouse_id', BorderWarehouse::where('name', 'like', '%' . $borderwarehouseName . '%')->first()->id);
        }
    
        // Execute the query
        $transactions = $query->get();
    
        return view('new_backend.reports.border-stock-report', compact('transactions', 'product','productName','border_warehouse','borderwarehouseName'));
    }
    

    public function generateCombinedReport()
    {
        // Join the necessary tables to fetch the required data
        $report = DB::table('border_stocks')
            ->join('transfers', 'border_stocks.product_id', '=', 'transfers.product_id')
            ->join('warehouse_stocks', 'transfers.warehouse_id', '=', 'warehouse_stocks.warehouse_id')
            ->join('commissions', 'transfers.commission_agent_id', '=', 'commissions.id')
            ->select(
                'border_stocks.date as border_stock_date',
                'transfers.date as transfer_date',
                'warehouse_stocks.stock_date',
                'commissions.name as agent_name',
                'transfers.demage_quantity',
                'transfers.loss_quantity',
                'transfers.fine_quantity',
                'border_stocks.quantity as border_stock_quantity'
            )
            
            ->get();
            dd($report);
    }


    public function combineReport(Request $request)
{
           $border = BorderWarehouse::all();
        $warehouse = Warehouse::all();
        // $category = Category::all();
        $product = Product::all();
    // Retrieve filter parameters from the form
    $borderWarehouseId = $request->input('border_warehouse');
    $warehouseStockId = $request->input('warehouse_stock');
    $productId = $request->input('product_id');

    // Query the database based on filter criteria and retrieve the data for both tables

    // Query to retrieve border stock data
    $borderStocksQuery = BorderStock::query()
    ->select('*', DB::raw('SUM(quantity) as total_quantity'))
    ->groupBy('product_id','border_warehouse_id');
    
    if ($borderWarehouseId !== 'all') {
        $borderStocksQuery->where('border_warehouse_id', $borderWarehouseId);
    }
    if ($productId !== 'all') {
        $borderStocksQuery->where('product_id', $productId);
    }
    
    $borderStocks = $borderStocksQuery->get();

    // Query to retrieve warehouse stock data
    $warehouseStocksQuery = WarehouseStock::query()
    ->select('*', DB::raw('SUM(fine_quantity) as total_fine_quantity'),
    DB::raw('SUM(loss_quantity) as total_loss_quantity'),
    DB::raw('SUM(damage_quantity) as total_damage_quantity')
    
    )
    ->groupBy('product_id','warehouse_id');
    
    if ($warehouseStockId !== 'all') {
        $warehouseStocksQuery->where('warehouse_id', $warehouseStockId);
    }
    if ($productId !== 'all') {
        $warehouseStocksQuery->where('product_id', $productId);
    }
    
    $warehouseStocks = $warehouseStocksQuery->get();
    // dd($warehouseStocks);

    // Return the view with the data
    return view('new_backend.reports.combine-report', compact('borderStocks', 'warehouseStocks', 'border', 'warehouse', 'product'));
    // return view('combined-report', compact('borderStocks', 'warehouseStocks'));
}


    // public function combineReport(Request $request)
    // {
    //     $border = BorderWarehouse::all();
    //     $warehouse = Warehouse::all();
    //     $category = Category::all();
    //     $product = Product::all();
    
        
    //     $borderWarehouseId = $request->input('border_warehouse');
    //     $warehouseStockId = $request->input('warehouse_stock');
    //     $categoryId = $request->input('category_id');
    //     $productId = $request->input('product_id');
    
        
    //     $query = DB::table('border_stocks')
    //         ->join('warehouse_stocks', 'border_stocks.product_id', '=', 'warehouse_stocks.product_id')
    //         ->join('border_warehouses', 'border_stocks.border_warehouse_id', '=', 'border_warehouses.id')
    //         ->join('categories', 'border_stocks.category_id', '=', 'categories.id')
    //         ->join('products', 'border_stocks.product_id', '=', 'products.id')
    //         ->join('warehouses', 'warehouse_stocks.warehouse_id', '=', 'warehouses.id')
    //         ->groupBy('border_warehouse_id');
    
        
    //     if ($borderWarehouseId !== 'all') {
    //         $query->where('border_stocks.border_warehouse_id', $borderWarehouseId);
    //     }
    //     if ($warehouseStockId !== 'all') {
    //         $query->where('warehouse_stocks.warehouse_id', $warehouseStockId);
    //     }
    //     if ($categoryId !== 'all') {
    //         $query->where('border_stocks.category_id', $categoryId);
    //     }
    //     if ($productId !== 'all') {
    //         $query->where('border_stocks.product_id', $productId);
    //     }
    
    //     $combinedData = $query
    //         ->select(
    //             'border_warehouses.name as border_warehouse_name',
    //             'warehouses.name',
    //             'border_stocks.date',
    //             'categories.category_name',
    //             'products.product_name',
    //             // 'border_stocks.quantity',
    //             DB::raw('SUM(border_stocks.quantity) as total_quantity'),
    //             DB::raw('SUM(warehouse_stocks.fine_quantity) as total_fine_quantity'),
    //             DB::raw('SUM(warehouse_stocks.loss_quantity) as total_loss_quantity'),
    //             DB::raw('SUM(warehouse_stocks.damage_quantity) as total_damage_quantity')
    //         )
    //         ->get();
    //         // dd($combinedData);
    
    //     return view('new_backend.reports.combine-report', compact('combinedData', 'border', 'warehouse', 'category', 'product'));
    // }
    

  

}
