<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'direccion',
    ];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
