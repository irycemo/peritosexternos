<?php

namespace App\Livewire\Admin;

use App\Models\File;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class PeritoArchivos extends Component
{

    use WithFileUploads;

    public $ine_frente;
    public $ine_reverso;
    public $cedula_profesional;
    public $cedula_especialidad;

    protected function rules(){
        return [
            'ine_frente' => ['nullable','image','max:2000'],
            'ine_reverso' => ['nullable','image','max:2000'],
            'cedula_profesional' => ['nullable','image','max:2000'],
            'cedula_especialidad' => ['nullable','image','max:2000'],
        ];
    }

    public function updating($field, $value){

        $this->validate();

    }

    public function guardar(){

        $this->validate();

        try {

            DB::transaction(function () {

                if($this->ine_frente){

                    $this->procesarImagen($this->ine_frente, 'ineFrente');

                }

                if($this->ine_frente){

                    $this->procesarImagen($this->ine_reverso, 'ineReverso');

                }

                if($this->ine_frente){

                    $this->procesarImagen($this->cedula_profesional, 'cedulaProfesional');

                }

                if($this->ine_frente){

                    $this->procesarImagen($this->cedula_especialidad, 'cedulaEspecialidad');

                }

            });

            $this->dispatch('mostrarMensaje', ['success', "Se actualizó la información con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al guardar imagenes de perito por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);
        }

    }

    public function procesarImagen($imagen, $descripcion){

        $ext = $imagen->getClientOriginalExtension();

        $file = auth()->user()->imagenes()
                        ->where('descripcion' , $descripcion)
                        ->first();

        $url = Str::random(40) . '.' . $ext;

        if(app()->isProduction()){

            Storage::disk('s3')->putFileAs(config('services.ses.ruta_archivos'), $imagen, $url, 'private');

        }else{

            $url = $imagen->store('/', 'avaluos');

        }

        if(!$file)

            File::create([
                        'fileable_type' => 'App\Models\User',
                        'fileable_id' => auth()->id(),
                        'url' => $url,
                        'descripcion' => $descripcion
                        ]);

        else{

            if(app()->isProduction()){

                Storage::disk('s3')->delete(config('services.ses.ruta_archivos') . $file->url);

            }else{

                Storage::disk('avaluos')->delete($file->url);

            }

            $file->update(['url' => $url]);

        }

    }

    public function render()
    {
        return view('livewire.admin.perito-archivos');
    }
}
