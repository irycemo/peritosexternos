<?php

namespace App\Traits;

use App\Exceptions\GeneralException;
use App\Models\Persona;

trait BuscarPersonaTrait
{

    public function buscarPersona($rfc, $curp, $tipo_persona, $nombre, $ap_materno, $ap_paterno, $razon_social):Persona|null
    {

        $persona = null;


            if(in_array($tipo_persona, ['FISICA', 'FÍSICA'])){

                $persona = Persona::query()
                            ->where('nombre', $nombre)
                            ->where('ap_paterno', $ap_paterno)
                            ->where('ap_materno', $ap_materno)
                            ->first();

            }else{

                $persona = Persona::where('razon_social', $razon_social)->first();

            }

        return $persona;

    }

}
