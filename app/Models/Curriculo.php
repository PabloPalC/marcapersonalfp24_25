<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculo extends Model
{

    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'video_curriculum',
        'texto_curriculum'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id', 'users');
    }

    /*
    public function user()
    {
        return $this->belongsTo(User::class); Tambien es posible hacerlo de esta manera ya que laravel asume que la clave foranea es user_id
                                                porque se lo indicamos en la relacion de la tabla users.
    }
        */
        public static $filterColumns = [
            'video_curriculum',
            'texto_curriculum'
        ];
}
