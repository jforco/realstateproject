<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;
use App\Models\Publicacion;

class anuncioGuardadoAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $usuario, $anuncio; 

    public function __construct(User $user, Publicacion $pub)
    {
        //
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
                    ->view('user.mails.anuncioAdminGuardado')
                    ->subject('LuCasas - Un nuevo anuncio se ha guardado con éxito')
                    ->with([
                        'cliente' => $this->usuario,
                        'anuncio' => $this->anuncio
                        
                    ]);
    }
}
