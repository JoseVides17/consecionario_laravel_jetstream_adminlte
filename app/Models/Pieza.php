<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pieza extends Model
{

    protected $fillable = [
        'nombre',
        'proveedor_id',
        'cantidad',
        'precio_unitario'
    ];
    public function proveedor(){
        return $this->belongsTo(Proveedor::class);
    }

    public function compraPiezas(){
        return $this->hasMany(CompraPieza::class);
    }
}
