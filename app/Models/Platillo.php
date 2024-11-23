<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Platillo extends Model
{
    protected $table = 'platillos';
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen',
        'estado',
        'categoria_id',
        'destacado'
    ];


    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function subcategoria()
    {
        return $this->belongsTo(SubCategoria::class, 'subcategoria_id');
    }
}
