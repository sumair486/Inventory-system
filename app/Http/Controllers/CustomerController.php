<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sale;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
    
        return view('new_backend.customers.create');
    }

    public function store(Request $request)
    {
        $store=new Customer();
        $store->name=$request->name;
        $store->address=$request->address;
        $store->mobile=$request->mobile;
        $store->email=$request->email;
        $store->opening_balance	=$request->opening_balance;

        $store->save();
        
        return redirect()->route('customer.show')->with('success','customer successfully Added');
    }

    public function show()
    {
        $customer=Sale::all();
        return view('new_backend.customers.index',compact('customer'));
    }

    public function destroy(Customer $customer)
    {
        // dd($category);
        $customer->delete();
    
        return redirect()->route('customer.show')
                        ->with('success','customer deleted successfully');
    }
}
