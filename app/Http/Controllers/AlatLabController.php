<?php

namespace App\Http\Controllers;

use App\Models\AlatLab;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AlatLabController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view_alat_laboratorium',   ['only'=>['index','show']]);
        $this->middleware('can:create_alat_laboratorium', ['only'=>['create','store']]);
        $this->middleware('can:edit_alat_laboratorium',   ['only'=>['edit','update']]);
        $this->middleware('can:delete_alat_laboratorium', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = AlatLab::query();

        $dt = new DataTables;
        if(!is_null($request->filter_status)){
            $items->where('is_active', $request->filter_status);
        }
        return $request->ajax()?
            $dt->eloquent($items)
            ->editColumn('is_active', function($item){
                return view('admin.item_tarif._status', compact('item'));
            })
            ->addColumn('action', function($item){
                return view('admin.alat_labs._action', compact('item'));
            })->toJson() :
            view('admin.alat_labs.index');
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
        AlatLab::create($request->except('_token','_method'));
        return back()->with('success', 'Alat Lab berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AlatLab  $alatLab
     * @return \Illuminate\Http\Response
     */
    public function show(AlatLab $alatLab)
    {
        return response()->json($alatLab);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AlatLab  $alatLab
     * @return \Illuminate\Http\Response
     */
    public function edit(AlatLab $alatLab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AlatLab  $alatLab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AlatLab $alatLab)
    {
        $data=$request->except('_token','_method');
        $data['is_active']=$request->has('is_active')?1:0;
        $alatLab->update($data);
        return back()->with('success', 'Alat Lab berhasil diedit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AlatLab  $alatLab
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlatLab $alatLab)
    {
        $alatLab->delete();
        return back()->with('success', 'Alat Lab berhasil dihapus.');
    }
}
