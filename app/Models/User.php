<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\File;
use App\Models\Pregunta;
use App\Models\Refrendo;
use App\Traits\ModelosTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Auditable, MustVerifyEmail
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use ModelosTrait;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
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
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
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

    public function preguntasLeidas(){
        return $this->belongsToMany(Pregunta::class);
    }

    public function refrendos(){
        return $this->hasMany(Refrendo::class);
    }

    public function imagenes(){
        return $this->morphMany(File::class, 'fileable');
    }

    public function ineFrente(){
        return $this->morphOne(File::class, 'fileable')->where('descripcion', 'ineFrente');
    }

    public function ineReverso(){
        return $this->morphOne(File::class, 'fileable')->where('descripcion', 'ineReverso');
    }

    public function cedulaProfesional(){
        return $this->morphOne(File::class, 'fileable')->where('descripcion', 'cedulaProfesional');
    }

    public function cedulaEspecialidad(){
        return $this->morphOne(File::class, 'fileable')->where('descripcion', 'cedulaEspecialidad');
    }

}
