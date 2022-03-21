<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Publicacion;


class contactoVendedor_guest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $nombre, $anuncio, $mensaje, $telefono;
    public function __construct($nombre, Publicacion $anuncio, $mensaje, $telefono)
    {
        //
        $this->nombre = $nombre;
        $this->anuncio = $anuncio;
        $this->mensaje = $mensaje;
        $this->telefono = $telefono;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
                    ->view('user.mails.contactoVendedor')
                    ->subject('LuCasas - Alguien quiere mas de tu anuncio')
                    ->with([
                        'nombre' => $this->nombre,
                        'anuncio' => $this->anuncio,
                        'mensaje' => $this->mensaje,
                        'telefono' => $this->telefono,
                    ]);
    }
}
