<?php

namespace App\Models;

use App\Models\Predio;
use App\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Model;

class Colindancia extends Model{

    use ModelosTrait;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function predio(){
        return $this->belongsTo(Predio::class);
    }

}
