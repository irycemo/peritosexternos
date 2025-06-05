<?php

namespace App\Traits;

use App\Models\File;
use App\Exceptions\GeneralException;

trait RevisarAvaluoTrait
{

    public function revisarAvaluoCompleto(){

        /* Colindancias */
        if($this->avaluo->predio->colindancias->count() === 0){

            throw new GeneralException("El avalúo no tiene colindacias.");

        }

        /* Caracteristicas */
        if(!$this->avaluo->clasificacion_zona || !$this->avaluo->construccion_dominante){

            throw new GeneralException("El avalúo no tiene definidas la clasificación de zona o el tipo de contrucción dominante.");

        }

        /* Terrenos */
        if($this->avaluo->predio->terrenosComun->count() === 0 && $this->avaluo->predio->terrenos->count() == 0){

            throw new GeneralException("El avalúo debe tener un terreno.");

        }

        /* Fotos */
        if(!File::where('avaluo_id', $this->avaluo->id)->where('descripcion', 'fachada')->first()){

            throw new GeneralException("El avalúo no tiene imagen de fachada.");

        }

        if(!File::where('avaluo_id', $this->avaluo->id)->where('descripcion', 'foto2')->first()){

            throw new GeneralException("El avalúo no tiene imagen de foto 2.");

        }

        if(!File::where('avaluo_id', $this->avaluo->id)->where('descripcion', 'foto3')->first()){

            throw new GeneralException("El avalúo no tiene imagen de foto 3.");

        }

        if(!File::where('avaluo_id', $this->avaluo->id)->where('descripcion', 'foto4')->first()){

            throw new GeneralException("El avalúo no tiene imagen de foto 4.");

        }

        if(!File::where('avaluo_id', $this->avaluo->id)->where('descripcion', 'macrolocalizacion')->first()){

            throw new GeneralException("El avalúo no tiene imagen de macrolocalización.");

        }

        if(!File::where('avaluo_id', $this->avaluo->id)->where('descripcion', 'microlocalizacion')->first()){

            throw new GeneralException("El avalúo no tiene imagen de microlocalización.");

        }

        if($this->avaluo->predio->valor_catastral == null){

            throw new GeneralException("El avalúo no tiene valor catastral.");

        }

    }

}
