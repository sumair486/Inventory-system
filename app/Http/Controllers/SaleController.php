<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sale;
use App\Models\Transfer;
use App\Models\Warehouse;
use App\Models\WarehouseStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:sale-list|sale-create|sale-edit|sale-delete', ['only' => ['index','show']]);
         $this->middleware('permission:sale-create', ['only' => ['create','store']]);
         $this->middleware('permission:sale-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:sale-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $customer = Customer::all();
        $warehouses = WarehouseStock::select('*')->groupBy('warehouse_id')->get();
    
        return view('new_backend.sales.create', compact('customer', 'warehouses'));
    }
    public function store(Request $request)
    {
        // Calculate the total sale quantity for all selected products
        $totalSaleQuantity = $request->sale_quantity;
    
        // Fetch all warehouse stock records for the selected product(s)
        $warehouseStocks = WarehouseStock::where('warehouse_id', $request->warehouse_id)->whereIn('product_id', $request->product_id)->get();
    
        // Calculate the total fine_quantity for the selected product(s)
        $totalFineQuantity = $warehouseStocks->sum('fine_quantity');
    
        // Check if the new fine_quantity is less than 0
        $newFineQuantity = $totalFineQuantity - $totalSaleQuantity;
    
        if ($newFineQuantity < 0) {
            // Return an error message for low stock
            return redirect()->back()->with('error', 'Stock has low quantity.');
        }
    
        // If the new fine_quantity is not less than 0, proceed with the sale
        $store = new Sale();
        $store->customer_name = $request->customer_name;
        // $store->mobile = $request->mobile;
        // ... (other fields)
        $store->warehouse_id = $request->warehouse_id;
        $store->product_id = implode(',', $request->product_id); // Combine product IDs as a comma-separated string
        $store->sale_quantity = $totalSaleQuantity; // Store as an integer
        $store->date = $request->date;
    
        // Subtract the sale_quantity from the total fine_quantity for the selected product(s)
        foreach ($request->product_id as $productId) {
            $warehouseStocksForProduct = $warehouseStocks->where('product_id', $productId);
    
            $productTotalFineQuantity = $warehouseStocksForProduct->sum('fine_quantity');
    
            // Update the fine_quantity for all warehouse stock records of the selected product(s)
            $saleQuantityForProduct = $totalSaleQuantity;
            $warehouseStocksForProduct->each(function ($warehouseStock) use ($saleQuantityForProduct, $productTotalFineQuantity) {
                $newFineQuantityForRecord = $warehouseStock->fine_quantity - ($saleQuantityForProduct * ($warehouseStock->fine_quantity / $productTotalFineQuantity));
                $warehouseStock->fine_quantity = $newFineQuantityForRecord;
                $warehouseStock->save();
            });
        }
    
        // Save the sale record
        $store->save();
    
        return redirect()->route('sale.show')->with('success', 'Sale successfully added.');
    }
    
    

    


    //new code




    public function show()
    {
        $sale=Sale::all();
        return view('new_backend.sales.index',compact('sale'));
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
    
        return redirect()->route('sale.show')
                        ->with('success','Sale deleted successfully');
    }


    public function getWarehouseData($warehouseId)
    {
       

        $warehouses = WarehouseStock::where('warehouse_id', $warehouseId)
        ->with('products')
        ->select('product_id', 'fine_quantity',DB::raw('SUM(fine_quantity) as total_quantity'))
        ->groupBy('product_id')
        ->get();
    
    return response()->json(['warehouses' => $warehouses]);
    }


//     public function store(Request $request)
// {
//     // Validate your form inputs here

//     $warehouseId = $request->input('warehouse_id');
//     $productId = $request->input('product_id');
//     $saleQuantity = $request->input('sale_quantity');

//     // Calculate the total fine_quantity for the selected warehouse and product_id
//     $totalFineQuantity = WarehouseStock::where('warehouse_id', $warehouseId)
//         ->where('product_id', $productId)
//         ->sum('fine_quantity');

//     // Calculate the updated sale_quantity
//     $updatedSaleQuantity = $saleQuantity - $totalFineQuantity;

//     // Update the sales table with the calculated sale_quantity
//     Sale::create([
//         'customer_name' => $request->input('customer_name'),
//         'mobile' => $request->input('mobile'),
//         'warehouse_id' => $warehouseId,
//         'product_id' => $productId,
//         'sale_quantity' => $updatedSaleQuantity,
//         'date' => now(), // You can adjust this as needed
//     ]);

//     // Update the warehousestock table with the updated fine_quantity
//     WarehouseStock::where('warehouse_id', $warehouseId)
//         ->where('product_id', $productId)
//         ->decrement('fine_quantity', $totalFineQuantity);

//     // You can also add any additional logic, redirection, or responses here

//     return redirect()->back()->with('success', 'Sale created successfully');
// }


//     public function getWarehouseData(Request $request)
// {
//     // Retrieve the selected warehouse IDs from the request
//     $warehouseIds = $request->input('warehouse_ids');

//     // Fetch warehouse stock records for the selected warehouses and product
//     $warehouses = WarehouseStock::whereIn('warehouse_id', $warehouseIds)
//         ->with('products')
//         ->select('product_id', DB::raw('SUM(fine_quantity) as total_quantity'))
//         ->groupBy('product_id')
//         ->get();

//     return response()->json(['warehouses' => $warehouses]);
// }

public function getProductsWithFineQuantity(Request $request)
{
    $warehouseId = $request->input('warehouse_id');

    // Fetch products and their fine_quantity for the selected warehouse
    $products = WarehouseStock::where('warehouse_id', $warehouseId)->get();

    return response()->json(['products' => $products]);
}

   

 // $warehouses=WarehouseStock::where('warehouse_id',$warehouseId)
    // ->with('products')->select('id','product_id','fine_quantity as total_quantity')
    // ->get();
}
