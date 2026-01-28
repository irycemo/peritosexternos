<div class="">

    <div class="mb-5">

        <x-header>Acuerdos de valor</x-header>

        <div class="flex justify-between">

            <div class="flex gap-3">

                <input type="text" wire:model.live.debounce.500ms="search" placeholder="Buscar" class="bg-white rounded-full text-sm">

                <x-input-select class="bg-white rounded-full text-sm w-min" wire:model.live="pagination">

                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>

                </x-input-select>

            </div>

            @can('Crear acuerdo')

                <button wire:click="abrirModalCrear" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 text-sm py-2 px-4 text-white rounded-full hidden md:block items-center justify-center focus:outline-gray-400 focus:outline-offset-2">

                    <img wire:loading wire:target="abrirModalCrear" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                    Agregar nuevo acuerdo

                </button>

                <button wire:click="abrirModalCrear" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 float-right text-sm py-2 px-4 text-white rounded-full md:hidden focus:outline-gray-400 focus:outline-offset-2">+</button>

            @endcan

        </div>

    </div>

    <div class="overflow-x-auto rounded-lg shadow-xl border-t-2 border-t-gray-500">

        <x-table>

            <x-slot name="head">

                <x-table.heading sortable wire:click="sortBy('año')" :direction="$sort === 'año' ? $direction : null" >Año</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('folio')" :direction="$sort === 'folio' ? $direction : null" >Folio</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('municipio')" :direction="$sort === 'municipio' ? $direction : null" >Municipio</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('localidad')" :direction="$sort === 'localidad' ? $direction : null" >Localidad</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('nombre_asentamiento')" :direction="$sort === 'nombre_asentamiento' ? $direction : null" >Nombre del asentamiento</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('calles')" :direction="$sort === 'calles' ? $direction : null" >Calles</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('valor_inicial')" :direction="$sort === 'valor_inicial' ? $direction : null" >Valor inicial</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('valor_actualizado')" :direction="$sort === 'valor_actualizado' ? $direction : null" >Valor actualizado</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('created_at')" :direction="$sort === 'created_at' ? $direction : null">Registro</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('updated_at')" :direction="$sort === 'updated_at' ? $direction : null">Actualizado</x-table.heading>
                <x-table.heading >Acciones</x-table.heading>

            </x-slot>

            <x-slot name="body">

                @forelse ($this->acuerdos as $acuerdo)

                    <x-table.row wire:loading.class.delaylongest="opacity-50" wire:key="row-{{ $acuerdo->id }}">

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 text-[10px] text-white font-bold uppercase rounded-br-xl">Año</span>

                            {{ $acuerdo->año }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 text-[10px] text-white font-bold uppercase rounded-br-xl">Folio</span>

                            {{ $acuerdo->folio }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 text-[10px] text-white font-bold uppercase rounded-br-xl">Municipio</span>

                            {{ $acuerdo->municipio }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 text-[10px] text-white font-bold uppercase rounded-br-xl">localidad</span>

                            {{ $acuerdo->localidad }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 text-[10px] text-white font-bold uppercase rounded-br-xl">Nombre  del asentamiento</span>

                            {{ $acuerdo->nombre_asentamiento }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 text-[10px] text-white font-bold uppercase rounded-br-xl">Calles</span>

                            {{ $acuerdo->calles }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 text-[10px] text-white font-bold uppercase rounded-br-xl">Valor inicial</span>

                            ${{ number_format($acuerdo->valor_inicial, 2) }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 text-[10px] text-white font-bold uppercase rounded-br-xl">Valor actualizado</span>

                            ${{ number_format($acuerdo->valor_actualizado, 2) }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 text-[10px] text-white font-bold uppercase rounded-br-xl">Registrado</span>

                            <p class="mt-2">

                                <span class="font-semibold">@if($acuerdo->creadoPor != null)Registrado por: {{$acuerdo->creadoPor->name}} @else Registro: @endif</span> <br>

                                {{ $acuerdo->created_at }}

                            </p>

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 text-[10px] text-white font-bold uppercase rounded-br-xl">Actualizado</span>

                            <p class="mt-2">

                                <span class="font-semibold">@if($acuerdo->actualizadoPor != null)Actualizado por: {{$acuerdo->actualizadoPor->name}} @else Actualizado: @endif</span> <br>

                                {{ $acuerdo->updated_at }}

                            </p>

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 text-[10px] text-white font-bold uppercase rounded-br-xl">Acciones</span>

                            <div class="ml-3 relative" x-data="{ open_drop_down:false }">

                                <div>

                                    <button x-on:click="open_drop_down=true" type="button" class="rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                        </svg>

                                    </button>

                                </div>

                                <div x-cloak x-show="open_drop_down" x-on:click="open_drop_down=false" x-on:click.away="open_drop_down=false" class="z-50 origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">

                                    @can('Editar acuerdo')

                                        <button
                                            wire:click="abrirModalEditar({{ $acuerdo->id }})"
                                            wire:target="abrirModalEditar({{ $acuerdo->id }})"
                                            wire:loading.attr="disabled"
                                            class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                            role="menuitem">
                                            Editar
                                        </button>

                                    @endcan

                                    @can('Borrar acuerdo')

                                        <button
                                            wire:click="abrirModalBorrar({{ $acuerdo->id }})"
                                            wire:target="abrirModalBorrar({{ $acuerdo->id }})"
                                            wire:loading.attr="disabled"
                                            class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                            role="menuitem">
                                            Borrar
                                        </button>

                                    @endcan

                                </div>

                            </div>

                        </x-table.cell>

                    </x-table.row>

                @empty

                    <x-table.row>

                        <x-table.cell colspan="11">

                            <div class="bg-white text-gray-500 text-center p-5 rounded-full text-lg">

                                No hay resultados.

                            </div>

                        </x-table.cell>

                    </x-table.row>

                @endforelse

            </x-slot>

            <x-slot name="tfoot">

                <x-table.row>

                    <x-table.cell colspan="11" class="bg-gray-50">

                        {{ $this->acuerdos->links()}}

                    </x-table.cell>

                </x-table.row>

            </x-slot>

        </x-table>

    </div>

    <x-dialog-modal wire:model="modal" maxWidth="sm">

        <x-slot name="title">

            @if($crear)
                Nuevo acuerdo
            @elseif($editar)
                Editar acuerdo
            @endif

        </x-slot>

        <x-slot name="content">

            <div class="space-y-2">

                <x-input-group for="modelo_editar.año" label="Año" :error="$errors->first('modelo_editar.año')" class="w-full">

                    <x-input-text type="number" id="modelo_editar.año" wire:model="modelo_editar.año" />

                </x-input-group>

                <x-input-group for="modelo_editar.folio" label="Folio" :error="$errors->first('modelo_editar.folio')" class="w-full">

                    <x-input-text id="modelo_editar.folio" wire:model="modelo_editar.folio" />

                </x-input-group>

                <x-input-group for="modelo_editar.municipio" label="Municipio" :error="$errors->first('modelo_editar.municipio')" class="w-full">

                    <x-input-text id="modelo_editar.municipio" wire:model="modelo_editar.municipio" />

                </x-input-group>

                <x-input-group for="modelo_editar.localidad" label="Localidad" :error="$errors->first('modelo_editar.localidad')" class="w-full">

                    <x-input-text id="modelo_editar.localidad" wire:model="modelo_editar.localidad" />

                </x-input-group>

                <x-input-group for="modelo_editar.nombre_asentamiento" label="Nombre del asentamiento" :error="$errors->first('modelo_editar.nombre_asentamiento')" class="w-full">

                    <x-input-text id="modelo_editar.nombre_asentamiento" wire:model="modelo_editar.nombre_asentamiento" />

                </x-input-group>

                <x-input-group for="modelo_editar.valor_inicial" label="Valor inicial" :error="$errors->first('modelo_editar.valor_inicial')" class="w-full">

                    <x-input-text type="number" id="modelo_editar.valor_inicial" wire:model="modelo_editar.valor_inicial" />

                </x-input-group>

                <x-input-group for="modelo_editar.calles" label="Calles" :error="$errors->first('modelo_editar.calles')" class="w-full">

                    <x-input-text  id="modelo_editar.calles" wire:model="modelo_editar.calles" />

                </x-input-group>

            </div>

        </x-slot>

        <x-slot name="footer">

            <div class="flex gap-3">

                @if($crear)

                    <x-button-blue
                        wire:click="guardar"
                        wire:loading.attr="disabled"
                        wire:target="guardar">

                        <img wire:loading wire:target="guardar" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                        <span>Guardar</span>
                    </x-button-blue>

                @elseif($editar)

                    <x-button-blue
                        wire:click="actualizar"
                        wire:loading.attr="disabled"
                        wire:target="actualizar">

                        <img wire:loading wire:target="actualizar" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                        <span>Actualizar</span>
                    </x-button-blue>

                @endif

                <x-button-red
                    wire:click="resetearTodo"
                    wire:loading.attr="disabled"
                    wire:target="resetearTodo"
                    type="button">
                    Cerrar
                </x-button-red>

            </div>

        </x-slot>

    </x-dialog-modal>

    <x-confirmation-modal wire:model="modalBorrar" maxWidth="sm">

        <x-slot name="title">
            Eliminar acuerdo
        </x-slot>

        <x-slot name="content">
            ¿Esta seguro que desea eliminar el acuerdo? No sera posible recuperar la información.
        </x-slot>

        <x-slot name="footer">

            <x-secondary-button
                wire:click="$toggle('modalBorrar')"
                wire:loading.attr="disabled"
            >
                No
            </x-secondary-button>

            <x-danger-button
                class="ml-2"
                wire:click="borrar"
                wire:loading.attr="disabled"
                wire:target="borrar"
            >
                Borrar
            </x-danger-button>

        </x-slot>

    </x-confirmation-modal>

</div>
