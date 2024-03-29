<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use App\Models\Disease;
use App\Models\Dose;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\PatientPayment;
use App\Models\Power;
use App\Models\PurposeMedicine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class PatientController extends Controller
{
    public function index()
    {
        $patient = Patient::query()->latest()->limit(12)->get();
        $totalPatient = Patient::query()->get()->count();
        $todayPatient = Patient::query()->where('created_at', '>=', date('Y-m-d 00:00:00').'%')->count();
        $totalDues = Patient::query()->get()->sum('dues');
        $diseases = Disease::all();
        return view('welcome',compact('patient','totalPatient','todayPatient','totalDues', 'diseases'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $total = $request->total;
        $paid = $request->paid;
        $dues = $request->total - ($request->paid + $request->discount ?? 0);
        $discount = $request->discount ?? 0;
        try {
            DB::beginTransaction();
            $com = str_replace(['[',']', '"'],'', json_encode($request->last_complain));
            $pat = Patient::query()->create([
                'serial' => $request->serial,
                'name' => $request->name,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'age' => $request->age,
                'total' => $total,
                'paid' => $paid,
                'discount' => $discount,
                'dues' => $dues,
                'last_complain' => $com,
                'date' => $request->date,
            ]);
            $complain = Complain::query()->create(
                [
                    'details' => $com,
                    'patient_id' => $pat->id,
                    'total' => $total,
                    'paid' => $paid,
                    'discount' => $discount,
                    'dues' => $dues,
                ]);

            foreach ($request->medicine as $key => $item) {
                PurposeMedicine::query()->create([
                    'user_id' => $pat->id,
                    'serial' => $pat->serial,
                    'complain_id' => $complain->id,
                    'medicine_id' => $item,
                    'power_id' => $request->power[$key],
                    'dose_id' => $request->dose[$key],
                    'qty' => $request->qty[$key],
//                    'pack_size' => $request->pack_size[$key]
                ]);
                $med = Medicine::query()->findOrFail($item);
                $med->update(['qty'=>$med->qty - $request->qty[$key]]);

            }
            $pay = PatientPayment::query()
                ->create(
                    [
                        'serial' =>$request->serial,
                        'complain_id' =>$complain->id,
                        'patient_id'=>$pat->id,
                        'total' => $total,
                        'paid' => $paid,
                        'discount' => $discount,
                        'dues' => $dues,
                    ]);

            DB::commit();
            return redirect()->back()->with('success', 'Patient has been created successfully');
        }catch ( \Throwable $e){
            DB::rollBack();
            dd($e->getFile(),$e->getMessage());
            return redirect()->back()->with('error', 'Patient Create fail');
        }

    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $patient = Patient::query()->latest()->limit(12)->get();
        $data = Patient::query()->with(['complains','perpose'])->find($id);
        $data->medicine = PurposeMedicine::query()
            ->whereDate('created_at', Carbon::today())
            ->where('user_id',$data->id)
            ->get()
            ->map(function ($data){
                $data->price = @$data->medicine->mrp_price;
                return $data;
            });
//        $complain = Complain::query()->where('patient_id',$id);
        $complain = Complain::query()
            ->where('patient_id',$id)
            ->with('medicines')
            ->orderByDesc('created_at')
            ->latest()
            ->first();

//        $data->previus = PurposeMedicine::query()
//            ->where('user_id',$data->id)
//            ->get()
//            ->map(function ($data){
//                $data->price = @$data->medicine->mrp_price;
//                return $data;
//            });
        $totalPatient = Patient::query()->get()->count();
        $todayPatient = Patient::query()->where('created_at', '>=', date('Y-m-d 00:00:00').'%')->count();
        $totalDues = Patient::query()->get()->sum('dues');
        $doses = Dose::get();
        $powers = Power::get();
        $medicines = Medicine::get();
        $diseases = Disease::all();
        return view('patient.edit',compact('patient','complain','totalPatient','todayPatient','totalDues','data','id','doses','powers','medicines', 'diseases'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $complain = Complain::query()->where('id',$id)->latest()->first();
            $pat = Patient::query()->find($complain->patient_id);
            $com = str_replace(['[',']', '"'],'', json_encode($request->last_complain));

            $discount = $request->discount + $pat->discount;

            $total = $request->prevTotal + $request->new;
            $paid = $request->prevPaid + $request->paid;
            $duesTotal = $total - $paid;
            $dues = $duesTotal - $discount;


            $pat->update([
                'serial' => $request->serial,
                'name' => $request->name,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'age' => $request->age,
                'total' => $total,
                'paid' => $paid,
                'discount' => $discount,
                'dues' => $dues,
                'last_complain' => $com,
                'date' => $request->date,
            ]);
            $complain = Complain::query()->where('id',$id)->latest()->first();
            $comp = $complain->update([
                'details'    => $com,
                'total' => $total,
                'paid' => $paid,
                'discount' => $discount,
                'dues' => $dues,
            ]);

            $pay =  PatientPayment::query()->create([
                'patient_id'=>$pat->id,
                'complain_id'=>$complain->id,
                'total' => $request->new,
                'paid' => $request->paid,
                'discount' => $request->discount ?? 0,
                'dues' => $request->new - $request->paid,
                'serial' => $pat->serial,
            ]);
            foreach ($request->medicine as $key => $item) {
                $check = PurposeMedicine::query()->where('complain_id',$id)->where('medicine_id',$item)->latest()->first();
                $checkQty = $check->qty ?? 0;
                $qty = $request->qty[$key] - $checkQty;
                if ($check == null){
                    PurposeMedicine::query()->create([
                        'serial'        => $request->serial,
                        'user_id'       => $pat->id,
                        'complain_id'   => $complain->id,
                        'medicine_id'   => $item,
                        'power_id'      => $request->power[$key],
                        'dose_id'       => $request->dose[$key],
                        'qty'           => $request->qty[$key],
                    ]);
                }else{

                    $check->update([
                        'serial'        => $request->serial,
                        'user_id'       => $pat->id,
                        'complain_id'   => $complain->id,
                        'medicine_id'   => $item,
                        'power_id'      => $request->power[$key],
                        'dose_id'       => $request->dose[$key],
                        'qty'           => $request->qty[$key],
                    ]);
                }

                $med = Medicine::query()->findOrFail($item);
                $med->update(['qty'=>$med->qty - $qty]);
            }

            DB::commit();
            return redirect(route('home'))->with('success', 'Data Updated');

        }catch (\Throwable $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Patient Medicine Update Error');

        }

    }

    public function destroy($id)
    {
        // Logic to delete the patient record
        Patient::destroy($id);
        session()->flash('success', 'Patient has been Deleted successfully');
        return response()->json(['success' => true]);
    }


    public function delete($id)
    {
        // Logic to delete the patient record
        Patient::query()->findOrFail($id)->delete();
        session()->flash('success', 'Patient has been Deleted successfully');
        return response()->json(['success' => true]);
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
                    <td>'.Carbon::parse($pat->created_at)->format('d M y').'</td>
                    <td>'.$pat->address.'</td>
                    <td data-id="'.$pat->id.'" class="complain">'.$pat->last_complain.'</td>
                    <td data-id="'.$pat->id.'" class="bg-primary-light">'.$pat->total.'</td>
                    <td data-id="'.$pat->id.'" class="bg-info-light">'.$pat->paid .'<small>('. $pat->discount.')</small></td>
                    <td data-id="'.$pat->id.'" class="bg-danger-light">'.$pat->dues.'</td>
                    <td class="text - end">
                        <div class="table - action">
                             <a href="'.route('patients.new',$pat->id).'"
                               class="btn btn-sm bg-primary" id="edit">
                                <i class="far feather-plus-circle">New</i>
                            </a>

                            <a href="'.route('patients.edit',$pat->id).'"
                               class="btn btn-sm bg-info" id="edit">
                                <i class="far feather-edit"> Edit</i>
                            </a>

                            <a onclick="deletePatient('.$pat->id .')"
                               class="btn btn-sm bg-danger text-white" id="edit">
                                <i class="far feather-trash"> Delete</i>
                            </a>
                        </div>
                    </td>
                </tr>
            ';
        }
        return $html;
    }

    public function complain(Request $request){
        try {
            DB::beginTransaction();
            $pat = Patient::query()->find($request->id);
            $com = str_replace(['[',']', '"'],'', json_encode($request->last_complain));
            $pat->update(
                [
                    'last_complain' => $com,
                    'total'         => $request->total,
                    'paid'          => $request->paid,
                    'discount'      => $request->discount ?? 0,
                    'dues'          => $request->total - ($request->paid + $request->discount ?? 0),
                    'date'          => $request->date,
                ]);
            $complain = Complain::query()->create([
                'patient_id' => $request->id,
                'details'    => $com,
            ]);
            $complain = Complain::query()->create(
                [
                    'details' => $com,
                    'patient_id' => $pat->id,
                ]);

            $pay = PatientPayment::query()
                ->create(
                    [
                        'patient_id'    => $pat->id,
                        'serial'        => $pat->serial,
                        'total'         => $request->total,
                        'paid'          => $request->paid,
                        'discount'      => $request->discount ?? 0,
                        'dues'          => $request->total - ($request->paid + $request->discount ?? 0),
                    ]);

            foreach ($request->medicine as $key => $item) {
                PurposeMedicine::query()->create([
                    'user_id'       => $pat->id,
                    'complain_id'   => $complain->id,
                    'medicine_id'   => $item,
                    'power_id'      => $request->power[$key],
                    'dose_id'       => $request->dose[$key],
                    'pack_size'     => $request->pack_size[$key],
                    'qty'           => $request->qty[$key],
                ]);
                $med = Medicine::query()->findOrFail($item);
                $med->update(['qty'=>$med->qty - $request->qty[$key]]);
            }

            DB::commit();
            return redirect()->back()->with('success', "Complain has been added successfully");
        }catch ( \Throwable $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Complain Create fail');
        }


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

        $payments = PatientPayment::query()
            ->where('patient_id',$id)
            ->orderByDesc('created_at')
            ->get();

       return view('patient-profile',compact('patient','complain','payments'));
    }

    public function dateSearch(Request $request){
        session()->put('search_date',$request->date);
        return redirect()->route('searchByDate');

    }

    public function duesList(){
        $patient        = Patient::query()->latest()->where('dues', '>', 0)->get();
        $totalPatient   = Patient::query()->get()->count();
        $todayPatient   = Patient::query()->where('created_at', '>=', date('Y-m-d 00:00:00').'%')->count();
        $totalDues      = Patient::query()->get()->sum('dues');
        $doses          = Dose::get();
        $powers         = Power::get();
        $medicines      = Medicine::get();
        $diseases       = Disease::all();
        return view('patient.dues-list',compact(
                'patient',
                'totalPatient',
                'todayPatient',
                'totalDues',
                'doses',
                'powers',
                'medicines',
                'diseases')
        );
    }

    public function dateToSearch(Request $request){

        $patient = Patient::where('created_at', '>', $request->from . ' 00:00:00')
            ->where('created_at', '<', $request->to . ' 23:59:59')
            ->get();
        $payment = PatientPayment::where('created_at', '>', $request->from . ' 00:00:00')
            ->where('created_at', '<', $request->to . ' 23:59:59')
            ->get();
        $totalPatient   = $patient->count();
        $totalBill      = $payment->sum('total');
        $totalPayment   = $payment->sum('paid');
        $totalDues      = $totalBill - $totalPayment;
        $doses          = Dose::get();
        $powers         = Power::get();
        $medicines      = Medicine::get();
        $diseases       = Disease::all();
        $to = $request->to;
        $from = $request->from;
        return view('patient.date-to-search',compact(
                'patient',
                'totalPatient',
                'totalBill',
                'totalPayment',
                'totalDues',
                'doses',
                'powers',
                'medicines',
                'from',
                'to',
                'diseases')
        );
    }
    public function date(){
        $date           = session()->get('search_date');
        $patients       = Patient::query()->where('created_at','like',$date.'%')->get();
        $totalPatient   = Patient::query()->where('created_at','like',$date.'%')->get()->count();
        $todayPatient   = Patient::query()->where('created_at','like',$date.'%')->count();
        $totalDues      = Patient::query()->where('created_at','like',$date.'%')->get()->sum('dues');
        $totalSale      = Patient::query()->where('created_at','like',$date.'%')->get();
        $diseases       = Disease::all();
        return view('patient.search-date',
            compact(
                'patients',
                'totalPatient',
                'todayPatient',
                'totalDues',
                'diseases',
                'date',
                'totalSale'
            )
        );
    }

    public function appendPurRow(Request $request){
        if($request->name !=null){
            $meds = Disease::query()
                ->whereIn('name', $request->name)
                ->get()
                ->unique('name')
                ??
                null;
        }else{
            $meds = null;
        }
        $min  = 10000;
        $max  = 10300;
        $info = random_int($min, $max);
        $rows = view('patient.rowAppend',
            compact(
                'meds',
                'info')
        )->render();

        return response()->json(['rows'=>$rows]);
    }

    public function patientNewPur($id){
        $data['patient']  = Patient::query()->findOrFail($id);
        $data['diseases'] = Disease::all();
        return view('patient.newPurpose')->with($data);
    }
    public function newPurposeStore(Request $request,$patientId){
        $discount = $request->discount ?? 0;
        $temp = $request->paid + $discount;
        $dues = $request->total - $temp;
        $total = $request->total ?? 0;
        $paid = $request->paid ?? 0;
        $discount = $request->discount ?? 0;

        try {
            DB::beginTransaction();
            $pat = Patient::query()->find($patientId);
            $com = str_replace(['[',']', '"'],'', json_encode($request->last_complain));
            $pat->update(
                [
                    'serial'        =>  $request->serial,
                    'last_complain' =>  $com,
                    'total'         =>  $total,
                    'paid'          =>  $paid,
                    'discount'      =>  $discount,
                    'dues'          =>  $dues,
                    'date'          => $request->date,
                ]);
            $complain = Complain::query()->create([
                'patient_id'    => $patientId,
                'details'       => $com,
                'total'     =>  $request->today_bill ?? 0,
                'paid'      =>  $request->paid ?? 0,
                'discount'  =>  $discount,
                'dues'      =>  ($request->today_bill ?? 0) - ($request->paid ?? 0) - $discount,
            ]);

            $pay = PatientPayment::query()
                ->create(
                    [
                        'serial'    =>  $request->serial,
                        'complain_id'    =>  $complain->id,
                        'patient_id'=>  $pat->id,
                        'total'     =>  $request->today_bill ?? 0,
                        'paid'      =>  $request->paid ?? 0,
                        'discount'  =>  $discount,
                        'dues'      =>  ($request->today_bill ?? 0) - ($request->paid ?? 0) - ($discount ?? 0),
                    ]);

            if ($request->medicine !=null){
            foreach ($request->medicine as $key => $item) {
                PurposeMedicine::query()->create([
                    'serial'        => $request->serial,
                    'user_id'       => $pat->id,
                    'complain_id'   => $complain->id,
                    'medicine_id'   => $item,
                    'power_id'      => $request->power[$key],
                    'dose_id'       => $request->dose[$key],
                    'qty'           => $request->qty[$key],
                ]);
                $med = Medicine::query()->findOrFail($item);
                $med->update(['qty'=>$med->qty - $request->qty[$key]]);
            }
            }
            DB::commit();
            return redirect()->route('home')->with('success', "Complain has been added successfully");
        }catch ( \Throwable $e){
            DB::rollBack();
            dd(
                $e->getFile(),
                $e->getCode(),
                $e->getLine(),
                $e->getMessage(),
                $e->getPrevious(),
            );
            return redirect()->back()->with('error', 'Complain Create fail');
        }
    }
}
