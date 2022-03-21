<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\UserAdm;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\anuncioAprobado;
use App\Models\Publicacion;

class correoAnuncioAprobado implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $user, $anuncio;
    public function __construct(User $u, Publicacion $anuncio)
    {
        //
        $this->user = $u;
        $this->anuncio = $anuncio;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    
        //
      //  $correos = UserAdm::pluck('correo');
        Mail::to($this->user->correo)->send(new anuncioAprobado($this->user->nombre, $this->anuncio));
    }
}
