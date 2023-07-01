<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Medicine;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    public function index()
    {
        $data = Disease::query()->latest()->get();
        $medicines = Medicine::all();
        return view('complains.index',compact('data', 'medicines'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request ,['name'=>'required|unique:diseases']);
        $data = Disease::query()->create(['name'=>$request->name]);
        $data->medicines()->attach($request->medicines);
        return redirect(route('diseases.index'))->with('success', 'Complain has been stored successfully');
    }
    public function show(power $power)
    {
        //
    }

    public function edit($id)
    {
        $data = Disease::query()->latest()->get();
        $info = Disease::query()->find($id);
        $medicines = Medicine::all();
        return view('complains.index',compact('info','id','data', 'medicines'));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request ,['name'=>'required']);
        $data = Disease::query()->find($id);
        $data->update(['name'=>$request->name]);
        $data->medicines()->sync($request->medicines);
        return redirect(route('diseases.index'))->with('success', 'Data has been deleted successfully');
    }

    public function erase($id){
        $data = Disease::query()->find($id);
        $data->medicines()->detach();
        $data->delete();
        return redirect(route('power.index'))->with('success', 'Data has been deleted successfully');
    }
}
