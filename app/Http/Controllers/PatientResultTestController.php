<?php

namespace App\Http\Controllers;

use App\Models\PatientResultTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientResultTestController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:hasil_pemeriksaan_pemeriksaan_pasien',['only'=>['store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        foreach ($request['id_hasil_lab'] as $key => $value) {
            DB::table('patient_test_results')->where(['no_pendaftaran'=>$request->no_pendaftaran,'id_hasil_lab'=>$value])->update([
                'id_tiper'=>$request['id_tiper'][$key]??null,
                'nilai'=>$request['nilai'][$key]??null,
                'hasil_teks'=>$request['hasil_teks'][$key]??null,
                'is_duplo'=>$request['is_duplo'][$key]??0,
                'keterangan'=>$request['keterangan'][$key]??null,
                'kesimpulan'=>$request['kesimpulan'][$key]??null,
                'is_input'=>1
            ]);
        }
        return back()->with('success','Hasil pemeriksaan pasien berhasil diperbarui.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PatientResultTest  $patientResultTest
     * @return \Illuminate\Http\Response
     */
    public function show(PatientResultTest $patientResultTest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PatientResultTest  $patientResultTest
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientResultTest $patientResultTest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PatientResultTest  $patientResultTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientResultTest $patientResultTest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PatientResultTest  $patientResultTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientResultTest $patientResultTest)
    {
        //
    }
}
