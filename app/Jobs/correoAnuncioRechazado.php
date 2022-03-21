<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Mail;
use App\Mail\anuncioRechazado;
use App\Models\Publicacion;
use App\Models\User;

class correoAnuncioRechazado implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $user,  $anuncio, $mensaje;
    public function __construct(User $u , Publicacion $anuncio, $mensaje)
    {
        //
        
        $this->user = $u;
        $this->anuncio = $anuncio;
        $this->mensaje = $mensaje;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $this->mensaje = $this->mensaje;
        Mail::to($this->user->correo)->send(new anuncioRechazado($this->user->nombre, $this->anuncio, $this->mensaje));
    }
}
