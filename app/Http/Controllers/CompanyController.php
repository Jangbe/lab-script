<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::query();
        $dt = new DataTables;
        return request()->ajax()?$dt->eloquent($companies)
        ->editColumn('is_active', function($company){
            return view('admin.company._status', compact('company'));
        })
        ->addColumn('action', function($company){
            return view('admin.company._action', compact('company'));
        })->toJson():view('admin.company.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add(['is_active'=>$request->has('is_active')?1:0]);
        Company::create($request->all());
        return redirect()->route('perusahaan.index')->with('success','Perusahaan berhasil ditambahkan.');
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
    public function edit(Company $perusahaan)
    {
        return view('admin.company.edit', compact('perusahaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $perusahaan)
    {
        $request->request->add(['is_active'=>$request->has('is_active')?1:0]);
        $perusahaan->update($request->all());
        return redirect()->route('perusahaan.index')->with('success','Perusahaan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $perusahaan)
    {
        $nama = $perusahaan->company_name;
        $perusahaan->delete();
        return back()->with('success','Perusahaan '.$nama.' berhasil dihapus');
    }
}
