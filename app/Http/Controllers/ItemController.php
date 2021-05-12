<?php

namespace App\Http\Controllers;

use App\Models\Clasification;
use App\Models\Group;
use App\Models\Item;
use App\Models\LabGroup;
use App\Models\LabSample;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::with('group', 'labGroup', 'clasification', 'labSample')->get();
        return view('admin.item.index', compact('items'));
    }

    public function ajax(Request $request)
    {
        $items = Item::query()->with('group', 'labGroup', 'clasification','itemTarif');

        $dt = new DataTables;
        if(!is_null($request->filter_status)){
            $items->where('is_active', $request->filter_status);
        }
        return $dt->eloquent($items)
        ->addColumn('group_name', function($group){
            return $group['group']['group_name'];
        })
        ->addColumn('clasification_name', function($item){
            return $item['clasification']['clasification_name'];
        })
        ->addColumn('harga', function($item){
            return $item['itemTarif']['tarif_bayar']??0;
        })
        ->editColumn('is_active', function($item){
            return view('admin.item._status', compact('item'));
        })
        ->addColumn('action', function($item){
            return view('admin.item._action', compact('item'));
        })->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clasifications = Clasification::all();
        $groups = Group::all();
        $lab_groups = LabGroup::all();
        $lab_samples = LabSample::all();
        return view('admin.item.create', compact('clasifications', 'groups','lab_groups','lab_samples'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Item::create($request->except('_token'));
        session()->flash('success', 'Item berhasil ditambahkan');
        return redirect()->route('item.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $clasifications = Clasification::all();
        $groups = Group::all();
        $lab_groups = LabGroup::all();
        $lab_samples = LabSample::all();
        $item = $item->with('group', 'clasification')->find($item)->first();
        return view('admin.item.edit', compact('item', 'clasifications', 'groups','lab_groups','lab_samples'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $data=$request->except('_token');
        $data['is_active']=$request->has('is_active')?1:0;
        $item->update($data);
        session()->flash('success', 'Item berhasil diedit');
        return redirect()->route('item.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return back()->with('success',__('Item deleted sucessfully.'));
    }
}
