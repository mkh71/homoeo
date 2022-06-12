<?php

namespace App\Http\Controllers;

use App\Models\Does;
use Illuminate\Http\Request;

class DoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doeses = Does::query()->latest()->limit(12)->get();
        return view('does.does',compact('doeses'));
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
        Does::query()->create(['name'=>$request->name]);
        $doeses = Does::query()->latest()->limit(12)->get();
        return redirect(route('does.index'))->with('success', 'Does has been deleted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Does  $does
     * @return \Illuminate\Http\Response
     */
    public function show(Does $does)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Does  $does
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doeses = Does::query()->latest()->limit(12)->get();
        $does = Does::query()->find($id);
        return view('does.does',compact('does','id','doeses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Does  $does
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request ,['name'=>'required']);
        Does::query()->where('id',$id)->update(['name'=>$request->name]);
        $doeses = Does::query()->latest()->limit(12)->get();
        return redirect(route('does.index'))->with('success', 'Does has been deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Does  $does
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = Does::query()->find($id);
        $data->delete();
        return redirect(route('does.index'))->with('success', 'Does has been deleted successfully');
    }
}
