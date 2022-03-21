<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Mail;
use App\Mail\agenteSeleccionado;
use App\Models\User;
use App\Models\Publicacion;

class correoAgenteElegido implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $correo, $nombre_agente, $usuario, $anuncio; 

    public function __construct($correo, $nombre, User $user, Publicacion $pub)
    {
        //
        $this->correo = $correo;
        $this->nombre_agente = $nombre;
        $this->usuario = $user;
        $this->anuncio = $pub;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->correo)->send(new agenteSeleccionado($this->nombre_agente, $this->usuario, $this->anuncio));
    }
}
