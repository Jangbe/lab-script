<?php

namespace App\Http\Controllers;

use App\Models\HasilLab;
use App\Models\Patient;
use App\Models\PatientRegistration;
use App\Models\PatientResultTest;
use App\Models\PatientTest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PatientTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $patients = PatientRegistration::query();
        $dt = new DataTables;
        return $request->ajax()? $dt->eloquent($patients)
        ->addColumn('nama', function($patient){
            return $patient['patient']['nama'];
        })
        ->addColumn('no_identitas',function($patient){
            return $patient['patient']['no_identitas'];
        })
        ->addColumn('no_telepon',function($patient){
            return $patient['patient']['no_telepon'];
        })
        ->addColumn('action', function($patient){
            return view('admin.patient_test._action', compact('patient'));
        })->toJson()
        :view('admin.patient_test.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.patient_test.create');
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
            'cara_bayar'=>'required',
            'jenis_kelamin'=>'required_if:sts_pengunjung,B',
            'no_telepon'=>'nullable|min:11|max:14',
            'rt'=>'nullable|min:3|max:3',
            'rw'=>'nullable|min:3|max:3',
            'kodepos'=>'nullable|min:6|max:6'
        ]);
        $no_urut=PatientRegistration::select('no_urut')->orderBy('no_urut','desc')->first();
        $no_urut=$no_urut?$no_urut->no_urut+1:1;
        $no_rm = Patient::find($request->s_no_rm)->noreg??0;
        if($request->sts_pengunjung=='B'){
            $patient=collect($request->toArray())->put('rt_rw_kodepos',$request->rt.'-'.$request->rw.'-'.$request->kodepos)->toArray();
            Patient::create($patient);
            $no_rm = $request->noreg;
        }
        $patientRegistration = collect($request->toArray())->put('no_urut',$no_urut)
                               ->put('no_rm',$no_rm)->put('sts_kunjungan',$request->sts_pengunjung)->toArray();
        PatientRegistration::create($patientRegistration);
        if($request->has('id_item')){
            foreach($request->id_item as $i => $v){
                PatientTest::create([
                    'no_pendaftaran'=>$request->no_pendaftaran,
                    'id_item'=>$v,
                    'no_alat'=>$request->no_alat[$i]??0,
                    'id_pelaksana'=>$request->id_pelaksana[$i]??0,
                    'harga'=>$request->harga[$i]??0,
                    'non_jaminan'=>$request->non_jaminan[$i]??0
                ]);

                $hasilLab=HasilLab::where('id_item',$v)->get();
                foreach ($hasilLab as $hsllab) {
                    if($hsllab->is_judul==0){
                        PatientResultTest::create([
                            'no_pendaftaran'=>$request->no_pendaftaran,
                            'id_hasil_lab'=>$hsllab->id,
                            'id_tiper'=>$hsllab->id_tiper,
                            'nilai'=>0,
                            'hasil_teks'=>null,
                            'is_duplo'=>0,
                            'keterangan'=>null,
                            'kesimpulan'=>null,
                            'is_input'=>0
                        ]);
                    }
                }
            }
        }
        return redirect()->route('patient_test.index')->with('success','Pasien Test berhasil ditambahkan');
    }

    public function getNoPendaftaran(Request $request)
    {
        $patientRegistration=PatientRegistration::select('no_urut')->orderBy('no_urut','desc')->first();
        $no_urut=$patientRegistration?$patientRegistration->no_urut+1:1;
        $no_urut="000".$no_urut;
        $no_urut=substr($no_urut,-4,4);
        return $request->ajax()?date('Ymd').$no_urut:abort(403, 'Request harus ajax');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PatientTest  $patientTest
     * @return \Illuminate\Http\Response
     */
    public function show(PatientRegistration $patientTest, Request $request)
    {
        $patient_tests=PatientTest::where('no_pendaftaran',strval($patientTest->no_pendaftaran))->get();
        if($request->ajax()){
            $hasilLab = PatientResultTest::where('no_pendaftaran',strval($patientTest->no_pendaftaran))->get();
            return response()->json($hasilLab);
        }
        return view('admin.patient_test.hasil_lab',compact('patientTest','patient_tests'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PatientTest  $patientTest
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientTest $patientTest)
    {
        return view('admin.patient_test.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PatientTest  $patientTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientTest $patientTest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PatientTest  $patientTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientTest $patientTest)
    {
        //
    }
}
