<?php

namespace App\Models;

use App\Models\File;
use App\Models\Avaluo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class FirmaElectronica extends Model
{

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected static function boot()
    {

        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string)Str::uuid();
        });

    }

    public function getRouteKeyName(){
        return 'uuid';
    }

    public function avaluo(){
        return $this->belongsTo(Avaluo::class);
    }

    public function archivos(){
        return $this->morphMany(File::class, 'fileable');
    }

}
