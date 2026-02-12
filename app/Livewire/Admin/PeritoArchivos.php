<?php

namespace App\Livewire\Admin;

use App\Models\File;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PeritoArchivos extends Component
{

    use WithFileUploads;

    public $acta_nacimiento;
    public $comprobante_recidencia;
    public $curriculum;
    public $cedula_especialidad;
    public $fianza;
    public $pago_credencial;
    public $registro_asociacion;
    public $foto;

    protected function rules(){
        return [
            'acta_nacimiento' => ['nullable','max:2000', 'mimes:pdf'],
            'comprobante_recidencia' => ['nullable','max:2000', 'mimes:pdf'],
            'curriculum' => ['nullable', 'max:2000', 'mimes:pdf'],
            'cedula_especialidad' => ['nullable','max:2000', 'mimes:pdf'],
            'fianza' => ['nullable','max:2000', 'mimes:pdf'],
            'pago_credencial' => ['nullable','max:2000', 'mimes:pdf'],
            'registro_asociacion' => ['nullable','max:2000', 'mimes:pdf'],
            'foto' => ['nullable','max:2000', 'image'],
        ];
    }

    public function updating($field, $value){

        $this->validate();

    }

    public function guardar(){

        $this->validate();

        try {

            DB::transaction(function () {

                if($this->acta_nacimiento){

                    $this->procesarImagen($this->acta_nacimiento, 'actaNacimiento');

                }

                if($this->comprobante_recidencia){

                    $this->procesarImagen($this->comprobante_recidencia, 'comprobanteRecidencia');

                }

                if($this->curriculum){

                    $this->procesarImagen($this->curriculum, 'curriculum');

                }

                if($this->cedula_especialidad){

                    $this->procesarImagen($this->cedula_especialidad, 'cedulaEspecialidad');

                }

                if($this->fianza){

                    $this->procesarImagen($this->fianza, 'fianza');

                }

                if($this->pago_credencial){

                    $this->procesarImagen($this->pago_credencial, 'pagoCredencial');

                }

                if($this->registro_asociacion){

                    $this->procesarImagen($this->registro_asociacion, 'registroAsociacion');

                }

                if($this->foto){

                    $this->procesarImagen($this->foto, 'foto');

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
