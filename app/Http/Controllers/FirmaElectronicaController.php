<?php

namespace App\Http\Controllers;

use App\Exceptions\GeneralException;
use Imagick;
use App\Models\File;
use App\Models\Avaluo;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\FirmaElectronica;
use App\Traits\GeneradorQRTrait;
use App\Traits\AvaluoCadenaTrait;
use PhpCfdi\Credentials\Credential;
use Illuminate\Support\Facades\Storage;

class FirmaElectronicaController extends Controller
{

    use AvaluoCadenaTrait;
    use GeneradorQRTrait;

    public function firmarElectronicamente(Avaluo $avaluo, string $cer, string $key, string $password){

        $this->resetCaratula($avaluo);

        try {

            $fiel = Credential::openFiles(
                $cer,
                $key,
                $password
            );

        } catch (\Throwable $th) {

            throw new GeneralException('Error al procesar firma elecrónica, favor de verificar los archivos o contraseña.');

        }

        $object = (object)[];

        $datos_control = (object)[];

        $datos_control->impreso_en = now()->format('d/m/Y H:i:s');
        $datos_control->valuador = auth()->user()->name;

        $object->datos_control = $datos_control;
        $object->avaluo = $this->crearCadena($avaluo);

        $firma = $fiel->sign(json_encode($object));

        $firma_electronica = FirmaElectronica::create([
            'estado' => 'activo',
            'cadena_original' => json_encode($object),
            'cadena_encriptada' => base64_encode($firma),
            'avaluo_id' => $avaluo->id,
        ]);

        $qr = $this->generadorQr($firma_electronica->uuid);

        $this->crearImagenConMarcaDeAgua($object, $qr, $firma_electronica);

        $pdf = Pdf::loadView('avaluos.avaluo', [
            'datos_control' => $datos_control,
            'avaluo' => $object->avaluo,
            'predio' => $avaluo->predio,
            'qr' => $qr,
            'firma_electronica' => $firma_electronica,
            'fachada' => $avaluo->fachada(),
            'foto2' => $avaluo->foto2(),
            'foto3' => $avaluo->foto3(),
            'foto4' => $avaluo->foto4(),
            'macrolocalizacion' => $avaluo->macrolocalizacion(),
            'microlocalizacion' => $avaluo->microlocalizacion(),
            'poligonoImagen' => $avaluo->poligonoImagen(),
        ]);

        $pdf->render();

        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf->get_canvas();

        $canvas->page_text(480, 745, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(1, 1, 1));

        $canvas->page_text(35, 745, 'Avalúo - ' . $avaluo->año .'-' . $avaluo->folio .'-' . $avaluo->usuario, null, 9, array(1, 1, 1));

        return $pdf;

    }

    public function reimprimirAvaluo(FirmaElectronica $firma_electronica){

        $object = json_decode($firma_electronica->cadena_original);

        $qr = $this->generadorQr($firma_electronica->uuid);

        $pdf = Pdf::loadView('avaluos.avaluo', [
            'datos_control' => $object->datos_control,
            'qr' => $qr,
            'predio' => $firma_electronica->avaluo->predio,
            'avaluo' => $object->avaluo,
            'firma_electronica' => $firma_electronica,
            'fachada' => $firma_electronica->avaluo->fachada(),
            'foto2' => $firma_electronica->avaluo->foto2(),
            'foto3' => $firma_electronica->avaluo->foto3(),
            'foto4' => $firma_electronica->avaluo->foto4(),
            'macrolocalizacion' => $firma_electronica->avaluo->macrolocalizacion(),
            'microlocalizacion' => $firma_electronica->avaluo->microlocalizacion(),
            'poligonoImagen' => $firma_electronica->avaluo->poligonoImagen(),
        ]);

        $pdf->render();

        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf->get_canvas();

        $canvas->page_text(480, 745, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(1, 1, 1));

        $canvas->page_text(35, 745, 'Avalúo' . '-' . $object->avaluo->año .'-' .$object->avaluo->folio . '-' . $object->avaluo->usuario, null, 9, array(1, 1, 1));

        return $pdf;

    }

    public function crearImagenConMarcaDeAgua($object, $qr, $firma_electronica){

        $pdf = Pdf::loadView('avaluos.avaluo', [
            'datos_control' => $object->datos_control,
            'qr' => $qr,
            'predio' => $firma_electronica->avaluo->predio,
            'avaluo' => $object->avaluo,
            'firma_electronica' => $firma_electronica,
            'fachada' => $firma_electronica->avaluo->fachada(),
            'foto2' => $firma_electronica->avaluo->foto2(),
            'foto3' => $firma_electronica->avaluo->foto3(),
            'foto4' => $firma_electronica->avaluo->foto4(),
            'macrolocalizacion' => $firma_electronica->avaluo->macrolocalizacion(),
            'microlocalizacion' => $firma_electronica->avaluo->microlocalizacion(),
            'poligonoImagen' => $firma_electronica->avaluo->poligonoImagen(),
        ]);

        $pdf->render();

        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf->get_canvas();

        $canvas->page_text(480, 745, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(1, 1, 1));

        $canvas->page_text(35, 745, $object->avaluo->año .'-' .$object->avaluo->folio . '-' . $object->avaluo->usuario, null, 9, array(1, 1, 1));

        $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
            $w = $canvas->get_width();
            $h = $canvas->get_height();

            $canvas->image(public_path('storage/img/watermark.png'), 0, 0, $w, $h, $resolution = "normal");

        });

        $nombre = Str::random(40);

        $nombreFinal = $nombre . '.pdf';

        Storage::disk('avaluos')->put($nombreFinal, $pdf->output());

        $pdfImagen = new \Spatie\PdfToImage\Pdf('avaluos/' . $nombreFinal);

        $all = new Imagick();

        for ($i=1; $i <= $pdfImagen->pageCount(); $i++) {

            $nombre_img = $nombre . '_' . $i . '.jpg';

            $pdfImagen->selectPage($i)->save('avaluos/'. $nombre_img);

            $im = new Imagick(Storage::disk('avaluos')->path($nombre_img));

            $all->addImage($im);

            unlink('avaluos/' . $nombre_img);

        }

        $all->resetIterator();
        $combined = $all->appendImages(true);
        $combined->setImageFormat("jpg");

        if(app()->isProduction()){

            Storage::disk('s3')->put(config('services.ses.ruta_caratulas') . $nombre . '.jpg', $combined);

        }else{

            file_put_contents("caratulas/" . $nombre . '.jpg', $combined);

        }

        File::create([
            'avaluo_id' => $firma_electronica->avaluo->id,
            'descripcion' => 'avaluo',
            'url' => $nombre . '.jpg'
        ]);

        unlink('avaluos/' . $nombreFinal);

    }

}
