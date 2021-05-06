<?php

namespace App\Http\Controllers;

use App\Models\HasilLab;
use App\Models\HasilLabTipe;
use App\Models\HasilLabTiper;
use App\Models\NilaiNormal;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class HasilLabTiperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hasilLabTipes = HasilLabTipe::all();
        return view('admin.hasil_lab_rinci.index', compact('hasilLabTipes'));
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

    public function ajax(Request $request)
    {
        $items = HasilLabTiper::query()->with('hasilLabTipe');

        $dt = new DataTables;
        if(!is_null($request->filter_status)){
            $items->where('is_active', $request->filter_status);
        }
        return $dt->eloquent($items)
        ->addColumn('keterangan', function($item){
            return $item['hasilLabTipe']['keterangan'];
        })
        ->addColumn('action', function($item){
            return view('admin.hasil_lab_rinci._action', compact('item'));
        })->toJson();
    }

    public function get_tiper($id_tipe)
    {
        $tiper = HasilLabTiper::where('id_tipe',$id_tipe)->get();
        return response()->json($tiper);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HasilLabTiper::create($request->except('_token','_method'));
        return back()->with('success', 'Hasil Lab Rinci berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HasilLabTiper  $hasilLabTiper
     * @return \Illuminate\Http\Response
     */
    public function show(HasilLabTiper $hasilLabTiper)
    {
        return response()->json($hasilLabTiper);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HasilLabTiper  $hasilLabTiper
     * @return \Illuminate\Http\Response
     */
    public function edit(HasilLabTiper $hasilLabTiper)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HasilLabTiper  $hasilLabTiper
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HasilLabTiper $hasil_lab_tiper)
    {
        $hasil_lab_tiper->update($request->except('_token','_method'));
        return back()->with('success', 'Hasil Lab Tipe Rinci berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HasilLabTiper  $hasilLabTiper
     * @return \Illuminate\Http\Response
     */
    public function destroy(HasilLabTiper $hasilLabTiper)
    {
        $hasilLabTiper->delete();
        return back()->with('success', 'Hasil Lab Rinci berhasil dihapus.');
    }
}
