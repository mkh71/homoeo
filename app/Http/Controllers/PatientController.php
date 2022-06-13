<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use App\Models\Patient;
use Illuminate\Http\Request;

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
        $pat = Patient::query()->create($request->all());

        Complain::query()->create(['details' => $request->last_complain, 'patient_id' => $pat->id]);
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
        return view('welcome',compact('patient','totalPatient','todayPatient','totalDues','data','id'));
    }

    public function update(Request $request, $id)
    {
        $pat = Patient::query()->find($id);
        $complain = Complain::query()->where('details',$pat->last_complain)->latest()->first();
        $pat->update($request->all());
        $complain->update(['details'=>$request->last_complain]);
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
                    <td>'.$pat->serial.'</td>
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
        $pat->update(['last_complain'=>$request->last_complain]);

        Complain::query()->create([
            'patient_id' => $request->id,
            'details' => $request->last_complain,
        ]);
        return redirect()->back()->with('success', "Complain has been added successfully");
    }
    public function profile($id){
        $patient = Patient::query()->where('id',$id)->first();
        $complain = Complain::query()->where('patient_id',$id)->with('patient')->get();
        return view('patient-profile',compact('patient','complain'));
    }

}
