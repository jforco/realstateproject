<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class activarCuenta extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $token, $nombre;

    public function __construct($token, $nombre)
    {
        $this->token = $token;
        $this->nombre = $nombre;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
                    ->view('user.mails.activarCuenta')
                    ->subject('LuCasas - Activar Cuenta')
                    ->with([
                        'token' => $this->token,
                        'nombre_usuario' => $this->nombre,
                    ]);
    }
}
