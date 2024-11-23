<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre',
        'estado',
        'direccion',
        'MetodoPago',
        'FechaPedido',
        'TipoPedido',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'pedido_id');
    }

    public function index()
    {
        $vouchers = Voucher::with('pedido')->get();
        return view('vouchers.index', compact('vouchers'));
    }
}
