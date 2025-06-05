<?php

namespace App\Models;

use App\Models\Predio;
use App\Models\Persona;
use App\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Propietario extends Model implements Auditable
{

    use ModelosTrait;
    use \OwenIt\Auditing\Auditable;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function predio(){
        return $this->belongsTo(Predio::class);
    }

}
