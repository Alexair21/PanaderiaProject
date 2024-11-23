<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repartidor extends Model
{
    protected $table = 'repartidors';
    protected $fillable = [
        'licencia',
        'vehiculo',
        'personal_id',
    ];

    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

}

