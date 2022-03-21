<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class contactoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $nombre, $correo, $mensaje;
    public function __construct($nombre, $correo, $mensaje)
    {
        //
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
                    ->view('user.mails.contacto')
                    ->subject('LuCasas - Alguien quiere contactar a la empresa')
                    ->with([
                        'nombre' => $this->nombre,
                        'correo' => $this->correo,
                        'mensaje' => $this->mensaje,
                    ]);
        return $this->view('view.name');
    }
}
