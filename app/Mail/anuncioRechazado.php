<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Publicacion;

class anuncioRechazado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $nombre, $anuncio, $mensaje;
    public function __construct($nombre, Publicacion $anuncio, $mensaje)
    {
        //
        $this->nombre = $nombre;
        $this->anuncio = $anuncio;
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
                    ->view('user.mails.anuncioRechazado')
                    ->subject('LuCasas - Tu anuncio no se ha aprobado')
                    ->with([
                        'nombre' => $this->nombre,
                        'anuncio' => $this->anuncio,
                        'mensaje' => $this->mensaje,
                    ]);
    }
}
