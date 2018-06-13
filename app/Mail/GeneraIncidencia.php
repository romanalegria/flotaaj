<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;


class GeneraIncidencia extends Mailable
{
    use Queueable, SerializesModels;

    public $contenido;
    public $titulo = "Solicitud de fondos";
  

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contenido,$titulo)
    {
        $this->contenido = $contenido;
        $this->titulo = $titulo;
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {            

        return $this->view('Mail.Solicitud')
                     ->subject('Solicitud de Fondos')
                    ->from('eranet1973@hotmail.com','Solicitud Rendicion de Fondos');
                   
                    
    }
}
