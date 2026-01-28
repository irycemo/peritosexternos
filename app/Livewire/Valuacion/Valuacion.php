<?php

namespace App\Livewire\Valuacion;

use App\Models\File;
use App\Models\Avaluo;
use App\Models\Predio;
use App\Models\Persona;
use Livewire\Component;
use App\Constantes\Constantes;
use App\Traits\CoordenadasTrait;
use App\Traits\BuscarPersonaTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\Http;
use App\Services\SGCService\SGCService;
use Illuminate\Support\Facades\Storage;

class Valuacion extends Component
{
    use CoordenadasTrait;
    use BuscarPersonaTrait;

    public $avaluo_id;

    public $tipoVialidades;
    public $tipoAsentamientos;

    public $predio_padron;
    public $editar = false;
    public $propietarios = [];
    public $colindancias = [];

    public $solicitante;

    public Predio $predio;

    protected function rules(){
        return [
            'predio.sgc_id' => 'required|numeric|min:1',
            'predio.numero_registro' => 'required|numeric|min:1',
            'predio.region_catastral' => 'required|numeric|min:1',
            'predio.municipio' => 'required|numeric|min:1',
            'predio.localidad' => 'required|numeric|min:1',
            'predio.sector' => 'required|numeric|min:1',
            'predio.zona_catastral' => 'required|numeric|min:1,|same:predio.localidad',
            'predio.manzana' => 'required|numeric|min:0',
            'predio.predio' => 'required|numeric|min:1',
            'predio.edificio' => 'required|numeric|min:0',
            'predio.departamento' => 'required|numeric|min:0',
            'predio.tipo_predio' => 'required|numeric|min:1|max:2',
            'predio.oficina' => 'required|numeric|min:1',
            'predio.estado' => 'required',
            'predio.superficie_notarial' => 'nullable',
            'predio.tipo_asentamiento' => 'required',
            'predio.nombre_asentamiento' => 'required',
            'predio.tipo_vialidad' => 'required',
            'predio.nombre_vialidad' => 'required',
            'predio.numero_exterior' => 'required',
            'predio.numero_exterior_2' => 'nullable',
            'predio.numero_interior' => 'nullable',
            'predio.numero_adicional_2' => 'nullable',
            'predio.numero_adicional' => 'nullable',
            'predio.codigo_postal' => 'nullable|numeric',
            'predio.lote_fraccionador' => 'nullable',
            'predio.manzana_fraccionador' => 'nullable',
            'predio.etapa_fraccionador' => 'nullable',
            'predio.nombre_predio'  => 'nullable',
            'predio.nombre_edificio' => 'nullable',
            'predio.clave_edificio' => 'nullable',
            'predio.departamento_edificio' => 'nullable',
            'predio.xutm' => 'nullable|string',
            'predio.yutm' => 'nullable|string',
            'predio.zutm' => 'nullable',
            'predio.lat' => 'required',
            'predio.lon' => 'required',
            'solicitante' => 'required',
         ];
    }

    public function crearModeloVacio(){
        return Predio::make([
            'estado' => 16
        ]);
    }

