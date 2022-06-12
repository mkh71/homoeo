<?php

namespace App\Http\Controllers;

use App\Models\Madicine;
use Illuminate\Http\Request;

class MadicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $madicines = Madicine::query()->latest()->limit(12)->get();
        return view('madicine.madicine',compact('madicines'));
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
        Madicine::query()->create(['name'=>$request->name]);
        $madicines = Madicine::query()->latest()->limit(12)->get();
        return redirect(route('madicine.index'))->with('success', 'Madicine has been deleted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Madicine  $madicine
     * @return \Illuminate\Http\Response
     */
    public function show(Madicine $madicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Madicine  $madicine
     * @return \Illuminate\Http\Response
     */
    public function edit(Madicine $id)
    {
        $madicines = Madicine::query()->latest()->limit(12)->get();
        $madicine = Madicine::query()->find($id);
        return view('madicine.madicine',compact('madicine','id','madicines'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Madicine  $madicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request ,['name'=>'required']);
        Madicine::query()->where('id',$id)->update(['name'=>$request->name]);
        $madicines = Madicine::query()->latest()->limit(12)->get();
        return redirect(route('madicine.index'))->with('success', 'Madicine has been deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Madicine  $madicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Madicine $madicine)
    {
        //
    }
    public function delete($id){
        $data = Madicine::query()->find($id);
        $data->delete();
        return redirect(route('madicine.index'))->with('success', 'Madicine has been deleted successfully');
    }
}
