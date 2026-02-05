<?php

namespace App\Livewire\Valuacion;

use App\Models\File;
use App\Models\Avaluo;
use App\Models\Predio;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
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
    public $anexo;
    public $observaciones;

    public $predio;
    public $avaluo;
    public $avaluo_id;

    protected function rules(){
        return [
            'fachada' => [Rule::requiredIf($this->avaluo->fachada() == null),'nullable','image','max:5000','mimes:jpeg,png,jpg'],
            'foto2' => [Rule::requiredIf($this->avaluo->foto2() == null),'nullable','image','max:5000','mimes:jpeg,png,jpg'],
            'foto3' => [Rule::requiredIf($this->avaluo->foto3() == null),'nullable','image','max:5000','mimes:jpeg,png,jpg'],
            'foto4' => [Rule::requiredIf($this->avaluo->foto4() == null),'nullable','image','max:5000','mimes:jpeg,png,jpg'],
            'macrolocalizacion' => [Rule::requiredIf($this->avaluo->macrolocalizacion() == null),'nullable','image','max:5000','mimes:jpeg,png,jpg'],
            'microlocalizacion' => [Rule::requiredIf($this->avaluo->microlocalizacion() == null),'nullable','image','max:5000','mimes:jpeg,png,jpg'],
            'poligonoDwg' => [Rule::requiredIf($this->avaluo->poligonoDwg() == null),'nullable','mimes:dwg'],
            'poligonoImagen' => [Rule::requiredIf($this->avaluo->poligonoImagen() == null),'nullable','image','max:5000','mimes:jpeg,png,jpg'],
            'predio' => 'required',
            'anexo' => 'nullable|mimes:pdf',
            'avaluo.observaciones' => 'nullable',
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

        $this->predio = Predio::with('avaluo')->find($id);

        if(! $this->avaluo){

            $this->avaluo = $this->predio->avaluo;

        }

    }

    public function procesarImagen($imagen, $descripcion){

        $file = $this->avaluo->imagenes()
                        ->where('descripcion' , $descripcion)
                        ->first();

        $url = Str::random(40) . '.' . $imagen->getClientOriginalExtension();

        if(app()->isProduction()){

            Storage::disk('s3')->putFileAs('peritos_externos/imagenes/', $imagen, $url, 'private');

        }else{

            $url = $imagen->store('/', 'avaluos');

        }

        if(!$file)

            File::create([
                        'fileable_type' => 'App\Models\Avaluo',
                        'fileable_id' => $this->avaluo->id,
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

                if($this->anexo){

                    $this->procesarImagen($this->anexo,'anexo');

                }

                $this->avaluo->save();

                $this->avaluo->audits()->latest()->first()->update(['tags' => 'Actualizó imágenes']);

            });

            $this->dispatch('mostrarMensaje', ['success', "La información se guardó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al guardar imagenes de avaluo por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);
        }

    }

    public function mount(){

        if($this->avaluo_id){

            $this->avaluo = Avaluo::find($this->avaluo_id);

            $this->cargarPredio($this->avaluo->predio_id);

        }

    }

    public function render()
    {
        return view('livewire.valuacion.imagenes');
    }

}
