<?php

namespace App\Livewire\Valuacion;

use App\Models\File;
use App\Models\Avaluo;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Traits\ComponentesTrait;
use Endroid\QrCode\Builder\Builder;
use Illuminate\Support\Facades\Log;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;

class MisAvaluos extends Component
{

    use ComponentesTrait;
    use WithPagination;

    public Avaluo $modelo_editar;

    public $avaluo;

    public function crearModeloVacio(){
        return Avaluo::make();
    }

    public function revisar(){

        /* Colindancias */
        if($this->avaluo->predio->colindancias->count() === 0){

            $this->dispatch('mostrarMensaje', ['error', "El avalúo no tiene colindacias."]);

            return true;

        }

        /* Caracteristicas */
        if(!$this->avaluo->clasificacion_zona || !$this->avaluo->construccion_dominante){

            $this->dispatch('mostrarMensaje', ['error', "El avalúo no tiene definidas la clasificación de zona o el tipo de contrucción dominante."]);

            return true;

        }

        /* Terrenos */
        if($this->avaluo->predio->edificio == 0 && $this->avaluo->predio->terrenos->count() == 0){

            $this->dispatch('mostrarMensaje', ['error', "El avalúo no tiene terrenos."]);

            return true;

        }

        /* Terrenos  comun*/
        if($this->avaluo->predio->edificio != 0 && $this->avaluo->predio->condominioTerrenos->count() === 0){

            $this->dispatch('mostrarMensaje', ['error', "El avalúo no tiene terrenos de área común."]);

            return true;

        }

        /* Construcciones comun*/
        if($this->avaluo->predio->edificio != 0 && $this->avaluo->predio->condominioConstrucciones->count() === 0){

            $this->dispatch('mostrarMensaje', ['error', "El avalúo no tiene construcciones de área común."]);

            return true;

        }


        /* Fotos */
        $fachada = File::where('fileable_type', 'App\Models\Avaluo')->where('descripcion', 'fachada')->where('fileable_id', $this->avaluo->id)->get();

        if($fachada->count() === 0){

            $this->dispatch('mostrarMensaje', ['error', "El avalúo no tiene imagen de fachada."]);

            return true;

        }

        $foto2 = File::where('fileable_type', 'App\Models\Avaluo')->where('descripcion', 'foto2')->where('fileable_id', $this->avaluo->id)->get();

        if($foto2->count() === 0){

            $this->dispatch('mostrarMensaje', ['error', "El avalúo no tiene imagen en la fotografía 2."]);

            return true;

        }

        $foto3 = File::where('fileable_type', 'App\Models\Avaluo')->where('descripcion', 'foto3')->where('fileable_id', $this->avaluo->id)->get();

        if($foto3->count() === 0){

            $this->dispatch('mostrarMensaje', ['error', "El avalúo no tiene imagen en la fotografía 3."]);

            return true;

        }

        $foto4 = File::where('fileable_type', 'App\Models\Avaluo')->where('descripcion', 'foto4')->where('fileable_id', $this->avaluo->id)->get();

        if($foto4->count() === 0){

            $this->dispatch('mostrarMensaje', ['error', "El avalúo no tiene imagen en la fotografía 4."]);

            return true;

        }

        $macrolocalizacion = File::where('fileable_type', 'App\Models\Avaluo')->where('descripcion', 'macrolocalizacion')->where('fileable_id', $this->avaluo->id)->get();

        if($macrolocalizacion->count() === 0){

            $this->dispatch('mostrarMensaje', ['error', "El avalúo no tiene imagen de la macrolocalización."]);

            return true;

        }

        $microlocalizacion = File::where('fileable_type', 'App\Models\Avaluo')->where('descripcion', 'microlocalizacion')->where('fileable_id', $this->avaluo->id)->get();

        if($microlocalizacion->count() === 0){

            $this->dispatch('mostrarMensaje', ['error', "El avalúo no tiene imagen de la microlocalización."]);

            return true;

        }

        if($this->avaluo->predio->valor_catastral == null){

            $this->dispatch('mostrarMensaje', ['error', "El avalúo no tiene valor catastral."]);

            return true;

        }

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

    public function imprimir(Avaluo $avaluo){

        $this->avaluo = $avaluo;

        if($this->revisar()) return;

        try {

            $qr = $this->generadorQr();

            $pdf = Pdf::loadView('avaluos.avaluo', ['predio' => $this->avaluo->predio, 'qr' => $qr]);

            $pdf->render();

            $dom_pdf = $pdf->getDomPDF();

            $canvas = $dom_pdf->get_canvas();

            $canvas->page_text(480, 794, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(1, 1, 1));

            $canvas->page_text(35, 794, "Avalúo: " . $this->avaluo->año . "-" . $this->avaluo->folio , null, 10, array(1, 1, 1));

            $pdf = $dom_pdf->output();

            if($this->avaluo->estado === 'nuevo'){

                $this->avaluo->update(['estado' => 'impreso']);

            }

            return response()->streamDownload(
                fn () => print($pdf),
                'avaluo.pdf'
            );

        } catch (\Throwable $th) {

            Log::error("Error al crear avalúo por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);

        }
    }

    public function concluirAvaluo(Avaluo $avaluo){

        $this->avaluo = $avaluo;

        if($this->revisar()) return;

        try {

            $avaluo->update(['estado' => 'concluido']);

        } catch (\Throwable $th) {

            Log::error("Error al concluir avalúo por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);

        }

    }

    public function render()
    {

        $avaluos = Avaluo::with('predio.propietarios.persona', 'creadoPor', 'actualizadoPor')
                            ->where('creado_por', auth()->id())
                            ->orderBy($this->sort, $this->direction)
                            ->paginate($this->pagination);

        return view('livewire.valuacion.mis-avaluos', compact('avaluos'))->extends('layouts.admin');
    }
}
