<?php

namespace App\Http\Controllers;

use App\Models\Border;
use App\Models\Category;
use App\Models\Commission;
use App\Models\CommissionLedger;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

class TransactionController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:transaction-list|transaction-create|transaction-edit|transaction-delete', ['only' => ['index','show']]);
         $this->middleware('permission:transaction-create', ['only' => ['create','store']]);
         $this->middleware('permission:transaction-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:transaction-delete', ['only' => ['destroy']]);
    }


    public function create()
    {
        $border=Border::all();
        $category=Category::all();
        $product=Product::all();
        $commission=Commission::where('status',1)->get();
        

        return view('new_backend.transactions.create',compact('border','category','product','commission'));
    }

    
    

    public function getCommissionDate($commissionId)
{
    $commission = Commission::find($commissionId);

    if ($commission) {
        return response()->json(['date' => $commission->date]);
    } else {
        return response()->json(['error' => 'Commission not found'], 404);
    }
}



public function getCommissionQuantity($commissionAgentId)
{
    $quantity = CommissionLedger::where('commission_agent_id', $commissionAgentId)
        ->sum('delivered_quantity');
    

    return response()->json(['quantity' => $quantity]);
}


public function store(Request $request)
{
    $transaction = new Transaction();
    $transaction->commission_agent_id = $request->commission_agent_id;
    $transaction->border_id = $request->border_id;
    $transaction->category_id = $request->category_id;
    $transaction->product_id = $request->product_id;
    $transaction->quantity = $request->quantity;
    $transaction->date = $request->date;
    $transaction->save();

    $commission_ledger=new CommissionLedger();
    $commission_ledger->commission_agent_id=$request->commission_agent_id;
    $commission_ledger->product_id=$request->product_id;
    $commission_ledger->category_id=$request->category_id;
    $commission_ledger->border_id=$request->border_id;
    $commission_ledger->transection_date=$request->date;

    $commission_ledger->delivered_quantity=$request->quantity;
    
    $commission_ledger->balance="0";
    $commission_ledger->save();



    // $commissionLedger = CommissionLedger::where('commission_agent_id', $request->commission_agent_id)->first();

    // if ($commissionLedger) {
    
    //     if ($commissionLedger->delivered_quantity - $request->quantity < 0) {
        
    //         return redirect()->route('transaction.show')->with('error', 'Subtraction not allowed. Delivered quantity cannot be negative.');
    //     }

    
    //     $commissionLedger->delivered_quantity -= $request->quantity;
    //     $commissionLedger->save();
    // }
        
    return redirect()->route('transaction.show')->with('success', 'Loader successfully added');
}


    public function show()
    {
        // $transaction=Transaction::all();
        
$transaction = Transaction::select('*', DB::raw('SUM(quantity) as total_quantity'))
->groupBy('commission_agent_id','border_id','category_id','product_id','date')
->get();
        
    
        return view('new_backend.transactions.index',compact('transaction'));
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transaction.show')
        ->with('success','Loader deleted successfully');
    }

    public function transaction_add(Transaction $transaction)
    {

        return view('new_backend.transactions.field-add',['transaction' => $transaction]);
    }

    public function transaction_save(Request $request,Transaction $transaction)
    {
        // dd($request->all());
        $request->validate([
            'quantity' => 'required|integer|min:0', 
        ]);
        
    
        
        $balanceToAdd = $request->quantity;
    
        
        $transaction->quantity+= $balanceToAdd;
        $transaction->save();
    
        // Redirect back or to wherever you want
        return redirect()->route('transaction.show')->with('success', 'Quantity added successfully.');
    }

    public function edit($id)
    {
        $transaction=Transaction::find($id);
        $border=Border::all();
        $category=Category::all();
        $product=Product::all();
        $commission=Commission::where('status',1)->get();
        return view('new_backend.transactions.edit',compact('transaction','border','category','product','commission'));
    }


    public function update(Request $request, $id)
{
    $transaction = Transaction::find($id);


    $transaction->commission_agent_id = $request->input('commission_agent_id');
    $transaction->border_id = $request->input('border_id');
    $transaction->category_id = $request->input('category_id');
    $transaction->product_id = $request->input('product_id');
    $transaction->quantity = $request->input('quantity');
    $transaction->date = $request->input('date');

    // Save the updated transaction
    $transaction->save();

    // Redirect to a success page or return a response
    return redirect()->route('transaction.show')->with('success', 'Transaction updated successfully.');
}



        
}
