<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'fecha',
        'estado',
        'ventas_id',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'ventas_id');
    }
}
