<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{

    protected $fillable = [
        'proveedor_id',
        'vehiculo_id',
        'cantidad',
        'fecha_compra',
        'costo_total'
    ];

    public function proveedor(){
        return $this->belongsTo(Proveedor::class);
    }
    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class);
    }

}
