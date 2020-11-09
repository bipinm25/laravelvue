<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index(){
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('layout.login',['msg'=>'']);
    }

    public function login(Request $request){
       
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $settings = DB::table('common_settings')->get();       
            $settings = $settings[0];
            $request->session()->put('limit', $settings->table_limit);  
                  
            // Authentication passed...
            //return redirect()->intended('admin');
            return redirect('/dashboard');
        }

        return view('layout.login',['msg'=>'Wrong Email/Password']);

    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function createuser(Request $request){

        // $this->validate($request, [
        //     'fullName' => 'required',
        //     'email' => 'bail|required|email|unique:users',
        //     'password' => 'bail|required|min:6',
        //     'role_id' => 'required',
        // ]);
        $request->password = '123';
        $password = bcrypt($request->password);
        $user = User::create([
            'name' => 'bipin',
            'email' => 'bipinm25@gmail.com',
            'password' => $password,
            //'role_id' => $request->role_id,
        ]);
        //return $user;
    }
}
