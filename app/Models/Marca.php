<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{

    protected $fillable = [
        'marca'
    ];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class);
    }

    public function modelos()
    {
        return $this->hasMany(Modelo::class);
    }
}
