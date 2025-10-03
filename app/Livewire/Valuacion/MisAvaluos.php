<?php

namespace App\Livewire\Valuacion;

use App\Models\Avaluo;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Traits\ComponentesTrait;
use Livewire\Attributes\Computed;
use App\Traits\RevisarAvaluoTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exceptions\GeneralException;
use App\Http\Controllers\AvaluoController;
use App\Http\Controllers\FirmaElectronicaController;
use App\Models\FirmaElectronica;

class MisAvaluos extends Component
{

    use ComponentesTrait;
    use WithPagination;
    use RevisarAvaluoTrait;
    use WithFileUploads;


    public Avaluo $modelo_editar;

    public $avaluo;

    public $modalConcluir = false;

    public $contraseña;
    public $cer;
    public $key;

    public function crearModeloVacio(){
        return Avaluo::make();
    }

    public function abrirModalConcluir(Avaluo $avaluo){

        $this->avaluo = $avaluo;

        $this->modalConcluir = true;

    }

    public function imprimir(Avaluo $avaluo){

        $this->avaluo = $avaluo;

        try {

            $this->revisarAvaluoCompleto();

            if($this->avaluo->estado === 'nuevo'){

                $this->avaluo->update(['estado' => 'impreso']);

            }

            $pdf = (new AvaluoController())->avaluo($this->avaluo->predio);

            return response()->streamDownload(
                fn () => print($pdf->output()),
                'avalúo-' .$this->avaluo->predio->localidad . '-' . $this->avaluo->predio->oficina. '-' . $this->avaluo->predio->tipo_predio . '-'. $this->avaluo->predio->numero_registro. '.pdf'
            );

        } catch (GeneralException $ex) {

            $this->dispatch('mostrarMensaje', ['warning', $ex->getMessage()]);

        } catch (\Throwable $th) {

            Log::error("Error al crear avalúo por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);

        }

    }

    public function reactivarAvaluo(Avaluo $avaluo){

        try {

            $avaluo->update(['estado' => 'nuevo']);

            $this->dispatch('mostrarMensaje', ['success', 'Avalúo reactivado']);

        } catch (GeneralException $ex) {

            $this->dispatch('mostrarMensaje', ['warning', $ex->getMessage()]);

        } catch (\Throwable $th) {

            Log::error("Error al crear avalúo por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);

        }

    }

    public function reimprimir(FirmaElectronica $firma_electronica){

        try {

            $pdf = (new FirmaElectronicaController())->reimprimirAvaluo($firma_electronica);

            return response()->streamDownload(
                fn () => print($pdf->output()),
                $firma_electronica->avaluo->predio->cuentaPredial() . '-certificado_de_registro.pdf'
            );

        } catch (\Throwable $th) {

            Log::error("Error al reimprimir avalúo por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);

        }

    }

    public function concluirAvaluo(){

        $this->validate([
            'contraseña' => 'required',
            'cer' => 'required',
            'key' => 'required',
        ]);

        try {

            $this->revisarAvaluoCompleto();

            $pdf = null;

            DB::transaction(function () use(&$pdf){

                $pdf = (new FirmaElectronicaController())->firmarElectronicamente($this->avaluo, $this->cer->getRealPath(), $this->key->getRealPath(), $this->contraseña);

                $this->avaluo->update(['estado' => 'concluido']);

            });

            return response()->streamDownload(
                fn () => print($pdf->output()),
                $this->avaluo->predio->cuentaPredial() . '-certificado_de_registro.pdf'
            );

        } catch (GeneralException $ex) {

            $this->dispatch('mostrarMensaje', ['warning', $ex->getMessage()]);

        } catch (\Throwable $th) {

            Log::error("Error al concluir avalúo por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);

        }

    }

    #[Computed]
    public function avaluos(){

        return Avaluo::with('predio.propietarios.persona', 'creadoPor', 'actualizadoPor', 'firmaElectronica')
                            ->where('creado_por', auth()->id())
                            ->orderBy($this->sort, $this->direction)
                            ->paginate($this->pagination);

    }

    public function render()
    {
        return view('livewire.valuacion.mis-avaluos')->extends('layouts.admin');
    }
}
