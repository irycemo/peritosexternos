<?php

namespace App\Models;

use App\Models\Avaluo;
use Illuminate\Database\Eloquent\Model;

class Bloque extends Model
{

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function avaluo(){
        return $this->belongsTo(Avaluo::class);
    }

}
