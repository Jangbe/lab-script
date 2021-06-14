<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    /**
     * assign roles
     */
    public function __construct()
    {
        $this->middleware('can:view_roles',     ['only' => ['index', 'show','view']]);
        $this->middleware('can:create_roles',   ['only' => ['create', 'store']]);
        $this->middleware('can:edit_roles',     ['only' => ['edit', 'update']]);
        $this->middleware('can:delete_roles',   ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.roles.index');
    }

    /**
    * get roles datatable
    *
    * @access public
    * @var  @Request $request
    */
    public function ajax(Request $request)
    {
        $model=Role::query()->with('permissions');

        return DataTables::eloquent($model)
        ->addColumn('permissions',function($role){
            return view('admin.roles._permissions',compact('role'));
        })
        ->addColumn('action',function($role){
            return view('admin.roles._action',compact('role'));
        })
        ->toJson();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions=Permission::all();
        $modules=Module::all();
        return view('admin.roles.create',compact('permissions','modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role=Role::create($request->except('_token','permissions'));

        if($request->has('permissions'))
        {
            $role->permissions()->createMany($request['permissions']);
        }

        session()->flash('success',__('Role created successfully'));

        return redirect()->route('hak_akses.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role=Role::findOrFail($id);

        $permissions=Permission::all();

        $modules=Module::all();

        return view('admin.roles.edit',compact('role','permissions','modules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role=Role::findOrFail($id);

        $role->update($request->except('_token','_method','permissions'));

        RolePermission::where('role_id',$id)->delete();

        if($request->has('permissions'))
        {
            $role->permissions()->createMany($request['permissions']);
        }

        session()->flash('success',__('Role updated successfully'));

        return redirect()->route('hak_akses.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role=Role::findOrFail($id);

        $role->permissions()->delete();

        $role->delete();

        session()->flash('success',__('Role deleted successfully'));

        return redirect()->route('hak_akses.index');

    }
}
