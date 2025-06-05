<?php

namespace App\Livewire\Valuacion;

use App\Models\Avaluo;
use App\Models\Predio;
use Livewire\Component;
use App\Constantes\Constantes;
use App\Traits\CoordenadasTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class Valuacion extends Component
{
    use CoordenadasTrait;

    public $avaluo_id;

    public $tipoVialidades;
    public $tipoAsentamientos;

    public $predio_padron;
    public $editar = false;

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

            $response = Http::withToken(config('services.sgc.token'))
                                ->accept('application/json')
                                ->asForm()
                                ->post(
                                        config('services.sgc.consulta_cuenta_predial'),
                                        [
                                            'localidad' => $this->predio->localidad,
                                            'oficina' => $this->predio->oficina,
                                            'tipo_predio' => $this->predio->tipo_predio,
                                            'numero_registro' => $this->predio->numero_registro
                                        ]);

            if($response->status() == 200){

                $data = json_decode($response, true);

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

            }elseif($response->status() == 401){

                $data = json_decode($response, true);

                if($data['message'] == 'Unauthenticated.'){

                    Log::error("API: " . $data['message']. $response);

                }

                $this->dispatch('mostrarMensaje', ['warning', $data['error'] ?? 'No ha sido posible hacer la consulta']);

            }elseif($response->status() == 404){

                $this->dispatch('mostrarMensaje', ['warning', "No se encontro registro en el padrón catastral con la cuenta predial ingresada."]);

            }else{

                $this->dispatch('mostrarMensaje', ['warning', "La consulta no pudo ser procesada correctamente"]);

                Log::error("Error al buscar predio por cuenta predial en valuación por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            }


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

                $avaluo = Avaluo::create([
                    'año' => now()->format('Y'),
                    'folio' => (Avaluo::where('año', now()->format('Y'))->where('usuario', auth()->user()->clave)->max('folio') ?? 0) + 1,
                    'usuario' => auth()->user()->clave,
                    'predio_id' => $this->predio->id,
                    'estado' => 'nuevo',
                    'creado_por' => auth()->id()
                ]);

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

    public function actualizarAvaluo(){

        if(!in_array($this->predio->avaluo->estado, ["nuevo", "impreso"])){

            $this->dispatch('mostrarMensaje', ['warning', 'El avalúo no se puede modificar.']);

            return;

        }

        $this->validate();

        try {

            DB::transaction(function () {

                $this->predio->save();

                $avaluo = Avaluo::where('predio', $this->predio->id)->first();

                $avaluo->update([
                    'actualizado_por' => auth()->user()->id,
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

            $this->editar = true;

        }

    }

    public function render()
    {
        return view('livewire.valuacion.valuacion');
    }
}
