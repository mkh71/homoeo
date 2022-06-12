<?php

namespace App\Http\Controllers;

use App\Models\power;
use Illuminate\Http\Request;

class PowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $powers = Power::query()->latest()->limit(12)->get();
       return view('power.power',compact('powers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request ,['name'=>'required']);
        Power::query()->create(['name'=>$request->name]);
        $powers = Power::query()->latest()->limit(12)->get();
        return redirect(route('power.index'))->with('success', 'Power has been deleted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\power  $power
     * @return \Illuminate\Http\Response
     */
    public function show(power $power)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\power  $power
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $powers = Power::query()->latest()->limit(12)->get();
        $power = Power::query()->find($id);
        return view('power.power',compact('power','id','powers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\power  $power
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request ,['name'=>'required']);
        Power::query()->where('id',$id)->update(['name'=>$request->name]);
        $powers = Power::query()->latest()->limit(12)->get();
        return redirect(route('power.index'))->with('success', 'Power has been deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\power  $power
     * @return \Illuminate\Http\Response
     */
//    public function destroy(power $power)
//    {
//        return 'hlw';
//    }
    public function delete($id){
        $data = Power::query()->find($id);
        $data->delete();
        return redirect(route('power.index'))->with('success', 'Power has been deleted successfully');
    }
}
