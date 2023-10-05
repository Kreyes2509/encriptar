<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('Auth.login');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function registrar()
    {
        return view('Auth.registrar');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            return redirect('/dashboard')->with('msg','Bienvenido!');
        }

        return redirect('/login')->with('msg','credenciales no validas');

    }

    public function signUp(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $password = bcrypt($request->input('password'));
        $user->password = $password;
        $user->rol_id = 2;
        $user->save();

        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            return redirect('/dashboard')->with('msg','Bienvenido!');
        }

        return redirect('/registrar')->with('msg','datos no validos');

    }

    public function singOut() {
        Session::flush();
        Auth::logout();

        return redirect('/login')->with('msg','adios');;
    }
}
