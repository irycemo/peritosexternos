<?php

namespace App\Models;

use App\Models\Avaluo;
use App\Models\Terreno;
use App\Models\Colindancia;
use App\Models\Propietario;
use App\Models\Construccion;
use App\Traits\ModelosTrait;
use App\Models\Condominioterreno;
use App\Models\Condominiocontruccion;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Predio extends Model implements Auditable
{

    use HasFactory;
    use ModelosTrait;
    use \OwenIt\Auditing\Auditable;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function propietarios(){
        return $this->hasMany(Propietario::class);
    }

    public function condominioTerrenos(){
        return $this->hasMany(Condominioterreno::class);
    }

    public function condominioConstrucciones(){
        return $this->hasMany(Condominiocontruccion::class);
    }

    public function terrenos(){
        return $this->hasMany(Terreno::class);
    }

    public function construcciones(){
        return $this->hasMany(Construccion::class);
    }

    public function colindancias(){
        return $this->hasMany(Colindancia::class);
    }

    public function avaluo(){
        return $this->hasOne(Avaluo::class, 'predio_id');
    }

    public function cuentaPredial(){

        return $this->localidad . '-' . $this->oficina . '-' . $this->tipo_predio . '-' . $this->numero_registro;

    }

    public function claveCatastral(){

        return $this->estado . '-' . $this->region_catastral . '-' . $this->municipio . '-' . $this->zona_catastral . '-' . $this->localidad . '-' . $this->sector . '-' . $this->manzana . '-' . $this->predio . '-' . $this->edificio . '-' . $this->departamento;

    }

    public function primerPropietario(){

        if($this->propietarios()->first())
            return $this->propietarios()->first()->persona->nombre . ' ' . $this->propietarios()->first()->persona->ap_paterno . ' ' . $this->propietarios()->first()->persona->ap_materno;
        else
            return null;
    }

}
