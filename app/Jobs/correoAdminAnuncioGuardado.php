<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Mail;
use App\Mail\anuncioGuardado;
use App\Mail\anuncioGuardadoAdmin;
use App\Models\Publicacion;
use App\Models\UserAdm;

class correoAdminAnuncioGuardado implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected  $u, $anuncio;
    public function __construct(User $u,  Publicacion $p)
    {
        //
        $this->user = $u;
        
        $this->anuncio = $p;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $correos = UserAdm::pluck('correo');
         Mail::to($correos)->send(new anuncioGuardadoAdmin($this->user, $this->anuncio));
        Mail::to($this->correo)->send(new anuncioGuardadoAdmin( $this->anuncio));
    }
}
