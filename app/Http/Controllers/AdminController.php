<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function setting()
    {
        $active = Route::getCurrentRoute()->uri;
        $menus = DB::table('menus')->get();
        return view('admin.setting', compact('active', 'menus'));
    }

    public function pdf()
    {
        return generate_pdf('',2);
    }
}
