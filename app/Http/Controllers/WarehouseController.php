<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Models\WarehouseStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WarehouseController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:warehouse-list|warehouse-create|warehouse-edit|warehouse-delete', ['only' => ['index','show','warehouse_stock']]);
         $this->middleware('permission:warehouse-create', ['only' => ['create','store']]);
         $this->middleware('permission:warehouse-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:warehouse-delete', ['only' => ['warehouse_destroy']]);
    }

    public function index()
    {

    
        return view('new_backend.warehouse.warehouse-create');
    }

    public function store(Request $request)
    {
        $store=new Warehouse();
        $store->name=$request->name;
        $store->location=$request->location;
        $store->contact=$request->contact;
        $store->save();
        
        return redirect()->route('warehouse.show')->with('success','warehouse successfully Added');
    }

    public function show()
    {
        $warehouse=Warehouse::all();
        return view('new_backend.warehouse.warehouse-index',compact('warehouse'));
    }

    public function destroy(Warehouse $warehouse)
    {
        // dd($category);
        $warehouse->delete();
    
        return redirect()->route('warehouse.show')
                        ->with('success','warehouse deleted successfully');
    }

    public function warehouse_stock()
    {

        $warehouse_stock=WarehouseStock::select('*',
        DB::raw('SUM(damage_quantity) as total_demage_quantity'),
        DB::raw('SUM(loss_quantity) as total_loss_quantity'),
        DB::raw('SUM(fine_quantity) as total_fine_quantity')
        )
        ->groupBy('warehouse_id','product_id')
        ->get();
        return view('new_backend.warehouse.warehouse-stock-index',compact('warehouse_stock'));
    }

    public function warehouse_destroy(WarehouseStock $stock)
    {
        // dd($category);
        $stock->delete();
    
        return redirect()->route('warehouse-stock.show')
                        ->with('success','stock deleted successfully');
    }

}
