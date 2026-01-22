<?php

namespace App\Livewire\Valuacion;

use App\Models\Avaluo;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\FirmaElectronica;
use App\Traits\ComponentesTrait;
use Livewire\Attributes\Computed;
use App\Traits\RevisarAvaluoTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exceptions\GeneralException;
use App\Services\SGCService\SGCService;
use App\Http\Controllers\AvaluoController;
use App\Http\Controllers\FirmaElectronicaController;

class MisAvaluos extends Component
{

    use ComponentesTrait;
    use WithPagination;
    use RevisarAvaluoTrait;
    use WithFileUploads;

    public Avaluo $modelo_editar;

    public $avaluo;

    public $modalConcluir = false;
    public $modalClonar = false;

    public $contraseña;
    public $cer;
    public $key;

    public $localidad;
    public $oficina;
    public $tipo_predio;
    public $numero_registro;

    public function crearModeloVacio(){
        return Avaluo::make();
    }

    public function abrirModalConcluir(Avaluo $avaluo){

        $this->avaluo = $avaluo;

        if(in_array($this->avaluo->predio->sector, [88, 99])){

            $this->dispatch('mostrarMensaje', ['warning', 'El predio debe ser conciliado comuniquese a la oficina rentistica correspondiente para solicitar la conciliación.']);

            return;

        }

        $this->modalConcluir = true;

    }

    public function abrirModalClonar(Avaluo $avaluo){

        $this->avaluo = $avaluo;

        $this->modalClonar = true;

    }

    public function imprimir(Avaluo $avaluo){

        $this->avaluo = $avaluo;

        try {

            $this->revisarAvaluoCompleto();

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

            $this->reset('modalConcluir', 'cer', 'key', 'contraseña');

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

    public function clonar(){

        try {

            DB::transaction(function () {

                $data = (new SGCService())->consultarPredio($this->localidad, $this->oficina, $this->tipo_predio,$this->numero_registro);

                $predio_id = $this->clonarPredio($data);

                $nuevo_avaluo = $this->avaluo->replicate();

                $nuevo_avaluo->folio = (Avaluo::where('año', now()->format('Y'))->where('usuario', auth()->user()->clave)->max('folio') ?? 0) + 1;
                $nuevo_avaluo->predio_id = $predio_id;
                $nuevo_avaluo->estado = 'nuevo';
                $nuevo_avaluo->save();

                foreach($this->avaluo->bloques as $bloque){

                    $nuevo_bloque = $bloque->replicate();
                    $nuevo_bloque->avaluo_id = $nuevo_avaluo->id;
                    $nuevo_bloque->save();

                }

            });

            $this->dispatch('mostrarMensaje', ['success', 'El avalúo se clono con éxito']);

            $this->reset(['localidad', 'oficina', 'tipo_predio', 'numero_registro', 'modalClonar']);


        } catch (GeneralException $ex) {

            $this->dispatch('mostrarMensaje', ['warning', $ex->getMessage()]);

        } catch (\Throwable $th) {

            Log::error("Error al clonar avalúo por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);

        }

    }

    public function clonarPredio($data){

        $predio = $this->avaluo->predio->replicate();

        $predio->sgc_id = $data['data']['id'];
        $predio->region_catastral = $data['data']['region_catastral'];
        $predio->municipio = $data['data']['municipio'];
        $predio->zona_catastral = $data['data']['zona_catastral'];
        $predio->localidad = $data['data']['localidad'];
        $predio->sector = $data['data']['sector'];
        $predio->manzana = $data['data']['manzana'];
        $predio->predio = $data['data']['predio'];
        $predio->edificio = $data['data']['edificio'];
        $predio->departamento = $data['data']['departamento'];
        $predio->oficina = $this->oficina;
        $predio->tipo_predio = $this->tipo_predio;
        $predio->numero_registro = $this->numero_registro;

        $predio->save();

        foreach($this->avaluo->predio->propietarios as $propietario){

            $propietario_nuevo = $propietario->replicate();

            $propietario_nuevo->predio_id = $predio->id;

            $propietario_nuevo->save();

        }

        foreach($this->avaluo->predio->colindancias as $colindancia){

            $propietario_nuevo = $colindancia->replicate();

            $propietario_nuevo->predio_id = $predio->id;

            $propietario_nuevo->save();

        }

        foreach($this->avaluo->predio->terrenos as $terreno){

            $terreno_nuevo = $terreno->replicate();

            $terreno_nuevo->predio_id = $predio->id;

            $terreno_nuevo->save();

        }

        foreach($this->avaluo->predio->terrenosComun as $terrenoComun){

            $terreno_comun_nuevo = $terrenoComun->replicate();

            $terreno_comun_nuevo->predio_id = $predio->id;

            $terreno_comun_nuevo->save();

        }

        foreach($this->avaluo->predio->construcciones as $construccion){

            $construccion_nueva = $construccion->replicate();

            $construccion_nueva->predio_id = $predio->id;

            $construccion_nueva->save();

        }

        foreach($this->avaluo->predio->construccionesComun as $construccioneComun){

            $construccion_comun_nueva = $construccioneComun->replicate();

            $construccion_comun_nueva->predio_id = $predio->id;

            $construccion_comun_nueva->save();

        }

        return $predio->id;

    }

    #[Computed]
    public function avaluos(){

        return Avaluo::select('id', 'predio_id', 'año', 'folio', 'usuario', 'estado', 'creado_por', 'actualizado_por', 'created_at', 'updated_at')
                            ->with('predio.propietarios.persona', 'creadoPor:id,name', 'actualizadoPor:id,name', 'firmaElectronica:id,avaluo_id,uuid')
                            ->where('creado_por', auth()->id())
                            ->orderBy($this->sort, $this->direction)
                            ->paginate($this->pagination);

    }

    public function render()
    {
        return view('livewire.valuacion.mis-avaluos')->extends('layouts.admin');
    }
}

