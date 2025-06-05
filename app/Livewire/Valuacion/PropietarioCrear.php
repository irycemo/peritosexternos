<?php

namespace App\Livewire\Valuacion;

use App\Models\Persona;
use Livewire\Component;
use App\Models\Propietario;
use App\Traits\ActoresTrait;
use App\Traits\BuscarPersonaTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exceptions\GeneralException;

class PropietarioCrear extends Component
{

    use ActoresTrait;
    use BuscarPersonaTrait;

    public $predio;

    protected function rules(){

        return $this->traitRules() +[
            'curp' => [
                'nullable',
                'regex:/^[A-Z]{1}[AEIOUX]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/i'
            ],
            'rfc' => [
                'nullable',
                'regex:/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/'
            ],
            'sub_tipo' => 'nullable',
            'porcentaje_propiedad' => 'nullable|numeric|min:0|max:100',
            'porcentaje_nuda' => 'nullable|numeric|min:0|max:100',
            'porcentaje_usufructo' => 'nullable|numeric|min:0|max:100',
        ];

    }

    public function revisarProcentajesSinTransmitentes(){

        $pp = 0;

        $pn = 0;

        $pu = 0;

        foreach($this->modelo->propietarios as $propietario){

            $pn = $pn + $propietario->porcentaje_nuda;

            $pu = $pu + $propietario->porcentaje_usufructo;

            $pp = $pp + $propietario->porcentaje_propiedad;

        }

        $pp = $pp + (float)$this->porcentaje_propiedad;

        $pn = $pn + (float)$this->porcentaje_nuda + $pp;

        $pu = $pu + (float)$this->porcentaje_usufructo + $pp;

        if((float)$pn > 100 || (float)$pu > 100) throw new GeneralException("La suma de los porcentajes no puede exceder el 100%.");

    }

    public function updated($property, $value){

        if(in_array($property, ['porcentaje_nuda', 'porcentaje_usufructo', 'porcentaje_propiedad']) && $value == ''){

            $this->$property = 0;

        }

        if(in_array($property, ['porcentaje_nuda', 'porcentaje_usufructo'])){

            $this->reset('porcentaje_propiedad');

        }elseif($property == 'porcentaje_propiedad'){

            $this->reset(['porcentaje_nuda', 'porcentaje_usufructo']);

        }

    }

    public function validaciones(){

        if($this->porcentaje_propiedad === 0 && $this->porcentaje_nuda === 0 && $this->porcentaje_usufructo === 0){

            throw new GeneralException("La suma de los porcentajes no puede ser 0.");

        }

        $this->revisarProcentajesSinTransmitentes();

    }

    public function guardar(){

        $this->validate();

        try {

            $this->validaciones();

            $persona = $this->buscarPersona($this->rfc, $this->curp, $this->tipo_persona, $this->nombre, $this->ap_materno, $this->ap_paterno, $this->razon_social);

            if($this->persona->getKey() && $persona){

                foreach($this->modelo->propietarios as $actor){

                    if($actor->persona_id == $persona->id) throw new GeneralException('La persona ya es un actor.');

                }

                $actor = $this->modelo->propietarios()->create([
                    'persona_id' => $persona->id,
                    'tipo' => 'propietario',
                    'porcentaje_propiedad' => $this->porcentaje_propiedad,
                    'porcentaje_nuda' => $this->porcentaje_nuda,
                    'porcentaje_usufructo' => $this->porcentaje_usufructo,
                    'creado_por' => auth()->id()
                ]);

            }elseif($persona){

                foreach($this->modelo->propietarios() as $actor){

                    if($actor->persona_id == $persona->id) throw new GeneralException('La persona ya es un actor.');

                }

                throw new GeneralException('Ya existe un persona registrada con la información ingresada.');

            }else{

                DB::transaction(function () use(&$actor){

                    $persona = Persona::create([
                        'tipo' => $this->tipo_persona,
                        'nombre' => $this->nombre,
                        'multiple_nombre' => $this->multiple_nombre,
                        'ap_paterno' => $this->ap_paterno,
                        'ap_materno' => $this->ap_materno,
                        'curp' => $this->curp,
                        'rfc' => $this->rfc,
                        'razon_social' => $this->razon_social,
                        'fecha_nacimiento' => $this->fecha_nacimiento,
                        'nacionalidad' => $this->nacionalidad,
                        'estado_civil' => $this->estado_civil,
                        'calle' => $this->calle,
                        'numero_exterior' => $this->numero_exterior,
                        'numero_interior' => $this->numero_interior,
                        'colonia' => $this->colonia,
                        'cp' => $this->cp,
                        'entidad' => $this->entidad,
                        'ciudad' => $this->ciudad,
                        'municipio' => $this->municipio,
                    ]);

                    $actor = $this->modelo->propietarios()->create([
                        'persona_id' => $persona->id,
                        'porcentaje_propiedad' => $this->porcentaje_propiedad,
                        'porcentaje_nuda' => $this->porcentaje_nuda,
                        'porcentaje_usufructo' => $this->porcentaje_usufructo,
                        'creado_por' => auth()->id()
                    ]);

                });

            }

            $this->resetearTodo();

            $this->dispatch('mostrarMensaje', ['success', "El propietario se creó con éxito."]);

            $this->dispatch('refresh');

        } catch (GeneralException $ex) {

            $this->dispatch('mostrarMensaje', ['error', $ex->getMessage()]);

        } catch (\Throwable $th) {

            Log::error("Error al crear propietario por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);

        }

    }

    public function actualizar(){

        $this->validate();

        try {

            $persona = $this->buscarPersona($this->rfc, $this->curp, $this->tipo_persona, $this->nombre, $this->ap_materno, $this->ap_paterno, $this->razon_social);

            if($persona && ($persona->id != $this->persona->id)){

                throw new GeneralException("Ya existe una persona con el RFC o CURP ingresada.");

            }else{

                $this->persona->update([
                    'curp' => $this->curp,
                    'rfc' => $this->rfc,
                    'estado_civil' => $this->estado_civil,
                    'calle' => $this->calle,
                    'numero_exterior' => $this->numero_exterior,
                    'numero_interior' => $this->numero_interior,
                    'colonia' => $this->colonia,
                    'cp' => $this->cp,
                    'ciudad' => $this->ciudad,
                    'entidad' => $this->entidad,
                    'nacionalidad' => $this->nacionalidad,
                    'municipio' => $this->municipio,
                    'actualizado_por' => auth()->id()
                ]);

            }

            $this->dispatch('mostrarMensaje', ['success', "El adquiriente se actualizó con éxito."]);

            $this->dispatch('refresh');


        } catch (GeneralException $ex) {

            $this->dispatch('mostrarMensaje', ['error', $ex->getMessage()]);

        } catch (\Throwable $th) {

            Log::error("Error al actualizar propietario por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);

        }

    }

    public function mount(){

        $this->tipo = 'propietario';

        $this->propietario = Propietario::make();

        $this->persona = Persona::make();

    }

    public function render()
    {
        return view('livewire.valuacion.propietario-crear');
    }
}
