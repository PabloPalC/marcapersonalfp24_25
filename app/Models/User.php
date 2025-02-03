<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nombre',
        'apellidos',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /* public function curriculo()
    {
        return $this->hasOne(Curriculo::class); Tambien es posible hacerlo de esta manera ya que laravel asume que la clave foranea es user_id
                                                porque se lo indicamos en la relacion de la tabla curriculos.
    }
    */

    public function curriculo()
    {
        return $this->hasOne(Curriculo::class, 'user_id', 'id');
    }

    public static $filterColumns = ['name', 'nombre', 'apellidos', 'email'];
}
