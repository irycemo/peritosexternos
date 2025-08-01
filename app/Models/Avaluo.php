<?php

namespace App\Models;

use App\Models\File;
use App\Models\User;
use App\Models\Predio;
use Illuminate\Support\Str;
use App\Traits\ModelosTrait;
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
            'recibido' => 'yellow-400',
            'concluido' => 'green-400',
        ][$this->estado] ?? 'gray-400';
    }

    public function predio(){
        return $this->belongsTo(Predio::class, 'predio_id');
    }

    public function asignadoA(){
        return $this->belongsTo(User::class, 'asignado_a');
    }

    public function imagenes(){
        return $this->hasMany(File::class);
    }

    public function encabezado(){

        $encabezado = $this->imagenes()->where('descripcion', 'encabezado')->first();

        if(config('services.ses.flag')){

            Storage::disk('s3')->temporaryUrl('peritosexternos/avaluos/' . $encabezado->url, now()->addMinutes(10));

        }else{

            return $encabezado
                ? Storage::disk('avaluos')->url($encabezado->url)
                : Storage::disk('public')->url('img/logo.png');
            ;

        }

    }

    public function fachada(){

        $fachada = $this->imagenes()->where('descripcion', 'fachada')->first();

        if(config('services.ses.flag')){

            Storage::disk('s3')->temporaryUrl('peritosexternos/avaluos/' . $fachada->url, now()->addMinutes(10));

        }else{

            return $fachada
                ? Storage::disk('avaluos')->url($fachada->url)
                : Storage::disk('public')->url('img/logo.png');
            ;

        }

    }

    public function fachada_pdf(){

        $fachada = $this->imagenes()->where('descripcion', 'fachada')->first();

        if(config('services.ses.flag')){

            Storage::disk('s3')->temporaryUrl('peritosexternos/avaluos/' . $fachada->url, now()->addMinutes(10));

        }else{

            return $fachada
                ? 'avaluos/' . $fachada->url
                : 'storage/img/escudo_guinda.png';

        }


    }

    public function foto2(){

        $foto2 = $this->imagenes()->where('descripcion', 'foto2')->first();

        if(config('services.ses.flag')){

            Storage::disk('s3')->temporaryUrl('peritosexternos/avaluos/' . $foto2->url, now()->addMinutes(10));

        }else{

            return $foto2
                ? Storage::disk('avaluos')->url($foto2->url)
                : Storage::disk('public')->url('img/logo.png');
            ;

        }

    }

    public function foto2_pdf(){

        $foto2 = $this->imagenes()->where('descripcion', 'foto2')->first();

        if(config('services.ses.flag')){

            Storage::disk('s3')->temporaryUrl('peritosexternos/avaluos/' . $foto2->url, now()->addMinutes(10));

        }else{

            return $foto2
                ? 'avaluos/' . $foto2->url
                : 'storage/img/escudo_guinda.png';

        }

    }

    public function foto3(){

        $foto3 = $this->imagenes()->where('descripcion', 'foto3')->first();

        if(config('services.ses.flag')){

            Storage::disk('s3')->temporaryUrl('peritosexternos/avaluos/' . $foto3->url, now()->addMinutes(10));

        }else{

            return $foto3
                ? Storage::disk('avaluos')->url($foto3->url)
                : Storage::disk('public')->url('img/logo.png');
            ;

        }


    }

    public function foto3_pdf(){

        $foto3 = $this->imagenes()->where('descripcion', 'foto3')->first();

        if(config('services.ses.flag')){

            Storage::disk('s3')->temporaryUrl('peritosexternos/avaluos/' . $foto3->url, now()->addMinutes(10));

        }else{

            return $foto3
                ? 'avaluos/' . $foto3->url
                : 'storage/img/escudo_guinda.png';

        }

    }

    public function foto4(){

        $foto4 = $this->imagenes()->where('descripcion', 'foto4')->first();

        if(config('services.ses.flag')){

            Storage::disk('s3')->temporaryUrl('peritosexternos/avaluos/' . $foto4->url, now()->addMinutes(10));

        }else{

            return $foto4
                ? Storage::disk('avaluos')->url($foto4->url)
                : Storage::disk('public')->url('img/logo.png');
            ;

        }

    }

    public function foto4_pdf(){

        $foto4 = $this->imagenes()->where('descripcion', 'foto4')->first();

        if(config('services.ses.flag')){

            Storage::disk('s3')->temporaryUrl('peritosexternos/avaluos/' . $foto4->url, now()->addMinutes(10));

        }else{

            return $foto4
                ? 'avaluos/' . $foto4->url
                : 'storage/img/escudo_guinda.png';

        }

    }

    public function macrolocalizacion(){

        $macrolocalizacion = $this->imagenes()->where('descripcion', 'macrolocalizacion')->first();

        if(config('services.ses.flag')){

            Storage::disk('s3')->temporaryUrl('peritosexternos/avaluos/' . $macrolocalizacion->url, now()->addMinutes(10));

        }else{

            return $macrolocalizacion
                ? Storage::disk('avaluos')->url($macrolocalizacion->url)
                : Storage::disk('public')->url('img/logo.png');
            ;

        }

    }

    public function macrolocalizacion_pdf(){

        $macrolocalizacion = $this->imagenes()->where('descripcion', 'macrolocalizacion')->first();

        if(config('services.ses.flag')){

            Storage::disk('s3')->temporaryUrl('peritosexternos/avaluos/' . $macrolocalizacion->url, now()->addMinutes(10));

        }else{

            return $macrolocalizacion
                ? 'avaluos/' . $macrolocalizacion->url
                : 'storage/img/escudo_guinda.png';

        }

    }

    public function microlocalizacion(){

        $microlocalizacion = $this->imagenes()->where('descripcion', 'microlocalizacion')->first();

        if(config('services.ses.flag')){

            Storage::disk('s3')->temporaryUrl('peritosexternos/avaluos/' . $microlocalizacion->url, now()->addMinutes(10));

        }else{

            return $microlocalizacion
                ? Storage::disk('avaluos')->url($microlocalizacion->url)
                : Storage::disk('public')->url('img/logo.png');
            ;

        }

    }

    public function microlocalizacion_pdf(){

        $microlocalizacion = $this->imagenes()->where('descripcion', 'microlocalizacion')->first();

        if(config('services.ses.flag')){

            Storage::disk('s3')->temporaryUrl('peritosexternos/avaluos/' . $microlocalizacion->url, now()->addMinutes(10));

        }else{

            return $microlocalizacion
                ? 'avaluos/' . $microlocalizacion->url
                : 'storage/img/escudo_guinda.png';

        }

    }

    public function poligonoImagen(){

        $poligonoImagen = $this->imagenes()->where('descripcion', 'poligonoImagen')->first();

        if(config('services.ses.flag')){

            Storage::disk('s3')->temporaryUrl('peritosexternos/avaluos/' . $poligonoImagen->url, now()->addMinutes(10));

        }else{

            return $poligonoImagen
                ? Storage::disk('avaluos')->url($poligonoImagen->url)
                : Storage::disk('public')->url('img/logo.png');
            ;

        }

    }

    public function poligonoImagen_pdf(){

        $poligonoImagen = $this->imagenes()->where('descripcion', 'poligonoImagen')->first();

        if(config('services.ses.flag')){

            Storage::disk('s3')->temporaryUrl('peritosexternos/avaluos/' . $poligonoImagen->url, now()->addMinutes(10));

        }else{

            return $poligonoImagen
                ? 'avaluos/' . $poligonoImagen->url
                : 'storage/img/escudo_guinda.png';

        }

    }

}
