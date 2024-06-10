<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{

    protected $fillable = [
        'nombre',
        'contacto',
        'direccion',
    ];

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }
    public function piezas(){
        return $this->hasMany(Pieza::class);
    }
}
