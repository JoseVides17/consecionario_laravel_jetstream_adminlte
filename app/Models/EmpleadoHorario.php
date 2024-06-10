<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpleadoHorario extends Model
{

    protected $fillable = [
        'empleado_id',
        'horario_id'
    ];

    public function empleado(){
        return $this->belongsTo(Empleado::class);
    }
    public function horarioTrabajo(){
        return $this->belongsTo(HorarioTrabajo::class);
    }
}
