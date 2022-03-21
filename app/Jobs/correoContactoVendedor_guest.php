<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Mail;
use App\Mail\contactoVendedor_guest;
use App\Models\Publicacion;

class correoContactoVendedor_guest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $correo, $nombre, $anuncio, $mensaje, $telefono;
    public function __construct($correo, $nombre, Publicacion $anuncio, $mensaje, $telefono)
    {
        //
        $this->correo = $correo;
        $this->nombre = $nombre;
        $this->anuncio = $anuncio;
        $this->mensaje = $mensaje;
        $this->telefono = $telefono;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Mail::to($this->correo)->send(new contactoVendedor_guest($this->nombre, $this->anuncio, $this->mensaje, $this->telefono));
    }
}
