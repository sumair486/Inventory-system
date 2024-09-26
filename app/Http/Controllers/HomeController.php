<?php

namespace App\Http\Controllers;

use App\Models\BorderStock;
use App\Models\BorderWarehouse;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Warehouse;
use App\Models\WarehouseStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        $product=Product::all();
        $count_product=$product->count();
        



        // $customer=Sale::select('*')->groupBy('customer_name','warehouse_id','product_id')->count();
        $salesCounts = DB::table('sales')
        ->select('customer_name', 'warehouse_id', 'product_id')
        ->groupBy('customer_name', 'warehouse_id', 'product_id')
        ->get();

        // $stock=WarehouseStock::select('fine_quantity')->sum('fine_quantity');
        $stock=Warehouse::all();
        $stock_count=$stock->count();
        // $borderstock=BorderStock::select('quantity')->sum('quantity');
        $borderstock=BorderStock::select('border_warehouse_id')->groupBy('border_warehouse_id')->count();

        $border_warehouse=BorderWarehouse::all();
        $border_warehouse_count=$border_warehouse->count();

        $sale=Sale::select('sale_quantity')->sum('sale_quantity');
        return view('new_backend.index',compact('count_product','stock_count','salesCounts','border_warehouse_count','sale','borderstock'));
    }


}
