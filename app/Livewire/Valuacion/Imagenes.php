<?php

namespace App\Livewire\Valuacion;

use App\Models\File;
use App\Models\Avaluo;
use App\Models\Predio;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Imagenes extends Component
{
    use WithFileUploads;

    public $encabezado;
    public $fachada;
    public $foto2;
    public $foto3;
    public $foto4;
    public $macrolocalizacion;
    public $microlocalizacion;
    public $poligonoDwg;
    public $poligonoImagen;
    public $observaciones;

    public $predio;
    public $avaluo_id;

    protected function rules(){
        return [
            'fachada' => 'nullable|image|max:5000',
            'foto2' => 'nullable|image|max:5000',
            'foto3' => 'nullable|image|max:5000',
            'foto4' => 'nullable|image|max:5000',
            'macrolocalizacion' => 'nullable|image|max:5000',
            'microlocalizacion' => 'nullable|image|max:5000',
            'poligonoDwg' => 'nullable|mimes:dwg',
            'poligonoImagen' => 'nullable|image|max:5000',
            'predio' => 'required',
            'predio.avaluo.observaciones' => 'nullable',
         ];
    }

    protected $messages = [
        'predio.required' => 'Primero debe cargar el avalúo'
    ];

    protected $validationAttributes  = [
        'predio.avaluo.observaciones' => 'observaciones',
    ];

    #[On('cargarPredio')]
    public function cargarPredio($id){

        $this->predio = Predio::with('avaluo.imagenes')->find($id);

    }

    public function procesarImagen($imagen, $descripcion){

        $file = File::where('avaluo_id', $this->predio->avaluo->id)
                        ->where('descripcion' , $descripcion)
                        ->first();

        $url = $imagen->store('/', 'avaluos');

        if(!$file)

            File::create([
                            'avaluo_id' => $this->predio->avaluo->id,
                            'url' => $url,
                            'descripcion' => $descripcion
                        ]);

        else{

            Storage::disk('avaluos')->delete($file->url);

            $file->update(['url' => $url]);

        }

    }

    public function guardar(){

        $this->validate();

        try {

            DB::transaction(function () {

                /* if($this->encabezado){

                    $this->procesarImagen($this->encabezado, )

                } */

                if($this->fachada){

                    $this->procesarImagen($this->fachada,'fachada');

                }

                if($this->foto2){

                    $this->procesarImagen($this->foto2,'foto2');

                }

                if($this->foto3){

                    $this->procesarImagen($this->foto3,'foto3');

                }

                if($this->foto4){

                    $this->procesarImagen($this->foto4,'foto4');

                }

                if($this->macrolocalizacion){

                    $this->procesarImagen($this->macrolocalizacion,'macrolocalizacion');

                }

                if($this->microlocalizacion){

                    $this->procesarImagen($this->microlocalizacion,'microlocalizacion');

                }

                if($this->poligonoImagen){

                    $this->procesarImagen($this->poligonoImagen,'poligonoImagen');

                }

                if($this->poligonoDwg){

                    $this->procesarImagen($this->poligonoDwg,'poligonoDwg');

                }

                $this->predio->avaluo->save();

                $this->predio->audits()->latest()->first()->update(['tags' => 'Actualizó imágenes']);

                $this->dispatch('mostrarMensaje', ['success', "La información se guardó con éxito."]);

            });

        } catch (\Throwable $th) {

            Log::error("Error al guardar imagenes de avaluo por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);
        }

    }

    public function mount(){

        if($this->avaluo_id){

            $avaluo = Avaluo::with('predio')->find($this->avaluo_id);

            $this->cargarPredio($avaluo->predio_id);

        }

    }

    public function render()
    {
        return view('livewire.valuacion.imagenes');
    }
}
