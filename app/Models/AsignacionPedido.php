<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionPedido extends Model
{
    use HasFactory;

    protected $table = 'asignacion_pedidos';

    protected $fillable = [
        'pedido_id',
        'personal_id',
        'estado',
        'fecha_asignacion'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }

    public function repartidor()
    {
        return $this->belongsTo(Personal::class, 'personal_id');
    }
}
