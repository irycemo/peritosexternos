<?php

namespace App\Livewire\Admin;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Models\Permission;
use Livewire\WithPagination;
use App\Constantes\Constantes;
use Illuminate\Validation\Rule;
use App\Traits\ComponentesTrait;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Usuarios extends Component
{

    use WithPagination;
    use ComponentesTrait;

    public $roles;
    public $role;
    public $areas_adscripcion;
    public $oficinas;
    public $modalPermisos = false;
    public $listaDePermisos = [];
    public $permisos;
    public $asociaciones;

    public $filters = [
        'rol' => '',
    ];

    public User $modelo_editar;

    protected function rules(){
        return [
            'modelo_editar.name' => 'required',
            'modelo_editar.email' => 'required|email|unique:users,email,' . $this->modelo_editar->id,
            'modelo_editar.status' => 'required|in:activo,inactivo',
            'role' => 'required',
            'modelo_editar.clave' => Rule::requiredIf($this->role != 4),
            'modelo_editar.cedula' => Rule::requiredIf($this->role != 4),
            'modelo_editar.especialidad' => Rule::requiredIf($this->role != 4),
            'modelo_editar.asociacion' => Rule::requiredIf($this->role != 4),
         ];
    }

    protected $validationAttributes  = [
        'role' => 'rol',
        'modelo_editar.cedula' => 'cédula',
        'modelo_editar.asociacion' => 'asociación',
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

        if(isset($modelo['roles'][0]))
            $this->role = $modelo->roles()->first()->id;

    }

    public function abrirModalPermisos(User $modelo){

        $this->resetearTodo();

        $this->modalPermisos = true;

        if($this->modelo_editar->isNot($modelo))
            $this->modelo_editar = $modelo;

        foreach($modelo->getAllPermissions() as $permission)
            array_push($this->listaDePermisos, (string)$permission['id']);


    }

    public function asignar(){

        try {

            DB::transaction(function () {

                $this->modelo_editar->syncPermissions([]);

                foreach ($this->listaDePermisos as $permiso)
                    $this->modelo_editar->givePermissionTo(Permission::find($permiso)->name);


                $this->resetearTodo();

                $this->dispatch('mostrarMensaje', ['success', "Se actualizaron los permisos con éxito."]);

            });

        } catch (\Throwable $th) {

            Log::error("Error al actualizar permisos usuario por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }

    }

    public function guardar(){

        $this->validate();

        if(User::where('name', $this->modelo_editar->name)->first()){

            $this->dispatch('mostrarMensaje', ['warning', "El usuario " . $this->modelo_editar->name . " ya esta registrado."]);

            $this->resetearTodo();

            return;

        }

        try {

            DB::transaction(function () {

                $this->modelo_editar->password = bcrypt('sistema');
                $this->modelo_editar->creado_por = auth()->id();
                $this->modelo_editar->clave = User::max('clave') + 1;
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

        if($this->revisarUsuariosUnicos()) return;

        try{

            DB::transaction(function () {

                $this->modelo_editar->actualizado_por = auth()->user()->id;
                $this->modelo_editar->save();

                $this->modelo_editar->roles()->sync($this->role);

                $this->resetearTodo($borrado = true);

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

    public function resetearPassword($id){

        try{

            $usuario = User::find($id);

            $usuario->password = bcrypt('sistema');
            $usuario->save();

            $this->resetearTodo($borrado = true);

            $this->dispatch('mostrarMensaje', ['success', "La contraseña se reestableció con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al resetear contraseña por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }

    }

    public function revisarUsuariosUnicos(){

        $role = Role::find($this->role)->first();

    }

    public function mount(){

        $this->crearModeloVacio();

        array_push($this->fields, 'role', 'listaDePermisos', 'modalPermisos');

        $this->roles = Role::where('id', '!=', 1)->select('id', 'name')->orderBy('name')->get();

        $permisos = Permission::all();

        $this->permisos = $permisos->groupBy(function($permiso) {
            return $permiso->area;
        })->all();

        $this->asociaciones = Constantes::ASOCIACIONES;

    }

    #[Computed]
    public function usuarios(){

        return User::with('creadoPor:id,name', 'actualizadoPor:id,name')
                        ->where(function($q){
                            $q->where('name', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('clave', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('email', 'LIKE', '%' . $this->search . '%');
                        })
                        ->when($this->filters['rol'], fn($q, $rol) => $q->whereHas('roles', function($q) use($rol){ $q->where('name', $rol); }))
                        ->orderBy($this->sort, $this->direction)
                        ->paginate($this->pagination);

    }

    public function render()
    {
        return view('livewire.admin.usuarios')->extends('layouts.admin');

    }

}
