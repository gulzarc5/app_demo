<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DashboardController extends Controller
{
    public function dashboardView()
    {
        $images = DB::table('image_data')->orderBy('id','desc')->get();
        $users = DB::table('user')->orderBy('id','desc')->get();
        return view('admin.dashboard',compact('images','users'));
    }
}
