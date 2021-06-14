<?php

namespace App\Http\Controllers;

use App\Models\HasilLab;
use App\Models\HasilLabTipe;
use App\Models\HasilLabTiper;
use App\Models\Item;
use App\Models\NilaiNormal;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class HasilLabController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view_pemeriksaan',   ['only'=>['index','show']]);
        $this->middleware('can:create_pemeriksaan', ['only'=>['create','store']]);
        $this->middleware('can:edit_pemeriksaan',   ['only'=>['edit','update']]);
        $this->middleware('can:delete_pemeriksaan', ['only'=>['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.hasil_lab.index');
    }

    public function ajax(Request $request)
    {
        $items = HasilLab::query()->with('hasilLabTiper','item');

        $dt = new DataTables;
        if(!is_null($request->filter_status)){
            $items->where('is_active', $request->filter_status);
        }
        return $dt->eloquent($items)
        ->addColumn('pemeriksaan', function($item){
            return $item['item']['nm_item'];
        })
        ->editColumn('level_hasil',function($level){
            return $level['level_hasil']==1?'Pemeriksaan':'Sub Pemeriksaan';
        })
        ->addColumn('action', function($item){
            return view('admin.hasil_lab._action', compact('item'));
        })->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tests = Item::all();
        $tipes = HasilLabTipe::all();
        return view('admin.hasil_lab.create', compact('tests','tipes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nilai_normal=['satuan','min_p','max_p','min_w','max_w','min_a','max_a','min_b','max_b'];
        $id_hasil_lab = HasilLab::create($request->except(array_merge($nilai_normal),['_token','id_tipe']))->id;
        if($request->id_tipe=='1'||$request->id_tipe=='2'){
            if($request->has('is_nilai_normal')&&!$request->has('is_teks')&&!$request->has('is_judul')){
                $data = $request->only($nilai_normal);
                $data['id_hasil_lab']=$id_hasil_lab;
                NilaiNormal::create($data);
            }
        }
        return redirect()->route('hasil_lab.index')->with('success', 'Pemeriksaan Hasil Lab berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HasilLab  $hasilLab
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,HasilLab $hslLab, $id)
    {
        return $request->ajax()?response()->json($hslLab->with('hasilLabTiper','hasilLabTiper.hasilLabTipe','nilaiNormal','item')->find($id)):'';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HasilLab  $hasilLab
     * @return \Illuminate\Http\Response
     */
    public function edit(HasilLab $hasilLab)
    {
        $tests = Item::all();
        $tipes = HasilLabTipe::all();
        return view('admin.hasil_lab.edit', compact('tests','tipes','hasilLab'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HasilLab  $hasilLab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HasilLab $hasilLab)
    {
        $nilai_normal=['satuan','min_p','max_p','min_w','max_w','min_a','max_a','min_b','max_b'];
        $request_hasil_lab=$request->except(array_merge($nilai_normal),['_token','id_tipe']);
        $request_hasil_lab['is_judul']=$request->has('is_judul')?1:0;
        $request_hasil_lab['is_nilai_normal']=$request->has('is_nilai_normal')?1:0;
        $request_hasil_lab['is_teks']=$request->has('is_teks')?1:0;
        $request_hasil_lab['is_kesimpulan']=$request->has('is_kesimpulan')?1:0;
        $request_hasil_lab['is_rumus']=$request->has('is_rumus')?1:0;
        $hasilLab->update($request_hasil_lab);
        if($request->id_tipe=='1'||$request->id_tipe=='2'){
            if($request->has('is_nilai_normal')&&!$request->has('is_teks')&&!$request->has('is_judul')){
                $nilai_normal_data = NilaiNormal::where('id_hasil_lab', $hasilLab->id)->first();
                if($nilai_normal_data){
                    $nilai_normal_data->update($request->only($nilai_normal));
                }else{
                    NilaiNormal::create(collect($request->only($nilai_normal))->put('id_hasil_lab',$hasilLab->id)->toArray());
                }
            }else{
                $nilai_normal_data = NilaiNormal::where('id_hasil_lab', $hasilLab->id)->first();
                if($nilai_normal_data->isNotEmpty()){
                    $nilai_normal_data->delete();
                }
            }
            $hasilLab->update(['id_tiper'=>null]);
        }
        return redirect()->route('hasil_lab.index')->with('success', 'Pemeriksaan Hasil Lab berhasil diedit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HasilLab  $hasilLab
     * @return \Illuminate\Http\Response
     */
    public function destroy(HasilLab $hasilLab)
    {
        if(isset($hasilLab['nilaiNormal'])){
            NilaiNormal::find($hasilLab['nilaiNormal']['id'])->delete();
        }
        $hasilLab->delete();
        return back()->with('success','Pemeriksaan Hasil Lab berhasil dihapus.');
    }
}
