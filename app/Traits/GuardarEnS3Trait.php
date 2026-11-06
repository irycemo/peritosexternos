<?php

namespace App\Traits;

use App\Models\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Avaluo;

trait GuardarEnS3Trait
{

    private function guardarEnS3(Avaluo $avaluo, $pdf): void
    {

        $filename = 'avaluo_' . $avaluo->folioAvaluo() . '_' . now()->format('Ymd_His') . '.pdf';

        $clave = config('services.ses.ruta_pdfs') . $filename;

        if(app()->isProduction()){

            Storage::disk('s3')->put(
                $clave,
                $pdf->output(),
                [
                    'ContentType' => 'application/pdf',
                    'ContentDisposition' => 'attachment; filename="' . $filename . '"',
                ]
            );

        }else{

            Storage::put('pdfs/' . $filename, $pdf->output());

        }

        File::create([
            'fileable_type' => Avaluo::class,
            'fileable_id' => $avaluo->id,
            'url' => $filename,
            'descripcion' => 'pdf',
        ]);

    }

}
