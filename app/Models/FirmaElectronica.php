<?php

namespace App\Models;

use App\Models\Avaluo;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public function user(){
        return $this->belongsTo(User::class);
    }

}
