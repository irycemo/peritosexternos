<?php

namespace App\Models;

use App\Models\Avaluo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function creadoPor(){
        return $this->belongsTo(User::class, 'creado_por');
    }

    public function getCreatedAtAttribute(){
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->format('d-m-Y H:i:s');
    }

    public function getUpdatedAtAttribute(){
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['updated_at'])->format('d-m-Y H:i:s');
    }

    public function avaluo(){
        return $this->belongsTo(Avaluo::class);
    }

}
