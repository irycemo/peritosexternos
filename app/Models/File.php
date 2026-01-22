<?php

namespace App\Models;

use App\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{

    use ModelosTrait;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function fileable(){
        return $this->morphTo();
    }

    public function getLink(){

        if(app()->isProduction()){

            return Storage::disk('s3')->temporaryUrl(config('services.ses.ruta_archivos') . $this->url, now()->addMinutes(10));

        }else{

            return Storage::disk('avaluos')->url($this->url);

        }

    }

}
