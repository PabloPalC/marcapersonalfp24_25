<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Competencia extends Model
{
    use HasFactory;

    protected $table = 'competencias_actividades';

    protected $fillable = [
        'actividad_id',
        'competencia_id'

    ];

    public static $filterColumns = ['actividad_id', 'competencia_id'];

    public function actividades() : BelongsToMany
    {
        return $this->belongsToMany(Actividad::class, 'competencias_actividades', 'competencia_id', 'actividad_id');
    }

    public function competencias() : BelongsToMany
    {
        return $this->belongsToMany(Competencia::class, 'competencias_actividades', 'actividad_id', 'competencia_id');
    }
}
