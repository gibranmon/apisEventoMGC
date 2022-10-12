<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $table = 'asistencia_evento_alumno';

    protected $fillable = [
        'id', 'id_alumno', 'id_evento', 'created_at', 'updated_at'
    ];

    public static function getQuery() {
        return self::selectRaw(
            'asistencia_evento_alumno.id, alumno.nombreCompleto, alumno.matricula,
            alumno.telefono, evento.nombre, asistencia_evento_alumno.created_at'
        )
        ->leftjoin('alumno', 'alumno.id', 'asistencia_evento_alumno.id_alumno')
        ->leftjoin('evento', 'evento.id', 'asistencia_evento_alumno.id_evento');
    }
}
