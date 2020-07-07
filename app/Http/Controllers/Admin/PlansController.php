<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\PlanAttribute;

class PlansController extends Controller
{
    public function __construct() {
        $this->section = "plans";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $plans = Plan::all();
        return view('admin.plans.index')
                ->with([
                    'section' => $this->section,
                    'plans' => $plans,
                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.plans.create')
                ->with([
                    'section' => $this->section,
                ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'plan_attributes' => 'required'
        ];
        $request->validate($rules);
        $attributes = explode("\r\n", $request->plan_attributes);
        $plan = Plan::create($request->except(['plan_attributes']));
        foreach ($attributes as $key => $attribute) {
            PlanAttribute::create([
                'plan_id' => $plan->id,
                'attribute' => $attribute,
            ]);
        }
        return redirect()->route('plans.show', $plan->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $plan = Plan::findOrFail($id);
        return view('admin.plans.show')
                ->with([
                    'plan' => $plan,
                    'section' => $this->section,
                ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
        $plan = Plan::findOrFail($id);
        $rules = [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'plan_attributes' => 'required'
        ];
        $request->validate($rules);
        $attributes = explode("\r\n", $request->plan_attributes);
        $plan->update($request->except(['plan_attributes']));
        $plan->attributes()->delete();
        foreach ($attributes as $key => $attribute) {
            PlanAttribute::create([
                'plan_id' => $plan->id,
                'attribute' => $attribute,
            ]);
        }
        return redirect()->route('plans.show', $plan->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $plan = Plan::findOrFail($id);
        $plan->delete();
        return redirect()->route('plans.index');
    }
}
