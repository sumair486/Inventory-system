<?php

namespace App\Http\Controllers;

use App\Models\BorderStock;
use App\Models\Commission;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\Warehouse;
use App\Models\WarehouseStock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:transfer-list|transfer-create|transfer-edit|transfer-delete', ['only' => ['index','show']]);
         $this->middleware('permission:transfer-create', ['only' => ['create','store']]);
         $this->middleware('permission:transfer-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:transfer-delete', ['only' => ['destroy']]);
    }
 
    public function create()
    {
        $commission=Commission::all();
        // $transaction_date=Transaction::select('*')
        // ->groupBy('commission_agent_id','date')
        // ->get();
        $warehouse_border=BorderStock::groupBy('border_warehouse_id')->get();
        $warehouse=Warehouse::all();
        $product=Product::all();
  
        return view('new_backend.transfer.create',compact('commission','warehouse','product','warehouse_border'));
    }

    //
    public function getProducts(Request $request)
    {
        $borderWarehouseId = $request->input('borderWarehouseId');
    
        // Retrieve products based on the selected "Border Warehouse" with the product name and quantity
        $products = BorderStock::where('border_warehouse_id', $borderWarehouseId)
            ->with('product')
            ->get();
    
        $productData = $products->groupBy('product_id')->map(function ($group) {
            return [
                'name' => $group->first()->product->product_name,
                'quantity' => $group->sum('quantity')
            ];
        });
    
        return response()->json($productData);
    }
    

 





public function store(Request $request)
{
    // dd($request->all());
    // Validation rules for arrays
    
    $rules = [
        'demage_quantity.*' => 'required|integer|min:0',
        'loss_quantity.*' => 'required|integer|min:0',
        'fine_quantity.*' => 'required|integer|min:0',
        'commission_agent_id' => 'required',
        'border_warehouse_id.*' => 'required',
        'warehouse_id.*' => 'required',
        'invoice_no'=> 'required|integer|unique:transfers',
        'product_id.*' => 'required',
        'date' => 'required',
    ];

    $request->validate($rules);

    if ($request->hasFile('file')) {
        $image = $request->file('file');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move('border_transfer', $imageName);
    // Loop through the multiple forms
    // $borderWarehouseId = $request->input('border_warehouse_id', []);
    foreach ($request->input('border_warehouse_id', []) as $key => $borderWarehouseId) {
        // dd($key);
        // Ensure the input values exist before using them
        $demageQuantity = $request->input('demage_quantity', [])[$key];
        // dd($demageQuantity);
        $lossQuantity = $request->input('loss_quantity', [])[$key];
        $fineQuantity = $request->input('fine_quantity', [])[$key];
        $productID = $request->input('product_id', [])[$key];
        $warehouseID = $request->input('warehouse_id', [])[$key];

        // Calculate the total change (fine + loss + damage) for this form
        $totalChange = $demageQuantity + $lossQuantity + $fineQuantity;

        // Find and lock the corresponding border stock for the product_id
        $borderStocks = BorderStock::where([
            'border_warehouse_id' => $borderWarehouseId,
            'product_id' => $productID
        ])->lockForUpdate()->get();

        if ($borderStocks->isEmpty()) {
            return redirect()->back()->with('error', 'Border stock not found.');
        }

        $totalAvailableQuantity = $borderStocks->sum('quantity');

        // Check if there's enough total quantity to deduct
        if ($totalAvailableQuantity < $totalChange) {
            return redirect()->back()->with('error', 'Not enough quantity available in the border stock.');
        }

        // Distribute the quantity change across the border stock records
        foreach ($borderStocks as $borderStock) {
            $quantityToDeduct = min($borderStock->quantity, $totalChange);
            $borderStock->quantity -= $quantityToDeduct;
            $borderStock->save();
            $totalChange -= $quantityToDeduct;

            if ($totalChange == 0) {
                break; // No more quantity to deduct
            }
        }

       

        // Create a new transfer record for this form
        Transfer::create([
            'commission_agent_id' => $request->input('commission_agent_id'),
            'border_warehouse_id' => $borderWarehouseId,
            'warehouse_id' => $warehouseID,
            'product_id' => $productID,
            'date' => $request->input('date'),
            'invoice_no' => $request->input('invoice_no'),

            'demage_quantity' => $demageQuantity,
            'loss_quantity' => $lossQuantity,
            'fine_quantity' => $fineQuantity,
            'status' => 'Delivered',
            'image' => $imageName,
        ]);
   

        

        // Update the warehouse stock for this form
        $warehouseStock = new WarehouseStock();
        $warehouseStock->warehouse_id = $warehouseID;
        $warehouseStock->product_id = $productID;
        $warehouseStock->damage_quantity = $demageQuantity;
        $warehouseStock->loss_quantity = $lossQuantity;
        $warehouseStock->fine_quantity = $fineQuantity;
        $warehouseStock->stock_date = $request->input('date');
        $warehouseStock->save();
    }
}

    return redirect()->route('transfer.show')->with('success', 'Successfully Added');
}


public function transfer_edit($id)
{
    $transfer = Transfer::find($id);
    $commission=Commission::all();
    // $transaction_date=Transaction::select('*')
    // ->groupBy('commission_agent_id','date')
    // ->get();
    $warehouse_border=BorderStock::groupBy('border_warehouse_id')->get();
    $warehouse=Warehouse::all();
    $product=Product::all();
//     $transferDetails = Transfer::where('invoice_no', $id)->get();
// // dd($transferDetails);

    // You can also load any necessary data for your form, like commission agents, warehouses, etc.

    return view('new_backend.transfer.edit', compact('transfer','commission','warehouse','product','warehouse_border'));
}

