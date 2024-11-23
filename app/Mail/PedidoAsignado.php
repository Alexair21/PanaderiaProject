<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PedidoAsignado extends Mailable
{
    use Queueable, SerializesModels;

    public $repartidor;
    public $pedido;

    /**
     * Create a new message instance.
     */
    public function __construct($repartidor, $pedido)
    {
        $this->repartidor = $repartidor;
        $this->pedido = $pedido;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Se te ha asignado un nuevo pedido')
                    ->view('emails.pedido_asignado');
    }
}
