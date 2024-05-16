<?php

namespace App\Livewire\Admin;

use App\Constantes\Constantes;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;use App\Traits\ComponentesTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Usuarios extends Component
{

    use WithPagination;
    use ComponentesTrait;

    public $roles;
    public $ubicaciones;
    public $areas_adscripcion;
    public $asociaciones;

    public User $modelo_editar;
    public $role;

    protected function rules(){
        return [
            'modelo_editar.name' => 'required',
            'modelo_editar.ap_paterno' => 'required',
            'modelo_editar.ap_materno' => 'required',
            'modelo_editar.email' => 'required|email|unique:users,email,' . $this->modelo_editar->id,
            'modelo_editar.status' => 'required|in:activo,inactivo',
            'role' => 'required',
            'modelo_editar.clave' => 'required',
            'modelo_editar.cedula' => 'required',
            'modelo_editar.especialidad' => 'required',
            'modelo_editar.asociacion' => 'required',
         ];
    }

    protected $validationAttributes  = [
        'role' => 'rol',
    ];

    public function crearModeloVacio(){
        $this->modelo_editar =  User::make();
    }

    public function abrirModalEditar(User $modelo){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        if($this->modelo_editar->isNot($modelo))
            $this->modelo_editar = $modelo;

        $this->role = $modelo['roles'][0]['id'];

    }

    public function guardar(){

        $this->validate();

        if(User::where('name', $this->modelo_editar->name)->first()){

            $this->dispatch('mostrarMensaje', ['error', "El usuario " . $this->modelo_editar->name . " ya esta registrado."]);

            $this->resetearTodo();

            return;

        }

        try {

            DB::transaction(function () {

                $this->modelo_editar->password = bcrypt('sistema');
                $this->modelo_editar->creado_por = auth()->user()->id;
                $this->modelo_editar->save();

                $this->modelo_editar->roles()->attach($this->role);

                $this->resetearTodo();

                $this->dispatch('mostrarMensaje', ['success', "El usuario se creó con éxito."]);

            });

        } catch (\Throwable $th) {

            Log::error("Error al crear usuario por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }

    }

    public function actualizar(){

        $this->validate();

        try{

            DB::transaction(function () {

                $this->modelo_editar->actualizado_por = auth()->user()->id;
                $this->modelo_editar->save();

                $this->modelo_editar->roles()->sync($this->role);

                $this->resetearTodo();

                $this->dispatch('mostrarMensaje', ['success', "El usuario se actualizó con éxito."]);

            });

        } catch (\Throwable $th) {

            Log::error("Error al actualizar usuario por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }

    }

    public function borrar(){

        try{

            $usuario = User::find($this->selected_id);

            $usuario->delete();

            $this->resetearTodo($borrado = true);

            $this->dispatch('mostrarMensaje', ['success', "El usuario se eliminó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar usuario por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }

    }

    public function mount(){

        $this->crearModeloVacio();

        array_push($this->fields, 'role');

        $this->roles = Role::where('id', '!=', 1)->select('id', 'name')->orderBy('name')->get();

        $this->asociaciones = Constantes::ASOCIACIONES;

    }

    public function render()
    {

        $usuarios = User::with('creadoPor', 'actualizadoPor')->where('name', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('status', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('asociacion', 'LIKE', '%' . $this->search . '%')
                            ->orWhere(function($q){
                                return $q->whereHas('roles', function($q){
                                    return $q->where('name', 'LIKE', '%' . $this->search . '%');
                                });
                            })
                            ->orderBy($this->sort, $this->direction)
                            ->paginate($this->pagination);

        return view('livewire.admin.usuarios', compact('usuarios'))->extends('layouts.admin');

    }

}
