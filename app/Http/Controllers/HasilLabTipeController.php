<?php

namespace App\Http\Controllers;

use App\Models\HasilLabTipe;
use App\Models\hsllab_tipe;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class HasilLabTipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.hasil_lab_tipe.index');
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
        $items = HasilLabTipe::query();

        $dt = new DataTables;
        if(!is_null($request->filter_status)){
            $items->where('is_number', $request->filter_status);
        }
        return $dt->eloquent($items)
        ->editColumn('is_number', function($item){
            return view('admin.hasil_lab_tipe._number', compact('item'));
        })
        ->addColumn('action', function($item){
            return view('admin.hasil_lab_tipe._action', compact('item'));
        })->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HasilLabTipe::create($request->except('_token','_method'));
        return back()->with('success', 'Hasil Lab Tipe berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\hsllab_tipe  $hsllab_tipe
     * @return \Illuminate\Http\Response
     */
    public function show(HasilLabTipe $hasilLabTipe)
    {
        return response()->json($hasilLabTipe);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\hsllab_tipe  $hsllab_tipe
     * @return \Illuminate\Http\Response
     */
    public function edit(HasilLabTipe $hasilLabTipe)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\hsllab_tipe  $hsllab_tipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HasilLabTipe $hasilLabTipe)
    {
        $data = $request->except('_token', '_method');
        if(!$request->has('is_number'))$data['is_number']=0;
        $hasilLabTipe->update($data);
        return back()->with('success', 'Hasil Lab Tipe berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\hsllab_tipe  $hsllab_tipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(HasilLabTipe $hasilLabTipe)
    {
        $hasilLabTipe->delete();
        return back()->with('success', 'Hasil Lab Tipe berhasil dihapus.');
    }
}
