<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetenciaActividad extends Model
{
    use HasFactory;

    protected $table = 'competencias_actividades';

    public $timestamps = false;

    protected $fillable = [
        'competencia_id',
        'actividad_id',
    ];


}
