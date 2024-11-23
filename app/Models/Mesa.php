<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'sala_id',
        'estado',
    ];

    public function sala()
    {
        return $this->belongsTo(Sala::class, 'sala_id');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
