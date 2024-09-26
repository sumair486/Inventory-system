<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\CommissionLedger;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:commission-list|commission-create|commission-edit|commission-delete', ['only' => ['index','show','ledger_show']]);
         $this->middleware('permission:commission-create', ['only' => ['create','store','ledger_create','ledger_store','ledger_save']]);
         $this->middleware('permission:commission-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:commission-delete', ['only' => ['destroy','ledger_destroy']]);
    }


    public function create()
    {
        // $border=Border::all();
        // $category=Category::all();
        // $product=Product::all();
        // ,compact('border','category','product')
        return view('new_backend.commission.create');
    }

    public function store(Request $request)
    {
        $commission=new Commission();
        $commission->name=$request->name;
        // $commission->address=$request->address;
        // $commission->contact=$request->contact;
        // $commission->balance=$request->balance;
        $commission->save();
        
        return redirect()->route('commission.show')->with('success','commission successfully Added');
    }

    public function show()
    {
        $commission=Commission::all();
        return view('new_backend.commission.index',compact('commission'));
    }

    public function destroy(Commission $commission)
    {
        $commission->delete();
        return redirect()->route('commission.show')
        ->with('success','commission deleted successfully');
    }

    public function active_status($id)
    {
        $status=Commission::find($id);
        $status->status=0;
        $status->save();
        return redirect()->back()->with('success','successfully Updated');
    }


    public function inactive_status($id)
    {
        $status=Commission::find($id);
        $status->status=1;
        $status->save();
        return redirect()->back()->with('success','successfully Updated');
    }

    


    // ledger


    public function ledger_create()
    {
        $commission=Commission::where('status',1)->get();
        
        return view('new_backend.commission.ledger-create',compact('commission'));
    }

    public function ledger_store(Request $request)
    {
        $commission_ledger=new CommissionLedger();
        $commission_ledger->commission_agent_id=$request->commission_agent_id;
        $commission_ledger->delivered_quantity=$request->delivered_quantity;
        $commission_ledger->remaining_quantity=$request->remaining_quantity;
        $commission_ledger->transection_date=$request->transection_date;
        $commission_ledger->save();
        // dd($commission_ledger);
        
        return redirect()->route('commission_ledger.show')->with('success','commission ledger successfully Added');
    }



    public function ledger_show()
    {
        $commission_ledger=CommissionLedger::all();
        return view('new_backend.commission.ledger-index',compact('commission_ledger'));
    }

    public function ledger_destroy(CommissionLedger $commission_ledger)
    {
        $commission_ledger->delete();
        return redirect()->route('commission_ledger.show')
        ->with('success','commission Ledger deleted successfully');
    }

    public function ledger_add(CommissionLedger $commission_ledger)
    {

        return view('new_backend.commission.field-add',['commission_ledger' => $commission_ledger]);
    }

    // public function ledger_save(Request $request,CommissionLedger $commission_ledger)
    // {
    //     // dd($request->all());
    //     $request->validate([
    //         'delivered_quantity' => 'required|integer|min:0', 
    //     ]);
        
    
        
    //     $balanceToAdd = $request->delivered_quantity;
    
        
    //     $commission_ledger->delivered_quantity+= $balanceToAdd;
       
    //     $commission_ledger->save();
    
    //     // Redirect back or to wherever you want
    //     return redirect()->route('commission_ledger.show')->with('success', 'Remain Quantity added successfully.');
    // }

    public function ledger_save(Request $request, CommissionLedger $commission_ledger)
{
    $request->validate([
        'delivered_quantity' => 'required|integer|min:0',
    ]);

    $deliveredQuantityToAdd = $request->delivered_quantity;

    // Subtract the delivered_quantity from remaining_quantity
    $remainingQuantityToUpdate = $commission_ledger->remaining_quantity - $deliveredQuantityToAdd;

    // Ensure the remaining_quantity is not negative
    if ($remainingQuantityToUpdate < 0) {
        return redirect()->back()->with('error', 'Delivered quantity cannot exceed remaining quantity.');
    }

    // Update delivered_quantity and remaining_quantity
    $commission_ledger->delivered_quantity += $deliveredQuantityToAdd;
    $commission_ledger->remaining_quantity = $remainingQuantityToUpdate;

    $commission_ledger->save();

    // Redirect back or to wherever you want
    return redirect()->route('commission_ledger.show')->with('success', 'Delivered and remaining quantities updated successfully.');
}


   
}
