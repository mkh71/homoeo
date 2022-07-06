<?php

namespace App\Http\Controllers;

use App\Models\Dose;
use Illuminate\Http\Request;

class DoseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doeses = Dose::query()->latest()->limit(12)->get();
        return view('dose.dose',compact('doeses'));
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
        $this->validate($request ,['name'=>'required|unique:doses']);
        Dose::query()->create(['name'=>$request->name]);
        $doeses = Dose::query()->latest()->limit(12)->get();
        return redirect(route('dose.index'))->with('success', 'Dose has been deleted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dose  $does
     * @return \Illuminate\Http\Response
     */
    public function show(Dose $does)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dose  $does
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doeses = Dose::query()->latest()->limit(12)->get();
        $does = Dose::query()->find($id);
        return view('dose.dose',compact('does','id','doeses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dose  $does
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request ,['name'=>'required']);
        Dose::query()->where('id',$id)->update(['name'=>$request->name]);
        $doeses = Dose::query()->latest()->limit(12)->get();
        return redirect(route('dose.index'))->with('success', 'Dose has been deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dose  $does
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = Dose::query()->find($id);
        $data->delete();
        return redirect(route('dose.index'))->with('success', 'Dose has been deleted successfully');
    }
}
