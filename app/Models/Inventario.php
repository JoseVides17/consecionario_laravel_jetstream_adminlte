<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{

    protected $fillable = [
        'vehiculo_id',
        'cantidad'
    ];

    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class);
    }
}
