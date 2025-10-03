<?php

namespace App\Traits;

use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Label\Font\OpenSans;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\Builder\Builder;

trait GeneradorQRTrait
{

    public function generadorQr($ferima_electronica)
    {

        $rute = route('verificacion', $ferima_electronica);

        $builder = new Builder(
            writer: new PngWriter(),
            writerOptions: [],
            validateResult: false,
            data: $rute,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            size: 100,
            margin: 0,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
            labelText: 'Escanea para verificar',
            labelFont: new OpenSans(7),
            labelAlignment: LabelAlignment::Center
        );

        $result = $builder->build();

        return $result->getDataUri();

    }

}
