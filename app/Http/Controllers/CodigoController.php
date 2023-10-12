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
use App\Events\ChatEvent;
use Illuminate\Support\Facades\Broadcast;

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
        $requst->validate([
            'codigo'=>'required',
            'user_id'=>'required'
        ]);
        $codigo = new Codigo();
        $encrypt = Crypt::encryptString($requst->input('codigo'));
        $codigo->encryptar =  $encrypt;
        $codigo->user_id = Auth::user()->id;
        $codigo->destinatario = $requst->input('user_id');
        if($codigo->save())
        {
            event(new ChatEvent('mensaje'));
            Mail::to('20170157@uttcampus.edu.mx')->send(new MandarCorreo($encrypt));
            return redirect('/dashboard')->with('msg','OK');
        }
        return redirect('/dashboard')->with('msg','BadRequest1');
    }

    public function decrypt(Request $request)
    {
        $request->validate([
            'codigo'=>'required',
        ]);
        $codigos = Codigo::where('encryptar','=',$request->input('codigo'))->first();
        if($codigos->encryptar == $request->input('codigo') && $codigos->destinatario == Auth::user()->id)
        {
            $decrypt = Crypt::decryptString($request->input('codigo'));
            $codigos->desencryptar = $decrypt;
            $codigos->status = true;
            if($codigos->save())
            {
                event(new ChatEvent('mensaje'));
                $frase = "frase:" . $decrypt;
                return redirect('/dashboard')->with('msg','frase');
            }

            return redirect('/dashboard')->with('msg','Badrequest');
        }

        return redirect('/dashboard')->with('msg','findError');
    }

    public function mandarEvento()
    {
        event(new ChatEvent('mensaje'));

        return response()->json(['message'=>'evento enviado']);
    }
}
