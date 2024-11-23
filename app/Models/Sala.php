<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'numero_mesas',
    ];

    public function mesas()
    {
        return $this->hasMany(Mesa::class);
    }

}
