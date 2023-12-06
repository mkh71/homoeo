<?php

namespace App\Http\Controllers;

use App\Models\PeackSize;
use Illuminate\Http\Request;

class PeackSizeController extends Controller
{
    public function index(){
        return view('peck-size.index');
    }

    public function store(Request $request){
        $this->validate($request ,['name'=>'required|unique:doses']);
        PeackSize::query()->create(['name'=>$request->name]);
        return redirect(route('peack_sizes.index'))->with('success', 'Peck Size has been Store successfully');
    }

    public function edit(PeackSize $peackSize){
        return view('peck-size.index',compact('peackSize'));
    }

    public function update(Request $request, PeackSize $peackSize){
        $this->validate($request ,['name'=>'required']);
        $peackSize->update(['name'=>$request->name]);
        return redirect(route('peack_sizes.index'))->with('success', 'Peck Size has been Update successfully');
    }

    public function delete(PeackSize $peackSize){
        $peackSize->delete();
        return redirect(route('peack_sizes.index'))->with('success', 'Peck Size has been deleted successfully');
    }
}
