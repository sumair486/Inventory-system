<?php

namespace App\Http\Controllers;

use App\Models\Border;
use App\Models\BorderDetail;
use App\Models\BorderStock;
use App\Models\BorderTransaction;
use App\Models\BorderWarehouse;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:setting-list|setting-create|setting-edit|setting-delete', ['only' => ['index','show','category_index','category_show','company_index','company_show','border_index','border_show']]);
         $this->middleware('permission:setting-create', ['only' => ['create','store','category_store','company_store','border_store']]);
        //  $this->middleware('permission:setting-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:setting-delete', ['only' => ['destroy','category_destroy','company_destroy','border_destroy']]);
    }
    
    public function index()
    {
    
        return view('new_backend.settings.create');
    }

    public function store(Request $request)
    {
        $store=new Brand();
        $store->brand_name=$request->brand_name;
        $store->save();
        
        return redirect()->route('brand.show')->with('success','Brand successfully Added');
    }

    public function show()
    {
        $brand=Brand::all();
        return view('new_backend.settings.brand-index',compact('brand'));
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
    
        return redirect()->route('brand.show')
                        ->with('success','Brand deleted successfully');
    }


    //category

    public function category_index()
    {
    
        return view('new_backend.settings.category-create');
    }

    public function category_store(Request $request)
    {
        $store=new Category();
        $store->category_name=$request->category_name;
        $store->save();
        
        return redirect()->route('category.show')->with('success','Category successfully Added');
    }

    public function category_show()
    {
        $category=Category::all();
        return view('new_backend.settings.category-index',compact('category'));
    }

    public function category_destroy(Category $category)
    {
        // dd($category);
        $category->delete();
    
        return redirect()->route('category.show')
                        ->with('success','category deleted successfully');
    }

    // company

    public function company_index()
    {
    
        return view('new_backend.settings.company-create');
    }

    public function company_store(Request $request)
    {
        $store=new Company();
        $store->company_name=$request->company_name;
        $store->save();
        
        return redirect()->route('company.show')->with('success','Company successfully Added');
    }

    public function company_show()
    {
        $company=Company::all();
        return view('new_backend.settings.company-index',compact('company'));
    }

    public function company_destroy(Company $company)
    {
        // dd($category);
        $company->delete();
    
        return redirect()->route('company.show')
                        ->with('success','company deleted successfully');
    }


    
    // border

    public function border_index()
    {
    
        return view('new_backend.settings.border-create');
    }

    public function border_store(Request $request)
    {
        $store=new Border();
        $store->address=$request->address;
        $store->location=$request->location;

        $store->save();
        
        return redirect()->route('border.show')->with('success','border successfully Added');
    }

    public function border_show()
    {
        $border=Border::all();
        return view('new_backend.settings.border-index',compact('border'));
    }

    public function border_destroy(Border $border)
    {
        // dd($category);
        $border->delete();
    
        return redirect()->route('border.show')
                        ->with('success','border deleted successfully');
    }

    // public function transaction_index()
    // {
    //     return view('new_backend.transactions.create');
    // }

    // public function transfer_index()
    // {
    //     return view('new_backend.transfer.create');
    // }

    // public function sale_index()
    // {
    //     return view('new_backend.sales.create');
    // }

    public function border_transaction()
    {
        $border=Border::all();
        $products=Product::all();
        $categories=Category::all();
        $border_warehouse=BorderWarehouse::all();
        return view('new_backend.settings.border-transaction',compact('border','products','categories','border_warehouse'));
    }

    //border transaction edit

    // public function border_transaction_edit($id)
    // {
    //     $border=Border::all();
    //     $products=Product::all();
    //     $categories=Category::all();
    //     $border_warehouse=BorderWarehouse::all();
    //     $border_edit=BorderTransaction::find($id);
    //     // dd($border_edit);

    //     return view('new_backend.settings.border_transaction.border_transaction_edit' ,compact('border_edit','border','products','categories','border_warehouse'));

    // }

    public function border_transaction_store(Request $request)
    {

        $request->validate([
            'invoice_no'=> 'required|integer|unique:border_transactions'
        ]);
        // $borderId = $request->input('border_id');
        $borderWarehouseIds = $request->input('border_warehouse_id');
        $dates = $request->input('date');
        $invoices = $request->input('invoice_no');

        $categoryIds = $request->input('category_id');
        $productIds = $request->input('product_id');
        $quantities = $request->input('quantity');
    
        // Loop through the submitted data and save each entry in the database
        
            // Save in BorderTransaction table
            $borderTransaction = new BorderTransaction();
            // $borderTransaction->border_id = $borderId;
            $borderTransaction->border_warehouse_id = $borderWarehouseIds;
            $borderTransaction->date = $dates;
            $borderTransaction->invoice_no = $invoices;
            $image=$request->file;
            $imagename=time().'.'.$image->getClientoriginalExtension();
            $request->file->move('border_transaction',$imagename);
            $borderTransaction->image=$imagename;
            
     
            $borderTransaction->save();
            // dd($)
            for ($i = 0; $i < count($categoryIds); $i++) {
            // Save in BorderDetail table
            $borderDetail = new BorderDetail();
            // $borderDetail->border_id = $borderId;
            $borderDetail->border_transaction_id = $borderTransaction->id;
            
            // $borderDetail->date = $dates;
            $borderDetail->category_id = $categoryIds[$i];
            $borderDetail->product_id = $productIds[$i];
            $borderDetail->quantity = $quantities[$i];
            $borderDetail->save();
    
            // Save in BorderStock table
            $borderStock = new BorderStock();
            // $borderStock->border_id = $borderId;
            $borderStock->border_warehouse_id = $borderWarehouseIds;
            $borderStock->border_transaction_id = $borderTransaction->id;
            $borderStock->date = $dates;
            $borderStock->category_id = $categoryIds[$i];
            $borderStock->product_id = $productIds[$i];
            $borderStock->quantity = $quantities[$i];
            $borderStock->save();
        }
    
        return redirect()->route('border.detail.show')->with('success', 'Form Submitted');
    }


    // example edit
    public function border_transaction_edit($id)
    {
        $border = Border::all();
        $products = Product::all();
        $categories = Category::all();
        $border_warehouse = BorderWarehouse::all();
        $border_edit = BorderTransaction::find($id);
    
        // Fetch related data (e.g., border details) based on $id
        $borderDetails = BorderDetail::where('border_transaction_id', $id)->get();
    // dd($borderDetails);
        return view('new_backend.settings.border_transaction.border_detail_edit', compact('border_edit', 'border', 'products', 'categories', 'border_warehouse', 'borderDetails'));
    }

    public function border_transaction_update(Request $request, $id)
{
    $request->validate([
        'invoice_no' => 'required|integer|unique:border_transactions,invoice_no,' . $id,
        'border_warehouse_id' => 'required|exists:border_warehouses,id',
        'date' => 'required|date',
        // Add other validation rules as needed
    ]);

    $borderTransaction = BorderTransaction::find($id);

    // Update the existing data with the edited values
    $borderTransaction->invoice_no = $request->input('invoice_no');
    $borderTransaction->border_warehouse_id = $request->input('border_warehouse_id');
    $borderTransaction->date = $request->input('date');
    // Update other fields as needed

    // Handle the image update
    if ($request->hasFile('file')) {
        $image = $request->file('file');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move('border_transaction', $imageName);
        $borderTransaction->image = $imageName;
    }
    // dd($borderTransaction);

    // Save the updated record
    $borderTransaction->save();
    // Update related Border Details (assuming dynamic fields)
    $categoryIds = $request->input('category_id');
    $productIds = $request->input('product_id');
    $quantities = $request->input('quantity');

    $borderTransaction->borderDetails()->delete(); // Remove existing details and re-add

    for ($i = 0; $i < count($categoryIds); $i++) {
        $borderDetail = new BorderDetail();
        $borderDetail->border_transaction_id = $borderTransaction->id;
        $borderDetail->category_id = $categoryIds[$i];
        $borderDetail->product_id = $productIds[$i];
        $borderDetail->quantity = $quantities[$i];
        $borderDetail->save();

  
    }

    $borderTransaction->borderStocks()->delete(); // Remove existing stocks and re-add

    for ($i = 0; $i < count($categoryIds); $i++) {
        $borderStock = new BorderStock();
        $borderStock->border_transaction_id = $borderTransaction->id;
        $borderStock->border_warehouse_id = $borderTransaction->border_warehouse_id;
        $borderStock->date = $borderTransaction->date;
        $borderStock->category_id = $categoryIds[$i];
        $borderStock->product_id = $productIds[$i];
        $borderStock->quantity = $quantities[$i];
        $borderStock->save();
    }

    // $borderTransaction->borderStocks()->delete(); // Remove existing stocks and re-add

    // for ($i = 0; $i < count($categoryIds); $i++) {
    //     $borderStock = new BorderStock();
    //     $borderStock->border_warehouse_id = $borderTransaction->border_warehouse_id;
    //     $borderStock->date = $borderTransaction->date;
    //     $borderStock->category_id = $categoryIds[$i];
    //     $borderStock->product_id = $productIds[$i];
    //     $borderStock->quantity = $quantities[$i];
    //     $borderStock->save();
    // }

    // Redirect to the index or show page
    return redirect()->route('border.detail.show')->with('success', 'Form Updated');
}
    //end

    public function border_transaction_show()
    {
        $border_transaction=BorderTransaction::all();

        return view('new_backend.settings.border_transaction.border_transaction',compact('border_transaction'));
    }

    public function border_transaction_destroy(BorderTransaction $bordertransaction)
    {
        // dd($category);
        $bordertransaction->delete();
    
        return redirect()->route('border.transaction.show')
                        ->with('success','border Transaction deleted successfully');
    }

    // detail

    public function border_detail_show()
    {
        $border_detail=BorderDetail::orderBy('created_at', 'desc')->get();

        return view('new_backend.settings.border_transaction.border_detail',compact('border_detail'));
    }

    // border detail

    public function border_detail_edit($id)
    {
        $border_edit=BorderDetail::where('border_transaction_id',$id)->get();
        
        // dd($border_edit);
        $border=Border::all();
        $products=Product::all();
        $categories=Category::all();
        $border_warehouse=BorderWarehouse::all();
        return view('new_backend.settings.border_transaction.border_detail_edit',compact('border_edit','border','products','categories','border_warehouse'));
    }

    // public function border_transaction_update(Request $request, $id)
    // {
    //     $data=BorderTransaction::find($id);

    // $data->invoice_no=$request->invoice_no;
    // $data->border_warehouse_id=$request->border_warehouse_id;
    // $data->date=$request->date;
    // // $data->room=$request->room;
    // $image=$request->file;
    // if($image)
    // {
    //     $imagename=time(). '.' .$image->getClientoriginalExtension();
    //     $request->file->move('border_transaction',$imagename);
    //     $data->image=$imagename;
    // }

    // $result=$data->save();

    // // dd($result);
    // if($result){
    //     return redirect()->route('border.transaction.show')->with('success', 'Form Updated');


    // }
    // else{
    //     return redirect()->route('border.transaction.show')->with('error', 'Updated Error');

    // }
    // }

    public function border_detail_destroy(BorderDetail $borderdetail)
    {
        // dd($category);
        $borderdetail->delete();
    
        return redirect()->route('border.detail.show')
                        ->with('success','border detail deleted successfully');
    }

   

    //border stock

    public function border_stock_show()
    {
        // $border_stock=BorderStock::select('*',DB::raw('SUM(quantity) as total_quantity'))->groupBy('border_warehouse_id','product_id','category_id')->get();
        $border_stock=BorderStock::select('*',DB::raw('SUM(quantity) as total_quantity'))->groupBy('category_id','product_id','border_warehouse_id')->orderBy('created_at', 'desc')->get();
// dd($border_stock);
        return view('new_backend.settings.border_transaction.border_stock',compact('border_stock'));
    }

    public function border_stock_destroy(BorderStock $borderstock)
    {
        // dd($category);
        $borderstock->delete();
    
        return redirect()->route('border.stock.show')
                        ->with('success','border stock deleted successfully');
    }

// bordr warehouse
    public function border_warehouse()
    {
        return view('new_backend.settings.border-warehouse-create');
    }

    public function border_warehouse_store(Request $request)
    {
        $store=new BorderWarehouse();
        $store->name=$request->name;
        // $store->location=$request->location;

        $store->save();
        
        return redirect()->route('border.warehouse.show')->with('success','border warehouse successfully Added');
    }

    public function border_warehouse_show()
    {
        $border_warehouse=BorderWarehouse::all();
        return view('new_backend.settings.border-warehouse-index',compact('border_warehouse'));
    }

    public function border_warehouse_destroy(BorderWarehouse $borderwarehouse)
    {
        // dd($category);
        $borderwarehouse->delete();
    
        return redirect()->route('border.warehouse.show')
                        ->with('success','border warehouse deleted successfully');
    }


    public function getProductsByCategory(Request $request)
    {
        $categoryId = $request->input('category_id');
        $borderDetails = BorderDetail::where('category_id', $categoryId)->get();
    
        $products = [];
    
        foreach ($borderDetails as $borderDetail) {
            $products[] = [
                'product_id' => $borderDetail->product_id,
            ];
        }
    
        return response()->json(['products' => $products]);
    }


    /// combine

 


    
    

    

}
