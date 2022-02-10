<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function pintarFormulario(){
        return view('contacto.index');
    }
    public function procesarFormulario(Request $request){
        $request->validate([
            'nombre'=>['required','string','min:3'],
            'mensaje'=>['required','string','min:10'],

        ]);
        //si paso de aqui la validacion ha ido bien
        //esto recupera los datos de contacto mailable, 
        //es posible dado a la modificaicon del constructor.
        $correo=new ContactoMailable($request->all(), auth()->user()->email);        
        try{
            //intentamos en viar el mensaje desde la dirección puesta
            //que es la de .env
            Mail::to('admin@correo.es')->send($correo);
        }catch(\Exception $ex){
            //recordemos que esto es el die() de laravel
            //dd($ex->getMessage());
            return redirect()->route('posts.show')->with('correo','No se pudo enviar el correo');

        }
        return redirect()->route('posts.show')->with('correo','Correo enviado, gracias');

    }
}
