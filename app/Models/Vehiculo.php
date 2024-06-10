<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{

    protected  $fillable = [
        'marca_id',
        'modelo_id',
        'color',
        'año',
        'precio',
        'kilometraje',
        'estado',
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }

    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }

    public function ventas(){
        return $this->hasMany(Venta::class);
    }

    public function reclamaciones()
    {
        return $this->hasMany(Reclamacion::class);
    }
}
