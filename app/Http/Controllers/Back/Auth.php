<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth as Authe;

class Auth extends Controller
{
    public function login(){
        return view("back.auth.login");
    }

    public function loginPost(Request $request){
        if(Authe::attempt(["email"=>$request->email,"password"=>$request->password])){
            toastr()->success("Tekrardan Hoş Geldiniz ".Authe::user()->name);
            return redirect()->route("admin.dashboard");
        }
        return redirect()->route("admin.login")->withErrors("Email Adresi veya Şifre Hatalı");
    }

    public function logout(){
        Authe::logout();
        return redirect()->route("admin.login");
    }


}
