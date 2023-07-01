<?php

namespace App\Http\Controllers;

use App\Models\Disease;
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
        $medicines = Medicine::query()->latest()->get();
        $diseases = Disease::query()->latest()->get();
        return view('medicine.medicine',compact('medicines', 'diseases'));
    }

    public function store(Request $request)
    {
        $this->validate($request ,['name'=>'required | unique:medicines']);
        $med = medicine::query()->create(['name'=>$request->name, 'description'=>$request->description]);
        $med->diseases()->attach($request->diseases);
        return redirect(route('medicine.index'))->with('success', 'medicine has been deleted successfully');
    }

    public function show($medicine)
    {

    }
    public function edit($id)
    {
        $medicines = medicine::query()->latest()->get();
        $medicine = medicine::query()->find($id);
        $diseases = Disease::query()->latest()->get();
        return view('medicine.medicine',compact('medicine','id', 'medicines', 'diseases'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request ,[
            'name'=>'required | unique:medicines,name,' . $id
        ]);
        $med = medicine::query()->find($id);
        $med->update(['name'=>$request->name, 'description'=>$request->description]);
        $med->diseases()->sync($request->diseases);
        return redirect(route('medicine.index'))->with('success', 'medicine has been deleted successfully');
    }

    public function destroy(medicine $medicine)
    {
        //
    }
    public function delete($id){
        $data = medicine::query()->find($id);
        $data->diseases()->detach();
        $data->delete();
        return redirect(route('medicine.index'))->with('success', 'Medicine has been deleted successfully');
    }
}
