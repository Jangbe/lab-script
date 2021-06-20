<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use App\Models\Executor;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\PatientRegistration;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docters = Executor::where('pengirim',1)->get();
        return view('admin.transaksi.index',compact('docters'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return $request;
    }

    public function ajax(Request $request)
    {
        $request->validate([
            'from'=>'required|date',
            'to'=>'required|date',
        ]);
        $patients=PatientRegistration::with('patient','pengirim')->whereBetween('created_at', [$request->from,$request->to]);
        if($request->docter!=='all'){
            $patients=$patients->where('id_pengirim',$request->docter);
        }
        $patients=$patients->get();
        $results = [];
        foreach($patients as $i => $patient){
            $total     = $patient->subtotal+$patient->nilai_cito+$patient->nilai_admin-$patient->nilai_discount;
            $fee       = is_null($patient->pengirim)?0:$patient->pengirim->fee;
            $fee_total = ($fee/100)*$total;
            $total    += $fee_total;
            $results[$i]['tanggal']     = date('Y-m-d',strtotime($patient->created_at));
            $results[$i]['nama']        = $patient->patient->nama;
            $results[$i]['total_biaya'] = $total;
            $results[$i]['nama_dokter'] = $patient->pengirim->nama??'';
            $results[$i]['fee']         = $fee_total;
        }
        if($request->ajax()){
            return response()->json($results);
        }else if($request->aksi=='pdf'){
            $pdf = \PDF::loadView('pdf.laporan',compact('results','request'))->setPaper('a4', 'landscape');;
            return $pdf->stream('Laporan Keuangan.pdf');
        }else if($request->aksi=='excel'){
            return Excel::download(new TransaksiExport($results), 'Laporan Keuangan'.date('d-m-Y').'.xls');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
