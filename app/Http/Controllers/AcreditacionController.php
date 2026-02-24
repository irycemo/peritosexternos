<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\FirmaElectronica;
use App\Models\User;
use App\Traits\GeneradorQRTrait;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Imagick;
use PhpCfdi\Credentials\Credential;

class AcreditacionController extends Controller
{

    use GeneradorQRTrait;

    public function generarAcreditacion(User $user){

        $director = User::where('status', 'activo')
                            ->whereHas('roles', function($q){
                                $q->where('name', 'Director general');
                            })->first();

        $object = (object)[];

        $datos_control = (object)[];

        $datos_control->perito_nombre = $user->name;
        $datos_control->perito_clave = $user->clave;
        $datos_control->perito_direccion = $user->direccion;
        $datos_control->impreso_en = now()->locale('es')->translatedFormat('l d \d\e F');

        $object->datos_control = $datos_control;

        $fielDirector = Credential::openFiles(Storage::disk('efirmas')->path($director->efirma->cer),
                                                Storage::disk('efirmas')->path($director->efirma->key),
                                                $director->efirma->contraseña
                                            );

        $firmaDirector = $fielDirector->sign(json_encode($object));

        $firma_electronica = FirmaElectronica::create([
            'estado' => 'activo',
            'cadena_original' => json_encode($object),
            'cadena_encriptada' => base64_encode($firmaDirector),
            'user_id' => $user->id,
        ]);

        $qr = $this->generadorQr($firma_electronica->uuid);

        $this->crearImagenConMarcaDeAgua($datos_control, $qr, $firma_electronica);

        $pdf = Pdf::loadView('acreditacion.acreditacion', [
            'datos_control' => $datos_control,
            'qr' => $qr,
            'firma_electronica' => $firma_electronica,
        ]);

        $pdf->render();

        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf->get_canvas();

        $canvas->page_text(480, 745, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(1, 1, 1));

        $canvas->page_text(35, 745, 'Acreditación perito: ' . $user->clave, null, 9, array(1, 1, 1));

        return $pdf;

    }

    public function reimprimirAcreditacion(FirmaElectronica $firma_electronica){

        $datos_control = json_decode($firma_electronica->cadena_original);

        $qr = $this->generadorQr($firma_electronica->uuid);

        $pdf = Pdf::loadView('acreditacion.acreditacion', [
            'datos_control' => $datos_control,
            'qr' => $qr,
            'firma_electronica' => $firma_electronica,
        ]);

        $pdf->render();

        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf->get_canvas();

        $canvas->page_text(480, 745, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(1, 1, 1));

        $canvas->page_text(35, 745, 'Acreditación perito: ' . $datos_control->perito_clave, null, 9, array(1, 1, 1));

        return $pdf;

    }

    public function crearImagenConMarcaDeAgua($datos_control, $qr, $firma_electronica){

        $pdf = Pdf::loadView('acreditacion.acreditacion', [
            'datos_control' => $datos_control,
            'qr' => $qr,
            'firma_electronica' => $firma_electronica,
        ]);

        $pdf->render();

        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf->get_canvas();

        $canvas->page_text(480, 745, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(1, 1, 1));

        $canvas->page_text(35, 745, 'Acreditación perito: ' . $datos_control->perito_clave, null, 9, array(1, 1, 1));

        $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
            $w = $canvas->get_width();
            $h = $canvas->get_height();

            $canvas->image(public_path('storage/img/watermark.png'), 0, 0, $w, $h, $resolution = "normal");

        });

        $nombre = Str::random(40);

        $nombreFinal = $nombre . '.pdf';

        Storage::disk('acreditaciones')->put($nombreFinal, $pdf->output());

        $pdfImagen = new \Spatie\PdfToImage\Pdf('acreditaciones/' . $nombreFinal);

        $all = new Imagick();

        for ($i=1; $i <= $pdfImagen->pageCount(); $i++) {

            $nombre_img = $nombre . '_' . $i . '.jpg';

            $pdfImagen->selectPage($i)->save('acreditaciones/'. $nombre_img);

            $im = new Imagick(Storage::disk('acreditaciones')->path($nombre_img));

            $all->addImage($im);

            unlink('acreditaciones/' . $nombre_img);

        }

        $all->resetIterator();
        $combined = $all->appendImages(true);
        $combined->setImageFormat("jpg");

        if(app()->isProduction()){

            Storage::disk('s3')->put(config('services.ses.ruta_acreditaciones') . $nombre . '.jpg', $combined);

        }else{

            file_put_contents("acreditaciones/" . $nombre . '.jpg', $combined);

        }

        File::create([
            'fileable_type' => 'App\Models\User',
            'fileable_id'=> $firma_electronica->user->id,
            'descripcion' => 'acreditacion',
            'url' => $nombre . '.jpg'
        ]);

        unlink('acreditaciones/' . $nombreFinal);

    }

}
