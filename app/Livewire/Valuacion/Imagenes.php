<?php

namespace App\Livewire\Valuacion;

use App\Models\File;
use App\Models\Avaluo;
use App\Models\Predio;
use Livewire\Component;
use Illuminate\Support\Str;
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
            'fachada' => 'required|image|max:5000|mimes:jpeg,png,jpg',
            'foto2' => 'required|image|max:5000|mimes:jpeg,png,jpg',
            'foto3' => 'required|image|max:5000|mimes:jpeg,png,jpg',
            'foto4' => 'required|image|max:5000|mimes:jpeg,png,jpg',
            'macrolocalizacion' => 'required|image|max:5000|mimes:jpeg,png,jpg',
            'microlocalizacion' => 'required|image|max:5000|mimes:jpeg,png,jpg',
            'poligonoDwg' => 'required|mimes:dwg',
            'poligonoImagen' => 'required|image|max:5000|mimes:jpeg,png,jpg',
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

        $extension = pathinfo($imagen, PATHINFO_EXTENSION);

        $url = Str::random(40) . '.' . $extension;

        if(app()->isProduction()){

            Storage::disk('s3')->put('peritos_externos/imagenes/' . $url, $imagen);

        }else{

            $url = $imagen->store('/', 'avaluos');

        }

        if(!$file)

            File::create([
                            'avaluo_id' => $this->predio->avaluo->id,
                            'url' => $url,
                            'descripcion' => $descripcion
                        ]);

        else{

            if(app()->isProduction()){

                Storage::disk('s3')->delete('peritos_externos/imagenes/' . $file->url);

            }else{

                Storage::disk('avaluos')->delete($file->url);

            }

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
