<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Mail;
use App\Mail\contactoVendedor_user;
use App\Models\User;
use App\Models\Publicacion;

class correoContactoVendedor_user implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $correo, $nombre, $anuncio, $mensaje, $user;
    public function __construct($correo, $nombre, Publicacion $anuncio, $mensaje, User $user)
    {
        //
        $this->correo = $correo;
        $this->nombre = $nombre;
        $this->anuncio = $anuncio;
        $this->mensaje = $mensaje;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Mail::to($this->correo)->send(new contactoVendedor_user($this->nombre, $this->anuncio, $this->mensaje, $this->user));
    }
}
