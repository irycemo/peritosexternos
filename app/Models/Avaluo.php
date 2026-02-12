<?php

namespace App\Models;

use App\Models\File;
use App\Models\User;
use App\Models\Bloque;
use App\Models\Predio;
use Illuminate\Support\Str;
use App\Traits\ModelosTrait;
use App\Models\FirmaElectronica;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use OwenIt\Auditing\Contracts\Auditable;

class Avaluo extends Model implements Auditable
{

    use ModelosTrait;
    use \OwenIt\Auditing\Auditable;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public static function boot() {

        parent::boot();

        static::creating(function($model){

            foreach ($model->attributes as $key => $value) {

                if(is_null($value)) continue;

                $model->{$key} = trim($value);

                $model->{$key} = $value === '' ? null : $value;
            }

            $model->uuid = (string)Str::uuid();

        });

        static::updating(function($model){

            foreach ($model->attributes as $key => $value) {

                if(is_null($value)) continue;

                $model->{$key} = trim($value);

                $model->{$key} = $value === '' ? null : $value;
            }

        });

    }

    public function getEstadoColorAttribute()
    {
        return [
            'nuevo' => 'blue-400',
            'impreso' => 'red-400',
            'operado' => 'gray-400',
            'conciliar' => 'yellow-400',
            'concluido' => 'green-400',
        ][$this->estado] ?? 'gray-400';
    }

    public function predio(){
        return $this->belongsTo(Predio::class, 'predio_id');
    }

    public function imagenes(){
        return $this->morphMany(File::class, 'fileable');
    }

    public function bloques(){
        return $this->hasMany(Bloque::class);
    }

    public function firmaElectronica(){
        return $this->hasOne(FirmaElectronica::class)->where('estado', 'activo');
    }

    public function caratula(){
        return $this->imagenes()->where('descripcion', 'avaluo')->first()->url;
    }


    public function fachada(){

        $fachada = $this->imagenes()->where('descripcion', 'fachada')->first();

        return $fachada
            ? Storage::disk('avaluos')->url($fachada->url)
            : Storage::disk('public')->url('img/escudo_guinda.png');

    }

    public function foto2(){

        $foto2 = $this->imagenes()->where('descripcion', 'foto2')->first();

        return $foto2
            ? Storage::disk('avaluos')->url($foto2->url)
            : Storage::disk('public')->url('img/logo.png');

    }

    public function foto3(){

        $foto3 = $this->imagenes()->where('descripcion', 'foto3')->first();

        return $foto3
            ? Storage::disk('avaluos')->url($foto3->url)
            : Storage::disk('public')->url('img/logo.png');

    }

    public function foto4(){

        $foto4 = $this->imagenes()->where('descripcion', 'foto4')->first();

        return $foto4
            ? Storage::disk('avaluos')->url($foto4->url)
            : Storage::disk('public')->url('img/logo.png');

    }

    public function macrolocalizacion(){

        $macrolocalizacion = $this->imagenes()->where('descripcion', 'macrolocalizacion')->first();

        return $macrolocalizacion
                ? Storage::disk('avaluos')->url($macrolocalizacion->url)
                : Storage::disk('public')->url('img/logo.png');

    }

    public function microlocalizacion(){

        $microlocalizacion = $this->imagenes()->where('descripcion', 'microlocalizacion')->first();

        return $microlocalizacion
                ? Storage::disk('avaluos')->url($microlocalizacion->url)
                : Storage::disk('public')->url('img/logo.png');

    }

    public function poligonoImagen(){

        $poligonoImagen = $this->imagenes()->where('descripcion', 'poligonoImagen')->first();

        return $poligonoImagen
            ? $poligonoImagen->getLink()
            : Storage::disk('public')->url('img/logo.png');

    }

    public function poligonoDwg(){

        $poligonoDwg = $this->imagenes()->where('descripcion', 'poligonoDwg')->first();

        return $poligonoDwg?->getLink();

    }

    public function anexo(){

        $anexo = $this->imagenes()->where('descripcion', 'anexo')->first();

        return $anexo?->getLink();

    }

}
