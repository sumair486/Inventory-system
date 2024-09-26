<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BorderStock;
use App\Models\BorderWarehouse;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\WarehouseStock;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function dashboard()
    {
        $product=Product::all();
        $count_product=$product->count();

        // $customer=Sale::select('*')->groupBy('customer_name','warehouse_id','product_id')->count();
        $salesCounts = DB::table('sales')
        ->select('customer_name', 'warehouse_id', 'product_id')
        ->groupBy('customer_name', 'warehouse_id', 'product_id')
        ->get();

       

        // $stock=Warehouse::all();

        // $stock=WarehouseStock::select('fine_quantity')->sum('fine_quantity');
        $stock=Warehouse::all();
        $stock_count=$stock->count();

        $border_warehouse=BorderWarehouse::all();
        $border_warehouse_count=$border_warehouse->count();



        // $borderstock=BorderStock::select('*',DB::raw('SUM(border_warehouse_id) as total_warehouse'))->groupBy('border_warehouse_id')->get();
        // dd($borderstock);
        $borderstock=BorderStock::select('border_warehouse_id')->groupBy('border_warehouse_id')->count();


        $sale=Sale::select('sale_quantity')->sum('sale_quantity');
        return view('new_backend.index',compact('count_product','salesCounts','sale','stock_count','borderstock','border_warehouse_count'));

    }

    public function getwarestock()
    {
        $warehouse_stock=Warehouse::all();
   
   



        return view('new_backend.stock_detail.getwarehouse',compact('warehouse_stock'));
    }

    public function getwarestockproduct($id)
    {
        // dd($id);

        $warehouse_stock_product=WarehouseStock::select('*' , DB::raw('SUM(damage_quantity) as total_demage_quantity'),
        DB::raw('SUM(loss_quantity) as total_loss_quantity'),
        DB::raw('SUM(fine_quantity) as total_fine_quantity')
        )->where('warehouse_id',$id)->groupBy('product_id')->get();
        return view('new_backend.stock_detail.product_detail',compact('warehouse_stock_product'));
    }

    public function getborder()
    {
        // $border=BorderStock::select('*',DB::raw('SUM(quantity) as total_quantity'))->groupBy('border_warehouse_id')->get();
        $border=BorderWarehouse::all();
        return view('new_backend.border_detail.getborder',compact('border'));
    }

    public function getborderproduct($id)
    {
        $border_product=BorderStock::select('*',DB::raw('SUM(quantity) as total_quantity'))->where('border_warehouse_id',$id)->groupBy('product_id')->get();
        // dd($border_product);
        return view('new_backend.border_detail.product_detail',compact('border_product'));
    }
   
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('new_backend.users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('new_backend.users.create',compact('roles'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('new_backend.users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('new_backend.users.edit',compact('user','roles','userRole'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
    
}
