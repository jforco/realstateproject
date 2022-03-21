<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Publicacion;
use App\Models\Codigo;
use Khipu;

class KhipuConfirmation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $confirm = false;
        $cant_intentos = 10;
        $receiver_id = env('KHIPU_RECEIVER_ID');
        $secret = env('KHIPU_SECRET');
        $pub = Publicacion::where('id', $this->id)->first();
        while(!$confirm && $cant_intentos > 0){
            try {
                sleep(15);
                $configuration = new Khipu\Configuration();
                $configuration->setSecret($secret);
                $configuration->setReceiverId($receiver_id);
                $client = new Khipu\ApiClient($configuration);
                $payments = new Khipu\Client\PaymentsApi($client);
        
                $response = $payments->paymentsIdGet($pub->paymentID);
                if ($response->getReceiverId() == $receiver_id) {
                    if ($response->getStatus() == 'done' && $response->getAmount() == $pub->cant_pago) {
                        // marcar el pago como completo y entregar el bien o servicio
                        $pub->estado = "pendiente";
                        $pub->save();
                        //romper ciclo
                        $confirm = true;
                    }
                }
                $cant_intentos = $cant_intentos - 1;
                $a = new Codigo();
                $a->nombre = $pub->paymentID.$cant_intentos;
                $a->save();
            } catch (Exception $exception) {
                print_r($exception->getResponseObject());
            }
            
        }
    }
}
