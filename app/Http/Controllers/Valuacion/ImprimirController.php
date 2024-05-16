<?php

namespace App\Http\Controllers\Valuacion;

use App\Models\Predio;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Endroid\QrCode\Builder\Builder;
use App\Http\Controllers\Controller;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Label\Font\NotoSans;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;


class ImprimirController extends Controller
{

    public function imprime($predio)
    {

        $qr = $this->generadorQr();

        $pdf = Pdf::loadView('avaluos.avaluo', compact('qr', 'predio'));

        $pdf->render();

        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf->get_canvas();

        $canvas->page_text(280, 810, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        $pdf = $dom_pdf->output();

        Storage::put('avaluos_pdf/'. $predio->avaluo->folio . '.pdf', $pdf);

        return 'app/avaluos_pdf/'. $predio->avaluo->folio . '.pdf';



    }

    public function generadorQr()
    {

        $result = Builder::create()
                            ->writer(new PngWriter())
                            ->writerOptions([])
                            ->data('https://irycem.michoacan.gob.mx/')
                            ->encoding(new Encoding('UTF-8'))
                            ->errorCorrectionLevel(ErrorCorrectionLevel::High)
                            ->size(100)
                            ->margin(0)
                            ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
                            ->labelText('Escanea para verificar')
                            ->labelFont(new NotoSans(7))
                            ->labelAlignment(LabelAlignment::Center)
                            ->validateResult(false)
                            ->build();

        return $result->getDataUri();
    }

    public function test($id)
    {

        $predio = Predio::find($id);

        $qr = $this->generadorQr();

        $pdf = Pdf::loadView('avaluos.avaluo', compact('qr', 'predio'));

        $pdf->render();

        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf->get_canvas();

        $canvas->page_text(280, 810, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('documento.pdf');
    }

}
