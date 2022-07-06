<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicines = Medicine::query()->latest()->limit(12)->get();
        return view('medicine.medicine',compact('medicines'));
    }

    public function store(Request $request)
    {
        $this->validate($request ,['name'=>'required | unique:medicines']);
        medicine::query()->create(['name'=>$request->name]);
        $medicines = medicine::query()->latest()->limit(12)->get();
        return redirect(route('medicine.index'))->with('success', 'medicine has been deleted successfully');
    }

    public function show(medicine $medicine)
    {
        //
    }
    public function edit(medicine $id)
    {
        $medicines = medicine::query()->latest()->limit(12)->get();
        $medicine = medicine::query()->find($id);
        return view('medicine.medicine',compact('medicine','id','medicines'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request ,['name'=>'required']);
        medicine::query()->where('id',$id)->update(['name'=>$request->name]);
        $medicines = medicine::query()->latest()->limit(12)->get();
        return redirect(route('medicine.index'))->with('success', 'medicine has been deleted successfully');
    }

    public function destroy(medicine $medicine)
    {
        //
    }
    public function delete($id){
        $data = medicine::query()->find($id);
        $data->delete();
        return redirect(route('medicine.index'))->with('success', 'Medicine has been deleted successfully');
    }
}
