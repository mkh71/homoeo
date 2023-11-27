<?php

namespace App\Http\Controllers;

use App\Models\CompanyInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('companies.invoice');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['total_dues'] = $request->total_amount - $request->total_paid;
            CompanyInvoice::query()->create($request->all());
            DB::commit();
            return redirect()->back()->with('success','Company Invoice Create Successfully');
        }catch (\Throwable $e){
            DB::rollBack();
            dd(
                $e->getCode(),
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyInvoice  $companyInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyInvoice $companyInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyInvoice  $companyInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = CompanyInvoice::query()->findOrFail($id);
        return view('companies.invoice',compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyInvoice  $companyInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyInvoice $companyInvoice)
    {

        $request->validate([
            'company_id' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['total_dues'] = $request->total_amount - $request->total_paid;
            $companyInvoice->update($data);
            DB::commit();
            return redirect()->route('companyInvoice.index')->with('success','Company Invoice Update Successfully');
        }catch (\Throwable $e){
            DB::rollBack();
            dd(
                $e->getCode(),
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyInvoice  $companyInvoice
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
        $invoice = CompanyInvoice::query()->findOrFail($id);
        $invoice->delete();
        return redirect()->back()->with('success ','Company Invoice Delete Successfully');

    }
    public function destroy(CompanyInvoice $companyInvoice)
    {
        //
    }
}
