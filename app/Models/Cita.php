<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{

    protected $fillable = [
        'cliente_id',
        'servicio_id',
        'fecha_cita',
        'hora_cita',
        'estado'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function servicio(){
        return $this->belongsTo(Servicio::class);
    }
}
