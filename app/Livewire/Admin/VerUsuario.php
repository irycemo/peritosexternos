<?php

namespace App\Livewire\Admin;

use App\Constantes\Constantes;
use App\Models\User;
use App\Models\Avaluo;
use Livewire\Component;
use App\Mail\RechazarPeritoMail;
use App\Traits\ComponentesTrait;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\WithPagination;

class VerUsuario extends Component
{

    use ComponentesTrait;
    use WithPagination;

    public User $user;

    public $observacion;
    public $modal_rechazar = false;

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

    public function crearModeloVacio(){
        return Avaluo::make();
    }

    public function activarPerito(){

        if(
            ! $this->user->actaNacimiento ||
            ! $this->user->comprobanteRecidencia ||
            ! $this->user->curriculum ||
            ! $this->user->cedulaEspecialidad ||
            ! $this->user->fianza ||
            ! $this->user->pagoCredencial ||
            ! $this->user->registroAsociacion ||
            ! $this->user->foto
        ){

            $this->dispatch('mostrarMensaje', ['warning', "El perito no ha completado su documentación."]);

            return;

        }

        try {

            DB::transaction(function () {

                $this->user->update([
                    'status' => 'activo',
                    'actualizado_por' => auth()->id()
                ]);

                $this->user->audits()->latest()->first()->update(['tags' => 'Activó perito']);

            });

            $this->dispatch('mostrarMensaje', ['success', "El perito se activó con éxito."]);

        } catch (\Throwable $th) {
            Log::error("Error al activa perito por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
        }

    }

    public function rechazar(){

        $this->validate(['observacion' => 'required']);

        try {

            Mail::to($this->user->email)->send(new RechazarPeritoMail($this->user, $this->observacion));

            $this->dispatch('mostrarMensaje', ['success', "Se ha notificado via correo electrónico al perito."]);

            $this->reset(['modal_rechazar', 'observacion']);

        } catch (\Throwable $th) {
            Log::error("Error al rechazar perito por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
        }
    }

    #[Computed]
    public function avaluos(){

        return Avaluo::select('id', 'predio_id', 'año', 'folio', 'usuario', 'estado', 'created_at', 'updated_at')
                        ->with('predio.propietarios.persona')
                        ->where('creado_por', $this->user->id)
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
        return view('livewire.admin.ver-usuario')->extends('layouts.admin');
    }
}
