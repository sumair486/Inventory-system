<?php

namespace App\Http\Controllers;

use App\Models\Plans;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:plan-list|plan-create|plan-edit|plan-delete', ['only' => ['index','show']]);
         $this->middleware('permission:plan-create', ['only' => ['create','store']]);
         $this->middleware('permission:plan-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:plan-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plans::latest()->paginate(5);
        return view('backend.admin.plans.index',compact('plans'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.plans.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'level' => 'required',
            'charges' => 'required',
            'direct' => 'required',
            'indirect' => 'required',
            'bonus' => 'required',
            'features' => 'required',

        ]);
    
        Plans::create($request->all());
    
        return redirect()->route('plans.index')
                        ->with('success','Product created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Plans  $plans
     * @return \Illuminate\Http\Response
     */
    public function show(Plans $plan)
    {
        return view('backend.admin.plans.show',compact('plan'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plans  $plans
     * @return \Illuminate\Http\Response
     */
    public function edit(Plans $plan)
    {
        return view('backend.admin.plans.edit',compact('plan'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plans  $plans
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plans $plan)
    {
         request()->validate([
            'name' => 'required',
            'level' => 'required',
            'charges' => 'required',
            'direct' => 'required',
            'indirect' => 'required',
            'bonus' => 'required',
            'features' => 'required',
        ]);
    
        $plan->update($request->all());
    
        return redirect()->route('plans.index')
                        ->with('success','Product updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plans  $plans
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plans $plan)
    {
        $plan->delete();
    
        return redirect()->route('plans.index')
                        ->with('success','Product deleted successfully');
    }
}
