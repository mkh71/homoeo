<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Medicine;
use App\Models\PeackSize;
use App\Models\Power;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicines = Medicine::query()
            ->with(['peckSize'])
            ->latest()
            ->get()
            ->map(function ($data){
                $data->peck_size = PeackSize::query()->where('id',$data->pack_size)->first()->name ?? '';
                return $data;
            });
        $diseases = Disease::query()->latest()->get();
        $powers = Power::get();
        return view('medicine.medicine',compact('medicines', 'diseases','powers'));
    }


    public function store(Request $request)
    {
        $this->validate($request ,['name'=>'required | unique:medicines']);
        try {
            DB::beginTransaction();
            $med = medicine::query()->create(
                [
                    'name'=>$request->name,
                    'description'=>$request->description,
                    'power_id'=>$request->power_id,
                    'qty'=>$request->qty,
                    'pack_size'=>$request->pack_size,
                    'net_price'=>$request->net_price,
                    'mrp_price'=>$request->mrp_price,
                    'company_id'=>$request->company_id,
                    'group'=>$request->group,
                    'expired_date'=>$request->expired_date
                ]);
            $med->diseases()->attach($request->diseases);
            DB::commit();
            return redirect(route('medicine.index'))->with('success', 'medicine has been deleted successfully');
        }catch (\Throwable $e){
            DB::rollBack();
            dd(
                $e->getCode(),
                $e->getFile(),
                $e->getMessage(),
                $e->getLine(),
            );
        }
    }

    public function show($medicine)
    {

    }
    public function edit($id)
    {
        $medicines = medicine::query()->with(['power','company'])->latest()->get();
        $medicine = medicine::query()->find($id);
        $diseases = Disease::query()->latest()->get();
        $powers = Power::get();
        return view('medicine.medicine',compact('medicine','id', 'medicines', 'diseases','powers'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request ,[
            'name'=>'required | unique:medicines,name,' . $id
        ]);
        try {
            DB::beginTransaction();
            $med = medicine::query()->find($id);
            $med->update([
                'name'=>$request->name,
                'description'=>$request->description,
                'power_id'=>$request->power_id,
                'qty'=>$request->qty + $med->qty,
                'pack_size'=>$request->pack_size,
                'net_price'=>$request->net_price,
                'mrp_price'=>$request->mrp_price,
                'company_id'=>$request->company_id,
                'group'=>$request->group,
                'expired_date'=>$request->expired_date
            ]);
            $med->diseases()->sync($request->diseases);

            DB::commit();
            return redirect(route('medicine.index'))->with('success', 'medicine has been deleted successfully');

        }catch (\Throwable $e){
            DB::rollBack();
            dd(
                $e->getCode(),
                $e->getFile(),
                $e->getMessage(),
                $e->getLine(),
            );
        }

    }

    public function lowStock(){
        return view('medicine.low-stock');
    }

    public function expiredMedicine(){
        return view('medicine.expired-medicine');
    }

    public function destroy(medicine $medicine)
    {
        // Logic to delete the patient record
        $medicine->delete();
        session()->flash('success', 'Medicine has been Deleted successfully');
        return response()->json(['success' => true]);
    }

    public function delete($id)
    {
        // Logic to delete the patient record
        $data = medicine::query()->find($id);
        $data->diseases()->detach();
        $data->delete();
        session()->flash('success', 'Medicine has been Deleted successfully');
        return response()->json(['success' => true]);
    }
//    public function delete($id){
//        $data = medicine::query()->find($id);
//        $data->diseases()->detach();
//        $data->delete();
//        return redirect(route('medicine.index'))->with('success', 'Medicine has been deleted successfully');
//    }

    public function search(Request $request)
    {
        $word = $request->word;
        $data = Medicine::query()
            ->where('name', 'like', '%'.$request->word . '%')
            ->orWhere('group', 'like', '%'.$request->word . '%')
            ->get();
        if (count($data) ==0){
            echo '<tr colspan="5" class="text-danger text-center">No Data Found</tr>';
        }
        $html = '';
        foreach ($data as $medi) {
            $diseases = '';
            foreach ($medi->diseases as $com) {
                $diseases .= $com->name.',';
            }
            $html .=  '
               <tr>
                    <td>'.$medi->id.'</td>
                    <td>'.$medi->name.'</td>
                    <td>'.@$medi->power->name.'</td>
                    <td class="bg-warning-light">'.@$medi->qty.'</td>
                    <td class="bg-success-light">'.$medi->net_price.'</td>
                    <td class="bg-info-light">'.$medi->mrp_price.'</td>
                    <td class="bg-primary-light-light">'.$medi->net_price * $medi->qty.'</td>
                    <td>'.@$medi->company->name.'</td>
                    <td>'.$medi->group.'</td>
                    <td>'. $diseases.'</td>
                    <td>'.
                        substr(strip_tags($medi->description), 0, 50)
                                .'</td>
                    <td>'.$medi->expired_date.'</td>
                    <td class="text-end">
                        <div class="table-action">
                                <a href="'.route('medicine.edit',$medi->id).'"
                                   class="btn btn-sm bg-info-light" id="edit">
                                    <i class="far fa-pencil">Edit</i>
                                </a>
                                <a href="'.route('medicine-delete',$medi->id).'"
                                   class="btn btn-sm bg-danger-light" id="delete">
                                    <i class="far fa-pencil">Delete</i>
                                </a>
                        </div>
                    </td>
                </tr>';
        }
        return $html;
    }
}
