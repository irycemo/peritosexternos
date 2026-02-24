<?php

namespace App\Http\Controllers;

use App\Models\FirmaElectronica;
use Illuminate\Support\Facades\Storage;

class VerificacionController extends Controller
{

    public function __invoke(FirmaElectronica $firma_electronica){

        if($firma_electronica->estado != 'activo'){

            $firma_electronica->load('avaluo.predio');

            $datos_control = json_decode($firma_electronica->cadena_original);

            return view('verificacion', [
                'firma_electronica' => $firma_electronica,
                'datos_control' => $datos_control
            ]);

        }

        if($firma_electronica->avaluo){

            if(app()->isProduction()){

                return redirect(Storage::disk('s3')->temporaryUrl(config('services.ses.ruta_caratulas') . $firma_electronica->avaluo->caratula(), now()->addMinutes(10)));

            }else{

                return redirect(Storage::disk('caratulas')->url($firma_electronica->avaluo->caratula()));

            }

        }elseif($firma_electronica->user){

            if(app()->isProduction()){

                return redirect(Storage::disk('s3')->temporaryUrl(config('services.ses.ruta_acreditaciones') . $firma_electronica->user->acreditacionUrl->url, now()->addMinutes(10)));

            }else{

                return redirect(Storage::disk('acreditaciones')->url($firma_electronica->user->acreditacionUrl->url));

            }

        }

    }

}
