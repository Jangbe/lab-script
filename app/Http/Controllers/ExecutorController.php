<?php

namespace App\Http\Controllers;

use App\Models\Executor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;
use Yajra\DataTables\DataTables;

class ExecutorController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view_pelaksana',    ['only'=>['index','show']]);
        $this->middleware('can:create_pelaksana',  ['only'=>['create','store']]);
        $this->middleware('can:edit_pelaksana',    ['only'=>['edit','update']]);
        $this->middleware('can:delete_pelaksana',  ['only'=>['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $executors = Executor::all();
        return view('admin.executor.index', compact('executors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.executor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fee'=>'required_if:pengirim,1',
            'nama'=>'required'
        ]);
        $lastData = Executor::orderBy('kode', 'desc')->first()->kode??0;
        $code = "000".($lastData + 1);
        $code = substr($code, -4, 4);
        $executor = $request->except('_token');
        $executor["kode"] = $code;
        $executor["jenis_pelaksana"] = '-';
        Executor::create($executor);

        session()->flash('success', 'Pelaksana berhasil ditambahkan!');

        return redirect()->route('executor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\executor  $executor
     * @return \Illuminate\Http\Response
     */
    public function show(executor $executor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\executor  $executor
     * @return \Illuminate\Http\Response
     */
    public function edit(executor $executor)
    {
        return view('admin.executor.edit', compact('executor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\executor  $executor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, executor $executor)
    {
        $data = $request->except('_token');
        $data["jenis_pelaksana"] = '-';
        $data['aktif']=$request->has('aktif')?1:0;
        $data['pengirim']=$request->has('pengirim')?1:0;
        $data['pjawab']=$request->has('pjawab')?1:0;
        $data['pelaksana']=$request->has('pelaksana')?1:0;
        $executor->update($data);

        session()->flash('success', 'Pelaksana berhasil diupdate!');

        return redirect()->route('executor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\executor  $executor
     * @return \Illuminate\Http\Response
     */
    public function destroy(executor $executor)
    {
        $executor->delete();

        session()->flash('success', 'Pelaksana berhasil dihapus!');
        return redirect()->route('executor.index');
    }

    // For datatable
    public function ajax()
    {
        $executors = Executor::query();
        $dt = new DataTables;
        return $dt->eloquent($executors)
        ->removeColumn(['jenis_pelaksana', 'created_at', 'updated_at'])
        ->addColumn('action', function($executor){
            return view('admin.executor._action', compact('executor'));
        })->toJson();
    }
}
