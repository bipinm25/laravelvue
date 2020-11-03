<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index(Request $request){

        $settings = DB::table('common_settings')->get();
       
        $settings = $settings[0];
        $request->session()->put('limit', $settings->table_limit);        
        return view('admin');
    }

    public function getSession(Request $request){
        return json_encode($request->session()->all());
    }
}