public function transfer_update(Request $request, $id)
{
    $rules = [
        'demage_quantity.*' => 'required|integer|min:0',
        'loss_quantity.*' => 'required|integer|min:0',
        'fine_quantity.*' => 'required|integer|min:0',
        'commission_agent_id' => 'required',
        'border_warehouse_id.*' => 'required',
        'warehouse_id.*' => 'required',
        'invoice_no' => 'required|integer',
        'product_id.*' => 'required',
        'date' => 'required',
    ];

    $request->validate($rules);

    if ($request->hasFile('file')) {
        $image = $request->file('file');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move('border_transfer', $imageName);
    }

    // Loop through the multiple forms
    foreach ($request->input('border_warehouse_id', []) as $key => $borderWarehouseId) {
        // Ensure the input values exist before using them
        $demageQuantity = $request->input('demage_quantity', [])[$key];
        $lossQuantity = $request->input('loss_quantity', [])[$key];
        $fineQuantity = $request->input('fine_quantity', [])[$key];
        $productID = $request->input('product_id', [])[$key];
        $warehouseID = $request->input('warehouse_id', [])[$key];

        // Find and lock the corresponding border stock for the product_id
        $borderStocks = BorderStock::where([
            'border_warehouse_id' => $borderWarehouseId,
            'product_id' => $productID
        ])->lockForUpdate()->get();

        if ($borderStocks->isEmpty()) {
            return redirect()->back()->with('error', 'Border stock not found.');
        }

        $totalAvailableQuantity = $borderStocks->sum('quantity');

        // Check if there's enough total quantity to deduct
        $totalChange = $demageQuantity + $lossQuantity + $fineQuantity;
        if ($totalAvailableQuantity < $totalChange) {
            return redirect()->back()->with('error', 'Not enough quantity available in the border stock.');
        }

        // Distribute the quantity change across the border stock records
        foreach ($borderStocks as $borderStock) {
            $quantityToDeduct = min($borderStock->quantity, $totalChange);
            $borderStock->quantity -= $quantityToDeduct;
            $borderStock->save();
            $totalChange -= $quantityToDeduct;

            if ($totalChange == 0) {
                break; // No more quantity to deduct
            }
        }

        // Update the existing transfer record
        $transfer = Transfer::find($id);
        $transfer->commission_agent_id = $request->input('commission_agent_id');
        $transfer->border_warehouse_id = $borderWarehouseId;
        $transfer->warehouse_id = $warehouseID;
        $transfer->product_id = $productID;
        $transfer->date = $request->input('date');
        $transfer->invoice_no = $request->input('invoice_no');
        $transfer->demage_quantity = $demageQuantity;
        $transfer->loss_quantity = $lossQuantity;
        $transfer->fine_quantity = $fineQuantity;
        $transfer->image = $imageName;
        $transfer->save();

        // Update the warehouse stock for this form
        $warehouseStock = WarehouseStock::where('warehouse_id', $warehouseID)
            ->where('product_id', $productID)
            ->first();

        if ($warehouseStock) {
            $warehouseStock->damage_quantity = $demageQuantity;
            $warehouseStock->loss_quantity = $lossQuantity;
            $warehouseStock->fine_quantity = $fineQuantity;
            $warehouseStock->stock_date = $request->input('date');
            $warehouseStock->save();
        }
    }

    return redirect()->route('transfer.show')->with('success', 'Successfully Updated');
}


    

    public function show()
    {
        // $transfer=Transfer::all();
        $transfer=Transfer::select('*',
        DB::raw('SUM(demage_quantity) as total_demage_quantity'),
        DB::raw('SUM(loss_quantity) as total_loss_quantity'),
        DB::raw('SUM(fine_quantity) as total_fine_quantity')
        )
        ->groupBy('product_id','invoice_no')
        ->orderBy('created_at', 'desc')
        ->get();
        // dd($transfer);
        return view('new_backend.transfer.index',compact('transfer'));
    }

    public function destroy(Transfer $transfer)
    {
        $transfer->delete();
        return redirect()->route('transfer.show')
        ->with('success','Transfer deleted successfully');
    }

    public function detail($id)
    {
        $transfer=Transfer::where('transaction_id',$id)->get();
        $tot_transfer=Transfer::select('*',
        DB::raw('SUM(demage_quantity) as tot_demage'),
        DB::raw('SUM(loss_quantity) as tot_loss_quantity'),
        DB::raw('SUM(fine_quantity) as tot_fine_quantity'),
        DB::raw('SUM(demage_quantity+loss_quantity+fine_quantity) as gross_tot'),
        )->where('transaction_id',$id)->get();

        
        return view('new_backend.transfer.detail',compact('transfer','tot_transfer'));
    }

    public function edit($id)
    {
        $commission=Transaction::select('*')
        ->groupBy('commission_agent_id')

        ->get();
        $transaction_date=Transaction::select('*')
        ->groupBy('commission_agent_id','date')
        ->get();
        $warehouse=Warehouse::all();
        $product=Product::all();
        $transfer=Transfer::find($id);

        return view('new_backend.transfer.edit' , compact('commission','transaction_date','warehouse','product'));

    }
}
