<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'cantidad',
        'precio_unitario',
        'total',
        'producto_id',
        'venta_id',
    ];

    public $timestamps = false;

    public function productos()
    {
        return $this->belongsTo(Producto::class);
    }



    public function ventas()
    {
        return $this->belongsTo(Venta::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

}
