<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Mail;
use App\Mail\contactoMail;

class correoContacto implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $correo, $nombre, $mensaje;
    public function __construct($nombre, $correo, $mensaje)
    {
        //
        $this->nombre = $nombre;
        $this->correo = $correo;
       
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
        Mail::to('info@lucasas.com')->send(new contactoMail($this->nombre, $this->correo, $this->mensaje));
    }
}
