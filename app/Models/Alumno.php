<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = 'alumno';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nombreCompleto',
        'matricula',
        'codigo',
        'telefono',
        'created_at',
        'updated_at'
    ];
}
