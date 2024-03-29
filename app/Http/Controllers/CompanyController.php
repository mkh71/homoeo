<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyInvoice;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['companies'] = Company::query()
            ->get()
            ->map(function ($item){
                $item->total = CompanyInvoice::query()->where('company_id',$item->id)->get()->sum('total_amount');
                $item->paid = CompanyInvoice::query()->where('company_id',$item->id)->get()->sum('total_paid');
                $item->dues = CompanyInvoice::query()->where('company_id',$item->id)->get()->sum('total_dues');
                return $item;
            });
        return view('companies.companies')->with($data);
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
        $this->validate($request ,['name'=>'required | unique:companies']);
        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['total_dues'] = $request->total_amount - $request->total_paid;
            Company::query()->create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Company has been created successfully');

        }catch (\Throwable $e){
            DB::rollBack();
            dd(
                $e->getCode(),
                $e->getLine(),
                $e->getMessage(),
                $e->getFile(),
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $data['invoices']  = CompanyInvoice::query()
            ->where('id',$company->id)
            ->get();
        $data['company']  = $company;
        return view('companies.details')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $data['companies'] = Company::query()->get()
            ->map(function ($item){
                $item->total = CompanyInvoice::query()->where('company_id',$item->id)->get()->sum('total_amount');
                $item->paid = CompanyInvoice::query()->where('company_id',$item->id)->get()->sum('total_paid');
                $item->dues = CompanyInvoice::query()->where('company_id',$item->id)->get()->sum('total_dues');
                return $item;
            });
        $data['company'] = $company;
        return view('companies.companies')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $this->validate($request ,[
            'name'=>'required | unique:companies,name,' . $company->id
        ]);
        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['total_dues'] = $request->total_amount - $request->total_paid;
            $company->update($data);
            DB::commit();
            return redirect()->route('companies.index')->with('success', 'Company has been update successfully');

        }catch (\Throwable $e){
            DB::rollBack();
            dd(
                $e->getCode(),
                $e->getLine(),
                $e->getMessage(),
                $e->getFile(),
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Company::destroy($id);
        session()->flash('success', 'Patient has been Deleted successfully');
        return response()->json(['success' => true]);
    }

    public function delete($id)
    {
        Company::query()->findOrFail($id)->delete();
        session()->flash('success', 'Company has been Deleted successfully');
        return response()->json(['success' => true]);
    }

    public function companyInvoices($id)
    {
        $data['invoices']  = CompanyInvoice::query()
            ->where('company_id',$id)
            ->get();
        $data['company']  = Company::query()->findOrFail($id);
        return view('companies.details')->with($data);
    }

    public function dateToSearch(Request $request){
        $data['companies'] = Company::query()
            ->whereBetween('created_at', [$request->from, $request->to])
            ->orWhereBetween('updated_at', [$request->from, $request->to])
            ->latest()
            ->get()
            ->map(function ($item){
                $item->total = CompanyInvoice::query()->where('company_id',$item->id)->get()->sum('total_amount');
                $item->paid = CompanyInvoice::query()->where('company_id',$item->id)->get()->sum('total_paid');
                $item->dues = CompanyInvoice::query()->where('company_id',$item->id)->get()->sum('total_dues');
                return $item;
            });
        $data['to'] = $request->to;
        $data['from'] = $request->from;
        return view('companies.dateTo')->with($data);
    }
    public function InvoiceDateToSearch(Request $request){
        $data['invoices'] = CompanyInvoice::query()->with(['company'])
            ->whereBetween('created_at', [$request->from, $request->to])
//            ->orWhereBetween('updated_at', [$request->from, $request->to])
            ->latest()
            ->get();
        $data['to'] = $request->to;
        $data['from'] = $request->from;
        return view('companies.invoice-dateTo')->with($data);
    }
}
