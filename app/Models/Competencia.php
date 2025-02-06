<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Competencia extends Model
{
    use HasFactory;

    protected $table = 'competencias';

    protected $fillable = [
        'id',
        'nombre',
        'color'

    ];

    public static $filterColumns = ['id', 'nombre', 'color'];
}
