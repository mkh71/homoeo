<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use App\Models\Dose;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Power;
use App\Models\PurposeMedicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index()
    {
        $patient = Patient::query()->latest()->limit(12)->get();
        $totalPatient = Patient::query()->get()->count();
        $todayPatient = Patient::query()->where('created_at', '>=', date('Y-m-d 00:00:00').'%')->count();
        $totalDues = Patient::query()->get()->sum('dues');
        return view('welcome',compact('patient','totalPatient','todayPatient','totalDues'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $com = str_replace(['[',']', '"'],'', json_encode($request->last_complain));
        $pat = Patient::query()->create([
            'serial' => $request->serial,
            'name' => $request->name,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'age' => $request->age,
            'dues' => $request->dues,
            'last_complain' => $com,
        ]);
        $complain = Complain::query()->create(['details' => $com, 'patient_id' => $pat->id]);
        foreach ($request->medicine as $key => $item) {
            PurposeMedicine::query()->create([
                'user_id' => $pat->id,
                'complain_id' => $complain->id,
                'medicine_id' => $item,
                'power_id' => $request->power[$key],
                'dose_id' => $request->dose[$key],
            ]);
        }
        return redirect()->back()->with('success', 'Patient has been created successfully');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $patient = Patient::query()->latest()->limit(12)->get();
        $data = Patient::query()->find($id);
        $totalPatient = Patient::query()->get()->count();
        $todayPatient = Patient::query()->where('created_at', '>=', date('Y-m-d 00:00:00').'%')->count();
        $totalDues = Patient::query()->get()->sum('dues');
        $doses = Dose::get();
        $powers = Power::get();
        $medicines = Medicine::get();
        return view('welcome',compact('patient','totalPatient','todayPatient','totalDues','data','id','doses','powers','medicines'));
    }

    public function update(Request $request, $id)
    {
        $pat = Patient::query()->find($id);
        $com = str_replace(['[',']', '"'],'', json_encode($request->last_complain));
        $pat->update([
            'serial' => $request->serial,
            'name' => $request->name,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'age' => $request->age,
            'dues' => $request->dues,
            'last_complain' => $com,
        ]);
        return redirect(route('home'))->with('success', 'Data Updated');
    }

    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $data = Patient::query()
            ->where('serial', 'like', $request->word . '%')
            ->orWhere('name', 'like', $request->word . '%')
            ->orWhere('mobile', 'like', $request->word . '%')
            ->get();
        if (count($data) ==0){
            echo '<tr colspan="5" class="text-danger text-center">No Data Found</tr>';
        }
        $html = '';
        foreach ($data as $pat) {
            $html .=  '
            <tr>
                    <td >'.$pat->serial.'</td>
                    <td>
                        <h2 class="table - avatar">
                            <a href="'.route('patients.profile', $pat->id).'">'.$pat->name.'</a>
                        </h2>
                    </td>
                    <td >'.$pat->age.' Yr.</td>
                    <td>'.$pat->mobile.'</td>
                    <td>'.$pat->address.'</td>
                    <td data-id="'.$pat->id.'" class="complain">'.$pat->last_complain.'</td>
                    <td data-id="'.$pat->id.'" class="dues">'.$pat->dues.'</td>
                    <td class="text - end">
                        <div class="table - action">
                            <a href="'.route('patients.edit', $pat->id).'" class="btn btn - sm bg - info - light" id="edit">
                                <i class="far fa - pencil">Edit</i>
                            </a>
                        </div>
                    </td>
                </tr>
            ';
        }
        return $html;
    }

    public function complain(Request $request){
        $pat = Patient::query()->find($request->id);
        $com = str_replace(['[',']', '"'],'', json_encode($request->last_complain));
        $pat->update(['last_complain'=>$com]);
        $complain = Complain::query()->create([
            'patient_id' => $request->id,
            'details' => $com,
        ]);

        foreach ($request->medicine as $key => $item) {
            PurposeMedicine::query()->create([
                'user_id' => $pat->id,
                'complain_id' => $complain->id,
                'medicine_id' => $item,
                'power_id' => $request->power[$key],
                'dose_id' => $request->dose[$key],
            ]);
        }

        return redirect()->back()->with('success', "Complain has been added successfully");
    }

    public function profile($id){
        $patient = Patient::query()
            ->where('id',$id)
            ->first();
        $complain = Complain::query()
            ->where('patient_id',$id)
            ->with('medicines')
            ->orderByDesc('created_at')
            ->get();

       return view('patient-profile',compact('patient','complain'));
    }

}
