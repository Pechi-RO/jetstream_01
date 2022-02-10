<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactoMailable extends Mailable
{
    use Queueable, SerializesModels;
    //creamos estas variables, datos es el contenido
    public $subject="Formulario de contacto";
    public $datos, $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($d,$e)
    {
        //modificamos el contructor
        $this->datos=$d;
        $this->email=$e;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //usaremos markdwon, crearemos una carpeta mails con el arhivo fcontacto
        return $this->markdown('mails.fcontacto');
    }
}
