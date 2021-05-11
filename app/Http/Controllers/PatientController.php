<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $patients = Patient::query();
        $dt = new DataTables;
        return $request->ajax()? $dt->eloquent($patients)
        ->addColumn('action', function($patient){
            return view('admin.patient._action', compact('patient'));
        })->toJson()
        :view('admin.patient.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.patient.create');
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
            'jenis_kelamin'=>'required',
            'no_telepon'=>'nullable|min:11|max:14',
            'rt'=>'min:3|max:3',
            'rw'=>'min:3|max:3',
            'kodepos'=>'min:6|max:6'
        ]);
        $rt_rw_kodepos=($request->rt??'000').'-'.($request->rw??'000').'-'.($request->kodepos??'000');
        $request = collect($request)->put('rt_rw_kodepos', $rt_rw_kodepos);
        Patient::create($request->except('_token')->toArray());
        return redirect()->route('patient.index')->with('success', 'Pasien berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, Request $request)
    {
        return $request->ajax()?response()->json($patient):abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, Request $request)
    {
        return $request->ajax()?response()->json($patient):view('admin.patient.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'jenis_kelamin'=>'required',
            'no_telepon'=>'nullable|min:11|max:14',
            'rt'=>'min:3|max:3',
            'rw'=>'min:3|max:3',
            'kodepos'=>'min:6|max:6'
        ]);
        $rt_rw_kodepos=($request->rt??'000').'-'.($request->rw??'000').'-'.($request->kodepos??'000');
        $request = collect($request)->put('rt_rw_kodepos', $rt_rw_kodepos);
        $patient->update($request->except('_token')->toArray());
        return redirect()->route('patient.index')->with('success', 'Pasien berhasil diedit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patient.index')->with('success', 'Pasien berhasil dihapus.');
    }
}
