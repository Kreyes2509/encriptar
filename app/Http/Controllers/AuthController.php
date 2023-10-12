<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Codigo;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function index()
    {
        return view('Auth.login');
    }

    public function dashboard()
    {

        $users = User::all();
        $codigos = Codigo::select('users1.name AS user', 'users2.name AS destinatario','codigos.id','codigos.encryptar', 'codigos.desencryptar', 'codigos.status')
        ->join('users AS users1', 'users1.id', '=', 'codigos.user_id')
        ->join('users AS users2', 'users2.id', '=', 'codigos.destinatario')
        ->where('codigos.user_id', '=', Auth::user()->id)
        ->get();

        $mensaje = Codigo::select('users1.name AS user', 'users2.name AS destinatario','codigos.id','codigos.encryptar', 'codigos.desencryptar', 'codigos.status')
        ->join('users AS users1', 'users1.id', '=', 'codigos.user_id')
        ->join('users AS users2', 'users2.id', '=', 'codigos.destinatario')
        ->where('codigos.destinatario', '=', Auth::user()->id)
        ->get();

        return view('dashboard',compact('users','codigos','mensaje'));
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
