<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'direccion',
        'dni',
        'cargo',
        'fecha_contrato',
        'sueldo',
        'licencia',
        'vehiculo',
        'estado',
        'usuario_id',
    ];

    public function asignaciones()
    {
        return $this->hasMany(AsignacionPedido::class, 'personal_id');
    }
}