    public function buscarCuentaPredial(){

        $this->validate([
            'predio.numero_registro' => 'required|numeric',
            'predio.tipo_predio' => 'required|numeric',
            'predio.localidad' => 'required|numeric',
            'predio.oficina' => 'required|numeric',
        ]);

        $this->reset('editar');

        try {

            $data = (new SGCService())->consultarPredio($this->predio->localidad, $this->predio->oficina, $this->predio->tipo_predio,$this->predio->numero_registro);

            $this->predio->sgc_id = $data['data']['id'];
            $this->predio->region_catastral = $data['data']['region_catastral'];
            $this->predio->municipio = $data['data']['municipio'];
            $this->predio->zona_catastral = $data['data']['zona_catastral'];
            $this->predio->localidad = $data['data']['localidad'];
            $this->predio->sector = $data['data']['sector'];
            $this->predio->manzana = $data['data']['manzana'];
            $this->predio->predio = $data['data']['predio'];
            $this->predio->edificio = $data['data']['edificio'];
            $this->predio->departamento = $data['data']['departamento'];

            $this->propietarios = $data['data']['propietarios'];

            if(isset($data['data']['colindancias'])){

                $this->colindancias = $data['data']['colindancias'];

            }

        } catch (GeneralException $ex) {

            $this->dispatch('mostrarMensaje', ['warning', $ex->getMessage()]);

        } catch (\Throwable $th) {

            Log::error("Error al buscar predio por cuenta predial en valuación por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);

        }

    }

    public function crearAvaluo(){

        $this->validate();

        try {

            DB::transaction(function () {

                $this->predio->actualizado_por = auth()->user()->id;
                $this->predio->save();

                if(count($this->propietarios)) $this->cargarPropietarios();

                if(count($this->colindancias)) $this->cargarColindancias();

                $avaluo = Avaluo::create([
                    'año' => now()->format('Y'),
                    'folio' => (Avaluo::where('año', now()->format('Y'))->where('usuario', auth()->user()->clave)->max('folio') ?? 0) + 1,
                    'usuario' => auth()->user()->clave,
                    'predio_id' => $this->predio->id,
                    'estado' => in_array($this->predio->sector, [88,99]) ? 'conciliar' : 'nuevo',
                    'creado_por' => auth()->id(),
                    'solicitante' => $this->solicitante,
                ]);

                $this->generarImagenesLocalizacion();

                $avaluo->audits()->latest()->first()->update(['tags' => 'Generó avalúo con folio: ' . $avaluo->año . '-' . $avaluo->folio . '-' . $avaluo->usuario]);

                $this->dispatch('mostrarMensaje', ['success', "El avaluo se creó con el folio " . $avaluo->año . '-' . $avaluo->folio . '-' . $avaluo->usuario . '.']);

            });

            $this->editar = true;

            $this->dispatch('cargarPredio', $this->predio->id);

        } catch (\Throwable $th) {

            Log::error("Error al crear avalúo por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);

        }

    }

    public function cargarColindancias(){

        foreach($this->colindancias as $colindancia){

            $this->predio->colindancias()->create([
                'viento' => $colindancia['viento'],
                'longitud' => $colindancia['longitud'],
                'descripcion' => $colindancia['descripcion'],
                'creado_por' => auth()->id()
            ]);

        }

    }

    public function cargarPropietarios(){

        foreach($this->propietarios as $propietario){

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

            $this->predio->propietarios()->create([
                'persona_id' => $persona->id,
                'porcentaje_propiedad' => $propietario['porcentaje_propiedad'],
                'porcentaje_nuda' => $propietario['porcentaje_nuda'],
                'porcentaje_usufructo' => $propietario['porcentaje_usufructo'],
            ]);

        }

    }

    public function actualizarAvaluo(){

        if(!in_array($this->predio->avaluo->estado, ["nuevo", "impreso"])){

            $this->dispatch('mostrarMensaje', ['warning', 'El avalúo no se puede modificar.']);

            return;

        }

        $this->validate();

        try {

            DB::transaction(function () {

                $this->predio->save();

                $avaluo = Avaluo::where('predio_id', $this->predio->id)->first();

                $avaluo->update([
                    'actualizado_por' => auth()->user()->id,
                    'solicitante' => $this->solicitante,
                    'estado' => 'nuevo'
                ]);

                $avaluo->audits()->latest()->first()->update(['tags' => 'Actualizó datos de identificación del inmueble']);

                $this->dispatch('mostrarMensaje', ['success', "El avalúo se actualizó con éxito."]);

            });

        } catch (\Throwable $th) {
            Log::error("Error al crear predio por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);

        }

    }

    public function mount(){

        $this->predio = $this->crearModeloVacio();

        $this->tipoVialidades = Constantes::TIPO_VIALIDADES;

        $this->tipoAsentamientos = Constantes::TIPO_ASENTAMIENTO;

        if($this->avaluo_id){

            $avaluo = Avaluo::with('predio')->find($this->avaluo_id);

            $this->predio = $avaluo->predio;

            $this->solicitante = $avaluo->solicitante;

            $this->editar = true;

        }

    }

    public function generarImagenesLocalizacion(){

        $apiKey = config('services.google.maps_key');

        $ancho = 500;
        $alto = 500;
        $centro = "{$this->predio->lat},{$this->predio->lon}";

        $zoomMacro = 13;
        $urlMacro = "https://maps.googleapis.com/maps/api/staticmap?" . http_build_query([
            'center' => $centro,
            'zoom' => $zoomMacro,
            'size' => "{$ancho}x{$alto}",
            'maptype' => 'roadmap',
            'markers' => "color:red|{$centro}",
            'key' => $apiKey,
            'format' => 'jpg'
        ]);

        $zoomMicro = 17;
        $urlMicro = "https://maps.googleapis.com/maps/api/staticmap?" . http_build_query([
            'center' => $centro,
            'zoom' => $zoomMicro,
            'size' => "{$ancho}x{$alto}",
            'maptype' => 'roadmap',
            'markers' => "color:red|{$centro}",
            'key' => $apiKey,
            'format' => 'jpg'
        ]);

        $responseMacro = Http::timeout(30)->get($urlMacro);

        if (!$responseMacro->successful()) {
            throw new GeneralException('Error al obtener imagen de macrolocalización');
        }


        $responseMicro = Http::timeout(30)->get($urlMicro);

        if (!$responseMicro->successful()) {
            throw new GeneralException('Error al obtener imagen de microlocalización');
        }

        $timestamp = now()->timestamp;
        $nombreMacro = "macro_{$this->predio->lat}{$this->predio->lon}{$timestamp}.jpg";
        $nombreMicro = "micro_{$this->predio->lat}{$this->predio->lon}{$timestamp}.jpg";

        if(app()->isProduction()){

            Storage::disk('s3')->put('peritos_externos/imagenes/' . $nombreMacro,  $responseMacro->body());

            Storage::disk('s3')->put('peritos_externos/imagenes/' . $nombreMicro, $responseMicro->body());

        }else{

            Storage::disk('avaluos')->put($nombreMacro, $responseMacro->body());
            Storage::disk('avaluos')->put($nombreMicro, $responseMicro->body());

        }

        File::create([
            'fileable_type' => 'App\Models\Avaluo',
            'fileable_id' => $this->predio->avaluo->id,
            'url' => $nombreMacro,
            'descripcion' => 'macrolocalizacion'
        ]);

        File::create([
            'fileable_type' => 'App\Models\Avaluo',
            'fileable_id' => $this->predio->avaluo->id,
            'url' => $nombreMicro,
            'descripcion' => 'microlocalizacion'
        ]);

    }

    public function render()
    {
        return view('livewire.valuacion.valuacion');
    }
}
