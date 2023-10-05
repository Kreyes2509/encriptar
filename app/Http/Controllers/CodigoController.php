<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Codigo;
use App\Mail\MandarCorreo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class CodigoController extends Controller
{
    public function encrypt(Request $requst)
    {
        $codigo = new Codigo();
        $encrypt = Crypt::encryptString($requst->input('codigo'));
        $codigo->encryptar =  $encrypt;
        if($codigo->save())
        {
            Mail::to('20170157@uttcampus.edu.mx')->send(new MandarCorreo($encrypt));
            return response()->json([
                "Status"=>200,
                "msg"=>"Encriptacion",
                "codigoEncryptado"=> $encrypt
            ],200);
        }
    }

    public function encryptWeb(Request $requst)
    {
        $codigo = new Codigo();
        $encrypt = Crypt::encryptString($requst->input('codigo'));
        $codigo->encryptar =  $encrypt;
        if($codigo->save())
        {
            Mail::to('20170157@uttcampus.edu.mx')->send(new MandarCorreo($encrypt));
            return redirect('/dashboard')->with('msg',"OK");
        }
        return redirect('/dashboard')->with('msg','BadRequest1');
    }

    public function decrypt(Request $request)
    {
        $codigos = Codigo::where('encryptar','=',$request->input('codigo'))->first();
        if($codigos->encryptar == $request->input('codigo') || Auth::user()->rol_id == 1)
        {
            $decrypt = Crypt::decryptString($request->input('codigo'));
            $codigos->desencryptar = $decrypt;
            if($codigos->save())
            {
                $frase = "frase:" . $decrypt;
                return redirect('/dashboard')->with('mensaje',$frase);
            }

            return redirect('/dashboard')->with('msg','Badrequest');
        }

        return redirect('/dashboard')->with('msg','findError');
    }
}
