<?php

namespace App\Livewire\Valuacion;

use App\Constantes\Constantes;
use App\Exceptions\GeneralException;
use App\Http\Controllers\AvaluoController;
use App\Http\Controllers\FirmaElectronicaController;
use App\Models\Avaluo;
use App\Models\FirmaElectronica;
use App\Models\Persona;
use App\Services\SGCService\SGCService;
use App\Services\TramitesLineaService\TramitesLineaService;
use App\Traits\BuscarPersonaTrait;
use App\Traits\ComponentesTrait;
use App\Traits\GeneradorQRTrait;
use App\Traits\RevisarAvaluoTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class MisAvaluos extends Component
{

    use ComponentesTrait;
    use WithPagination;
    use RevisarAvaluoTrait;
    use WithFileUploads;
    use GeneradorQRTrait;
    use BuscarPersonaTrait;

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

    public $años;
    public $filters = [
        'año' => '',
        'folio' => '',
        'usuario' => '',
        'estado' => '',
        'localidad' => '',
        'oficina' => '',
        'tipo' => '',
        'registro' => ''
    ];

    public function updatedFilters() { $this->resetPage(); }

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
                $this->avaluo->predio->cuentaPredial() . '-avaluo.pdf'
            );

        } catch (GeneralException $ex) {

            $this->dispatch('mostrarMensaje', ['warning', $ex->getMessage()]);

        } catch (\Throwable $th) {

            Log::error("Error al concluir avalúo por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);

        }

    }

    public function clonar(){

        $this->validate([
            'localidad' => 'required',
            'oficina' => 'required',
            'tipo_predio' => 'required',
            'numero_registro' => 'required',
        ]);

        try {

            DB::transaction(function () {

                $data = (new SGCService())->consultarPredio($this->localidad, $this->oficina, $this->tipo_predio,$this->numero_registro);

                $predio_id = $this->clonarPredio($data);

                $nuevo_avaluo = $this->avaluo->replicate();

                $nuevo_avaluo->folio = (Avaluo::where('año', now()->format('Y'))->where('usuario', auth()->user()->clave)->max('folio') ?? 0) + 1;
                $nuevo_avaluo->predio_id = $predio_id;
                $nuevo_avaluo->estado = 'nuevo';
                $nuevo_avaluo->save();

                foreach($this->avaluo->predio->colindancias as $colindancia){

                    $nueva_colindancia = $colindancia->replicate();
                    $nueva_colindancia->predio_id = $predio_id;
                    $nueva_colindancia->save();

                }

                foreach($this->avaluo->bloques as $bloque){

                    $nuevo_bloque = $bloque->replicate();
                    $nuevo_bloque->avaluo_id = $nuevo_avaluo->id;
                    $nuevo_bloque->save();

                }

                foreach($this->avaluo->imagenes as $imagen){

                    if(app()->isProduction()){

                        $nombre = '2' . $imagen->url;

                        if (Storage::disk('s3')->exists(config('services.ses.ruta_archivos') . $imagen->url)){

                            Storage::disk('s3')->copy(config('services.ses.ruta_archivos') . $imagen->url, config('services.ses.ruta_archivos') .  $nombre);

                        }else{

                            return;

                        }

                    }else{

                        $nombre = '2' . $imagen->url;

                        Storage::disk('avaluos')->copy($imagen->url, $nombre);

                    }

                    $nueva_imagen = $imagen->replicate();
                    $nueva_imagen->url = $nombre;
                    $nueva_imagen->fileable_id = $nuevo_avaluo->id;
                    $nueva_imagen->save();

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

    public function corregirAvaluo(Avaluo $avaluo){


        try {

            DB::transaction(function () use ($avaluo){

                $avaluo->firmaElectronica?->update(['estado' => 'cancelado',  'observaciones' => 'Cancelado por corrección']);

                $avaluo->update(['estado'=> 'nuevo', 'actualizado_por' => auth()->id()]);

                $avaluo->audits()->latest()->first()->update(['tags' => 'Reactivó avalúo']);

                (new TramitesLineaService())->desvincularAvaluo($avaluo->id);

            });

            $this->dispatch('mostrarMensaje', ['success', 'El avalúo se clono con éxito']);

            $this->reset(['localidad', 'oficina', 'tipo_predio', 'numero_registro', 'modalClonar']);


        } catch (GeneralException $ex) {

            $this->dispatch('mostrarMensaje', ['warning', $ex->getMessage()]);

        } catch (\Throwable $th) {

            Log::error("Error al corregir avalúo por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);

        }

    }

    public function actualizarPropietarios(Avaluo $avaluo){

        try {

            DB::transaction(function () use($avaluo){

                $avaluo->predio->propietarios()->delete();

                $data = (new SGCService())->consultarPredio($avaluo->predio->localidad, $avaluo->predio->oficina, $avaluo->predio->tipo_predio,$avaluo->predio->numero_registro);

                foreach($data['data']['propietarios'] as $propietario){

                    $persona = $this->buscarPersona(
                        $propietario['persona']['rfc'],
                        $propietario['persona']['curp'],
                        $propietario['persona']['tipo'],
                        $propietario['persona']['nombre'],
                        $propietario['persona']['ap_materno'],
                        $propietario['persona']['ap_paterno'],
                        $propietario['persona']['razon_social']
                    );

                    if(!$persona){

                        $persona = Persona::create([
                            'tipo' => $propietario['persona']['tipo'],
                            'nombre' => $propietario['persona']['nombre'],
                            'multiple_nombre' => $propietario['persona']['multiple_nombre'],
                            'ap_paterno' => $propietario['persona']['ap_paterno'],
                            'ap_materno' => $propietario['persona']['ap_materno'],
                            'curp' => $propietario['persona']['curp'],
                            'rfc' => $propietario['persona']['rfc'],
                            'razon_social' => $propietario['persona']['razon_social'],
                            'fecha_nacimiento' => $propietario['persona']['fecha_nacimiento'],
                            'nacionalidad' => $propietario['persona']['nacionalidad'],
                            'estado_civil' => $propietario['persona']['estado_civil'],
                            'calle' => $propietario['persona']['calle'],
                            'numero_exterior' => $propietario['persona']['numero_exterior'],
                            'numero_interior' => $propietario['persona']['numero_interior'],
                            'colonia' => $propietario['persona']['colonia'],
                            'entidad' => $propietario['persona']['entidad'],
                            'municipio' => $propietario['persona']['municipio'],
                            'ciudad' => $propietario['persona']['ciudad'],
                            'cp' => $propietario['persona']['cp']
                        ]);

                    }else{

                        $persona->update([
                            'tipo' => $propietario['persona']['tipo'],
                            'nombre' => $propietario['persona']['nombre'],
                            'multiple_nombre' => $propietario['persona']['multiple_nombre'],
                            'ap_paterno' => $propietario['persona']['ap_paterno'],
                            'ap_materno' => $propietario['persona']['ap_materno'],
                            'razon_social' => $propietario['persona']['razon_social'],
                            'fecha_nacimiento' => $propietario['persona']['fecha_nacimiento'],
                            'nacionalidad' => $propietario['persona']['nacionalidad'],
                            'estado_civil' => $propietario['persona']['estado_civil'],
                            'calle' => $propietario['persona']['calle'],
                            'numero_exterior' => $propietario['persona']['numero_exterior'],
                            'numero_interior' => $propietario['persona']['numero_interior'],
                            'colonia' => $propietario['persona']['colonia'],
                            'entidad' => $propietario['persona']['entidad'],
                            'municipio' => $propietario['persona']['municipio'],
                            'ciudad' => $propietario['persona']['ciudad'],
                            'cp' => $propietario['persona']['cp']
                        ]);

                    }

                    $avaluo->predio->propietarios()->create([
                        'persona_id' => $persona->id,
                        'porcentaje_propiedad' => $propietario['porcentaje_propiedad'],
                        'porcentaje_nuda' => $propietario['porcentaje_nuda'],
                        'porcentaje_usufructo' => $propietario['porcentaje_usufructo'],
                    ]);

                }

            });

            $this->dispatch('mostrarMensaje', ['success', 'Los propietarios se actualizaron con éxito']);

        } catch (GeneralException $ex) {

            $this->dispatch('mostrarMensaje', ['warning', $ex->getMessage()]);

        } catch (\Throwable $th) {

            Log::error("Error al actualizar propietarios por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

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

        foreach($data['data']['propietarios'] as $propietario){

            $persona = $this->buscarPersona(
                $propietario['persona']['rfc'],
                $propietario['persona']['curp'],
                $propietario['persona']['tipo'],
                $propietario['persona']['nombre'],
                $propietario['persona']['ap_materno'],
                $propietario['persona']['ap_paterno'],
                $propietario['persona']['razon_social']
            );

            if(!$persona){

                $persona = Persona::create([
                    'tipo' => $propietario['persona']['tipo'],
                    'nombre' => $propietario['persona']['nombre'],
                    'multiple_nombre' => $propietario['persona']['multiple_nombre'],
                    'ap_paterno' => $propietario['persona']['ap_paterno'],
                    'ap_materno' => $propietario['persona']['ap_materno'],
                    'curp' => $propietario['persona']['curp'],
                    'rfc' => $propietario['persona']['rfc'],
                    'razon_social' => $propietario['persona']['razon_social'],
                    'fecha_nacimiento' => $propietario['persona']['fecha_nacimiento'],
                    'nacionalidad' => $propietario['persona']['nacionalidad'],
                    'estado_civil' => $propietario['persona']['estado_civil'],
                    'calle' => $propietario['persona']['calle'],
                    'numero_exterior' => $propietario['persona']['numero_exterior'],
                    'numero_interior' => $propietario['persona']['numero_interior'],
                    'colonia' => $propietario['persona']['colonia'],
                    'entidad' => $propietario['persona']['entidad'],
                    'municipio' => $propietario['persona']['municipio'],
                    'ciudad' => $propietario['persona']['ciudad'],
                    'cp' => $propietario['persona']['cp']
                ]);

            }

            $predio->propietarios()->create([
                'persona_id' => $persona->id,
                'porcentaje_propiedad' => $propietario['porcentaje_propiedad'],
                'porcentaje_nuda' => $propietario['porcentaje_nuda'],
                'porcentaje_usufructo' => $propietario['porcentaje_usufructo'],
            ]);

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

    public function borrarAvaluo(Avaluo $avaluo){

        try {

            DB::transaction(function () use($avaluo){

                $avaluo->bloques()->delete();

                $avaluo->firmaElectronicas()->delete();

                foreach($avaluo->imagenes as $imagen){

                    if(app()->isProduction()){

                        if (Storage::disk('s3')->exists($imagen->url)) {

                            Storage::disk('s3')->delete($imagen->url);

                        }

                    }else{

                        if (Storage::disk('avaluos')->exists($imagen->url)) {

                            Storage::disk('avaluos')->delete($imagen->url);

                        }

                    }

                    $imagen->delete();

                }

                $avaluo->delete();

            });

        } catch (GeneralException $ex) {

            $this->dispatch('mostrarMensaje', ['warning', $ex->getMessage()]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar avalúo por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);

        }

    }

    #[Computed]
    public function avaluos(){

        return Avaluo::select('id', 'predio_id', 'año', 'folio', 'usuario', 'estado', 'entidad', 'creado_por', 'actualizado_por', 'created_at', 'updated_at', 'solicitante')
                            ->with('predio.propietarios.persona', 'creadoPor:id,name', 'actualizadoPor:id,name', 'firmaElectronica:id,avaluo_id,uuid')
                            ->where('creado_por', auth()->id())
                            ->where('año', $this->filters['año'])
                            ->when(strlen($this->filters['estado']) > 0, function($q){
                                $q->where('estado', $this->filters['estado']);
                            })
                            ->when(strlen($this->filters['folio']) > 0, function($q){
                                $q->where('folio', $this->filters['folio']);
                            })
                            ->when(strlen($this->filters['localidad']) > 0, function($q){
                                $q->whereHas('predio', function($q){
                                    $q->where('localidad', $this->filters['localidad']);
                                });
                            })
                            ->when(strlen($this->filters['oficina']) > 0, function($q){
                                $q->whereHas('predio', function($q){
                                    $q->where('oficina', $this->filters['oficina']);
                                });
                            })
                            ->when(strlen($this->filters['tipo']) > 0, function($q){
                                $q->whereHas('predio', function($q){
                                    $q->where('tipo_predio', $this->filters['tipo']);
                                });
                            })
                            ->when(strlen($this->filters['registro']) > 0, function($q){
                                $q->whereHas('predio', function($q){
                                    $q->where('numero_registro', $this->filters['registro']);
                                });
                            })
                            ->orderBy($this->sort, $this->direction)
                            ->paginate($this->pagination);

    }

    public function mount(){

        $this->años = Constantes::AÑOS;

        $this->filters['año'] = now()->year;

    }

    public function render()
    {
        return view('livewire.valuacion.mis-avaluos')->extends('layouts.admin');
    }

}

