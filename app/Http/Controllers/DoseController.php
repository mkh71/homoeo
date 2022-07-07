<?php

namespace App\Http\Controllers;

use App\Models\Dose;
use Illuminate\Http\Request;

class DoseController extends Controller
{
    public function index()
    {
        $doeses = Dose::query()->latest()->limit(12)->get();
        return view('dose.dose',compact('doeses'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request ,['name'=>'required|unique:doses']);
        Dose::query()->create(['name'=>$request->name]);
        return redirect(route('dose.index'))->with('success', 'Dose has been deleted successfully');
    }

    public function show(Dose $does)
    {
        //
    }

    public function edit($id)
    {
        $doeses = Dose::query()->latest()->limit(12)->get();
        $does = Dose::query()->find($id);
        return view('dose.dose',compact('does','id','doeses'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request ,['name'=>'required']);
        Dose::query()->where('id',$id)->update(['name'=>$request->name]);
        $doeses = Dose::query()->latest()->limit(12)->get();
        return redirect(route('dose.index'))->with('success', 'Dose has been deleted successfully');
    }

    public function delete($id)
    {
        $data = Dose::query()->find($id);
        $data->delete();
        return redirect(route('dose.index'))->with('success', 'Dose has been deleted successfully');
    }
}
