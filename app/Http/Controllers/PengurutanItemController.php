<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PengurutanItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = Item::query()->with('group', 'labGroup', 'clasification','itemTarif');

        $dt = new DataTables;

        return $request->ajax()?$dt->eloquent($items)
        ->addColumn('group_name', function($group){
            return $group['labGroup']['lab_group_name'];
        })
        ->addColumn('jml_pemeriksaan',function($item){
            return count($item['hasilLab']);
        })
        ->addColumn('action', function($item){
            return view('admin.pengurutan._action', compact('item'));
        })->toJson():view('admin.pengurutan.index');
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
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $pengurutan)
    {
        // dd($pengurutan->labSample->lab_sample_name);
        return view('admin.pengurutan.show',compact('pengurutan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $pengurutan)
    {
        $pengurutan->hasilLab;
        foreach ($request->id as $key => $value) {
            $pengurutan->hasilLab->where('id',$value)->first()->update(['no_urut'=>$request->no_urut[$key]]);
        }
        return back()->with('success', 'Pengurutan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
