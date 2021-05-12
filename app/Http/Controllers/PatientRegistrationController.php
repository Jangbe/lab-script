<?php

namespace App\Http\Controllers;

use App\Models\PatientRegistration;
use App\Models\PatientTest;
use App\Models\PatientResultTest;
use App\Models\HasilLab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientRegistrationController extends Controller
{
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PatientRegistration  $patientRegistration
     * @return \Illuminate\Http\Response
     */
    public function show(PatientRegistration $patientRegistration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PatientRegistration  $patientRegistration
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,PatientRegistration $patientRegistration)
    {
        $patientRegistration = $patientRegistration->with('patient','patientTest')->where('no_pendaftaran',strval($patientRegistration->no_pendaftaran))->first();
        return $request->ajax()?response()->json($patientRegistration) :view('admin.patient_test.edit',compact('patientRegistration'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PatientRegistration  $patientRegistration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientRegistration $patientRegistration)
    {
        // dd($request->only('id_penanggung_jawab','id_pengirim'));
        $request->validate([
            'cara_bayar'=>'required',
            'jenis_kelamin'=>'required_if:sts_pengunjung,B',
            'no_telepon'=>'nullable|required_if:sts_pengunjung,B|min:11|max:14',
            'rt'=>'nullable|min:3|max:3',
            'rw'=>'nullable|min:3|max:3',
            'kodepos'=>'nullable|min:6|max:6'
        ]);

        // Update the patient information
        $patient=collect($request->toArray())->put('rt_rw_kodepos',$request->rt.'-'.$request->rw.'-'.$request->kodepos)->toArray();
        $patientRegistration->update($patient);
        $patientRegistration['patient']->update($patient);

        // Old test patient
        $patient_tests=[];
        foreach($patientRegistration['patientTest'] as $test){
            array_push($patient_tests,$test['id_item']);
        }

        if($request->has('id_item')){
            // Delete the patient's test where not in select
            $deleted_patient_tests=PatientTest::where('no_pendaftaran',$request->no_pendaftaran)->whereNotIn('id_item',$request->id_item)->get();
            foreach ($deleted_patient_tests as $test) {
                foreach($test['item']['hasilLab'] as $hasilLab){
                    $hasilLab->delete();
                }
            }
            PatientTest::where('no_pendaftaran',$request->no_pendaftaran)->whereNotIn('id_item',$request->id_item)->delete();

            foreach($request->id_item as $i => $item){
                if(!in_array($item,$patient_tests)){
                    PatientTest::create([
                        'no_pendaftaran'=>$request->no_pendaftaran,
                        'id_item'=>$item,
                        'no_alat'=>$request->no_alat[$i]??0,
                        'id_pelaksana'=>$request->id_pelaksana[$i]??0,
                        'harga'=>$request->harga[$i]??0,
                        'non_jaminan'=>$request->non_jaminan[$i]??0
                    ]);
                    $hasilLab=HasilLab::where('id_item',$item)->get();
                    foreach ($hasilLab as $hsllab) {
                        if($hsllab->is_judul==0){
                            PatientResultTest::create([
                                'no_pendaftaran'=>$request->no_pendaftaran,
                                'id_hasil_lab'=>$hsllab->id,
                                'id_tiper'=>$hsllab->id_tiper,
                                'nilai'=>null,
                                'hasil_teks'=>null,
                                'is_duplo'=>0,
                                'keterangan'=>null,
                                'kesimpulan'=>null,
                                'is_input'=>0
                            ]);
                        }
                    }
                }else{
                    DB::table('patient_tests')->where(['no_pendaftaran'=>$request->no_pendaftaran,'id_item'=>$item])->update([
                        'no_alat'=>$request->no_alat[$i]??0,
                        'id_pelaksana'=>$request->id_pelaksana[$i]??0,
                        'non_jaminan'=>$request->non_jaminan[$i]??0
                    ]);
                }
            }

        }else{
            PatientTest::where('no_pendaftaran',$request->no_pendaftaran)->delete();
        }

        return redirect()->route('patient_test.index')->with('success','Pasien dan test nya berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PatientRegistration  $patientRegistration
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientRegistration $patientRegistration)
    {
        $patientRegistration->delete();
        return back()->with('success','Pasien Test berhasil dihapus.');
    }
}
