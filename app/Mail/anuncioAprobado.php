<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Publicacion;

class anuncioAprobado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $nombre, $anuncio;
    public function __construct($nombre, Publicacion $anuncio)
    {
        //
        $this->nombre = $nombre;
        $this->anuncio = $anuncio;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
                    ->view('user.mails.anuncioAprobado')
                    ->subject('LuCasas - Tu anuncio se ha aprobado!')
                    ->with([
                        'nombre' => $this->nombre,
                        'anuncio' => $this->anuncio,
                    ]);
    }
}
