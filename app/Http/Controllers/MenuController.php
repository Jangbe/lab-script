<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class MenuController extends Controller
{
    public function getMenu()
    {
        return response()->json(\DB::table('menus')->get());
    }
}
