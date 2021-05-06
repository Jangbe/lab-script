<?php

namespace App\Http\Controllers;

use App\Models\AlatLab;
use App\Models\AlatLabRinci;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use function Symfony\Component\String\b;

class AlatLabRinciController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $alat_labs=AlatLab::all();
        $items = AlatLabRinci::query();

        $dt = new DataTables;
        return $request->ajax()?
            $dt->eloquent($items)
                ->editColumn('tipe_nilai', function($item){
                    $tipe = [1=>'Numeric','Teks','Lainya'];
                    return $tipe[$item['tipe_nilai']];
                })
                ->addColumn('nm_alat',function($item){
                    return $item['alatLab']['nm_alat'];
                })
                ->addColumn('action',function($item){
                    return view('admin.alat_lab_rinci._action',compact('item'));
                })->toJson()
            :view('admin.alat_lab_rinci.index',compact('alat_labs'));
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
        AlatLabRinci::create($request->except('_token','_method'));
        return back()->with('success','Parameter Alat Lab berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AlatLabRinci  $alatLabRinci
     * @return \Illuminate\Http\Response
     */
    public function show(AlatLabRinci $alatLabRinci,Request $request)
    {
        return $request->ajax()?response()->json($alatLabRinci):abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AlatLabRinci  $alatLabRinci
     * @return \Illuminate\Http\Response
     */
    public function edit(AlatLabRinci $alatLabRinci)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AlatLabRinci  $alatLabRinci
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AlatLabRinci $alatLabRinci)
    {
        $alatLabRinci->update($request->except('_token','_method'));
        return back()->with('success','Parameter Alat Lab berhasil diedit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AlatLabRinci  $alatLabRinci
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlatLabRinci $alatLabRinci)
    {
        $alatLabRinci->delete();
        return back()->with('success','Parameter Alat Lab berhasil dihapus.');
    }
}
