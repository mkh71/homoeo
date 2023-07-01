<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use Illuminate\Http\Request;

class ComplainController extends Controller
{
    public function index()
    {
        $data = Complain::query()->latest()->get();
        return view('complains.index',compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request ,['name'=>'required|unique:powers']);
        Power::query()->create(['name'=>$request->name]);
        $powers = Power::query()->latest()->limit(12)->get();
        return redirect(route('power.index'))->with('success', 'Power has been deleted successfully');
    }
    public function show(power $power)
    {
        //
    }

    public function edit($id)
    {
        $powers = Power::query()->latest()->limit(12)->get();
        $power = Power::query()->find($id);
        return view('power.power',compact('power','id','powers'));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request ,['name'=>'required']);
        Power::query()->where('id',$id)->update(['name'=>$request->name]);
        $powers = Power::query()->latest()->limit(12)->get();
        return redirect(route('power.index'))->with('success', 'Power has been deleted successfully');
    }

    public function delete($id){
        $data = Power::query()->find($id);
        $data->delete();
        return redirect(route('power.index'))->with('success', 'Power has been deleted successfully');
    }
}
