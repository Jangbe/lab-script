<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemTarif;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ItemTarifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return view('admin.item_tarif.index',compact('items'));
    }

    public function ajax(Request $request, ItemTarif $itemTarif)
    {
        $items = ItemTarif::query();

        $dt = new DataTables;
        if(!is_null($request->filter_status)){
            $items->where('is_active', $request->filter_status);
        }
        return $dt->eloquent($items)
        ->addColumn('nm_item', function($item){
            return $item['item']['nm_item'];
        })
        ->editColumn('tarif_bayar', function($item){
            return "Rp. ".number_format($item['tarif_bayar'],0,',','.');
        })
        ->editColumn('tarif_bpjs', function($item){
            return "Rp. ".number_format($item['tarif_bpjs'],0,',','.');
        })
        ->editColumn('tarif_jaminan', function($item){
            return "Rp. ".number_format($item['tarif_jaminan'],0,',','.');
        })
        ->editColumn('is_active', function($item){
            return view('admin.item_tarif._status', compact('item'));
        })
        ->addColumn('action', function($item){
            return view('admin.item_tarif._action', compact('item'));
        })->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.item_tarif.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemTarif  $itemTarif
     * @return \Illuminate\Http\Response
     */
    public function show(ItemTarif $itemTarif)
    {
        return response()->json($itemTarif);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemTarif  $itemTarif
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemTarif $itemTarif)
    {
        return view('admin.item_tarif.edit', compact('itemTarif'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemTarif  $itemTarif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemTarif $itemTarif)
    {
        $data=$request->except('_token','_method');
        $data['is_active']=$request->has('is_active')?1:0;
        $itemTarif->update($data);
        return back()->with('success','Tarif berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemTarif  $itemTarif
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemTarif $itemTarif)
    {
        //
    }
}
