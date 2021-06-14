<?php

namespace App\Http\Controllers;

use App\Models\AlatLabRinci;
use App\Models\HasilLab;
use App\Models\HasilLabAlat;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class HasilLabAlatController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view_setting_hasil_alat_lab',   ['only'=>['index','show']]);
        $this->middleware('can:create_setting_hasil_alat_lab', ['only'=>['create','store']]);
        $this->middleware('can:edit_setting_hasil_alat_lab',   ['only'=>['edit','update']]);
        $this->middleware('can:delete_setting_hasil_alat_lab', ['only'=>['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hasil_labs=HasilLab::all();
        $alat_labs=AlatLabRinci::all();
        $items=HasilLabAlat::query();
        // dd($items->get());
        $dt=new DataTables;
        return $request->ajax()?
            $dt->eloquent($items)
            ->addColumn('nm_hasil',function($item){
                return $item['hasilLab']['nm_hasil']." (".$item['hasilLab']['item']['nm_item'].")";
            })
            ->addColumn('parameter_alat', function($item){
                return $item['alatLabRinci']['parameter']." (".$item['alatLabRinci']['alatLab']['nm_alat'].")";
            })
            ->addColumn('action',function($item){
                return view('admin.hasil_lab_alat._action', compact('item'));
            })->toJson()
            :view('admin.hasil_lab_alat.index',compact('alat_labs','hasil_labs'));
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
        HasilLabAlat::create($request->except('_token','_method'));
        return back()->with('success','Setting Hasil Lab berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HasilLabAlat  $hasilLabAlat
     * @return \Illuminate\Http\Response
     */
    public function show(HasilLabAlat $hasilLabAlat, Request $request)
    {
        $hasilLabAlat->alatLabRinci->alatLab;
        return $request->ajax()?response()->json($hasilLabAlat):abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HasilLabAlat  $hasilLabAlat
     * @return \Illuminate\Http\Response
     */
    public function edit(HasilLabAlat $hasilLabAlat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HasilLabAlat  $hasilLabAlat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HasilLabAlat $hasilLabAlat)
    {
        $hasilLabAlat->update($request->except('_token','_method'));
        return back()->with('success', 'Setting Hasil Lab berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HasilLabAlat  $hasilLabAlat
     * @return \Illuminate\Http\Response
     */
    public function destroy(HasilLabAlat $hasilLabAlat)
    {
        $hasilLabAlat->delete();
        return back()->with('success','Setting Hasil Lab berhasil dihapus.');
    }
}
