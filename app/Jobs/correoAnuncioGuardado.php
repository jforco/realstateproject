<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\UserAdm;
use Illuminate\Support\Facades\Mail;
use App\Mail\anuncioGuardado;
use App\Mail\anuncioGuardadoAdmin;
use App\Models\User;
use App\Models\Publicacion;

class correoAnuncioGuardado implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $user, $anuncio;
    public function __construct(User $u, Publicacion $p)
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
        //mandar admins
        $correos = UserAdm::pluck('correo');
        Mail::to($correos)->send(new anuncioGuardadoAdmin($this->user, $this->anuncio));
        Mail::to($this->user->correo)->send(new anuncioGuardado($this->user, $this->anuncio));
    }
}
