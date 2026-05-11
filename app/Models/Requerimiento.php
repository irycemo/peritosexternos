<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requerimiento extends Model
{

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getEstadoColorAttribute()
    {
        return [
            'nuevo' => 'blue-400',
            'atendido' => 'green-400',
            'finalizado' => 'gray-400',
        ][$this->estado] ?? 'gray-400';
    }

    public function requerimientoable(){
        return $this->morphTo();
    }

    public function requerimientos(){
        return $this->hasMany(Requerimiento::class, 'requerimiento_id');
    }

}
