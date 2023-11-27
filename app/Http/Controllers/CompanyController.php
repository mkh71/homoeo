<?php

namespace App\Http\Controllers;

use App\Models\Company;
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
        $data['companies'] = Company::query()->get();
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
            Company::query()->create($request->all());
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $data['companies'] = Company::query()->get();
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
            $company->update($request->all());
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
        dd($id);
    }
}
