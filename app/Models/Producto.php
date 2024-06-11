<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'stock',
        'precio',
        'imagen',
        'categoria_id'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function precios()
    {
        return $this->hasMany(Precio::class);
    }

    protected $table = 'productos';

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}
