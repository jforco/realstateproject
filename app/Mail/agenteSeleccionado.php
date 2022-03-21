<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;
use App\Models\Publicacion;

class agenteSeleccionado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $nombre_agente, $usuario, $anuncio; 

    public function __construct($nombre, User $user, Publicacion $pub)
    {
        //
        $this->nombre_agente = $nombre;
        $this->usuario = $user;
        $this->anuncio = $pub;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
                    ->view('user.mails.agenteSeleccionado')
                    ->subject('LuCasas - Has sido elegido!')
                    ->with([
                        'nombre_agente' => $this->nombre_agente,
                        'cliente' => $this->usuario,
                        'anuncio' => $this->anuncio,
                    ]);
    }
}
