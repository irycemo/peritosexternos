<div>

    <x-header>Usuario</x-header>

    <div class="flex justify-end mb-5 relative" x-data="{ open_drop_down:false }">

        <div>

            <button x-on:click="open_drop_down=true" type="button" class="border-gray-500 border-2 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>

            </button>

        </div>

        <div x-cloak x-show="open_drop_down" x-on:click="open_drop_down=false" x-on:click.away="open_drop_down=false" class="z-50 origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">

            <button
                wire:click="activarPerito"
                wire:loading.attr="disabled"
                wire:confirm="¿Esta seguro que desea activar al perito?"
                class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                role="menuitem">
                Autorizar perito
            </button>

            <button
                wire:click="$toggle('modal_rechazar')"
                wire:loading.attr="disabled"
                class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                role="menuitem">
                Rechazar
            </button>

        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 mb-5">

        <div class="col-span-1 lg:col-span-3">

            @if($user->foto)

                <img class="rounded-lg h-80 mx-auto" src="{{ $user->foto->getLink() }}" alt="Foto">

            @else

                <img class="rounded-lg h-80 mx-auto" src="{{ asset('storage/img/unknown_user.png') }}" alt="Foto">

            @endif

        </div>

        <div class="col-span-1 lg:col-span-9">

            <div class="bg-white p-4 rounded-lg shadow-xl grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-sm mb-5">

                <div class="rounded-lg bg-gray-100 py-1 px-2">

                    <strong>Nombre</strong>

                    <p>{{ $user->name }}</p>

                </div>

                <div class="rounded-lg bg-gray-100 py-1 px-2">

                    <strong>Estado</strong>

                    <p>{{ ucfirst($user->status) }}</p>

                </div>

                <div class="rounded-lg bg-gray-100 py-1 px-2">

                    <strong>Clave</strong>

                    <p>{{ $user->clave }}</p>

                </div>

                <div class="rounded-lg bg-gray-100 py-1 px-2">

                    <strong>Correo</strong>

                    <p>{{ $user->email }}</p>

                </div>

                <div class="rounded-lg bg-gray-100 py-1 px-2">

                    <strong>Asociación</strong>

                    <p>{{ $user->asociacion }}</p>

                </div>

            </div>

            <div class="bg-white p-4 rounded-lg shadow-xl grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">

                <div class="rounded-lg bg-gray-100 py-1 px-2 flex justify-between items-center">

                    <strong>Acta de nacimiento</strong>

                    @if($user->actaNacimiento)

                        <a href="{{ $user->actaNacimiento->getLink() }}" target="_blank">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                            </svg>

                        </a>

                    @else

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>


                    @endif

                </div>

                <div class="rounded-lg bg-gray-100 py-1 px-2 flex justify-between items-center">

                    <strong>Comprobante de recidencia</strong>

                    @if($user->comprobanteRecidencia)

                        <a href="{{ $user->comprobanteRecidencia->getLink() }}" target="_blank">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                            </svg>

                        </a>

                    @else

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>


                    @endif

                </div>

                <div class="rounded-lg bg-gray-100 py-1 px-2 flex justify-between items-center">

                    <strong>Curriculum</strong>

                    @if($user->curriculum)

                        <a href="{{ $user->curriculum->getLink() }}" target="_blank">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                            </svg>

                        </a>

                    @else

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>


                    @endif

                </div>

                <div class="rounded-lg bg-gray-100 py-1 px-2 flex justify-between items-center">

                    <strong>Cédula de especialidad</strong>

                    @if($user->cedulaEspecialidad)

                        <a href="{{ $user->cedulaEspecialidad->getLink() }}" target="_blank">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                            </svg>

                        </a>

                    @else

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>


                    @endif

                </div>

                <div class="rounded-lg bg-gray-100 py-1 px-2 flex justify-between items-center">

                    <strong>Fianza</strong>

                    @if($user->fianza)

                        <a href="{{ $user->fianza->getLink() }}" target="_blank">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                            </svg>

                        </a>

                    @else

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>


                    @endif

                </div>

                <div class="rounded-lg bg-gray-100 py-1 px-2 flex justify-between items-center">

                    <strong>Pago de renovación de credencial</strong>

                    @if($user->pagoCredencial)

                        <a href="{{ $user->pagoCredencial->getLink() }}" target="_blank">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                            </svg>

                        </a>

                    @else

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>


                    @endif

                </div>

                <div class="rounded-lg bg-gray-100 py-1 px-2 flex justify-between items-center">

                    <strong>Registro de asociación</strong>

                    @if($user->registroAsociacion)

                        <a href="{{ $user->registroAsociacion->getLink() }}" target="_blank">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                            </svg>

                        </a>

                    @else

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>


                    @endif

                </div>

            </div>

        </div>

    </div>

    <div class="flex gap-3 mb-5 overflow-auto p-1">

        <select class="bg-white rounded-full text-sm" wire:model.live="filters.estado">

            <option value="">Estado</option>
            <option value="nuevo">Nuevo</option>
            <option value="conciliacion">Conciliación</option>
            <option value="concluido">Concluido</option>
            <option value="operado">Operado</option>

        </select>

        <select class="bg-white rounded-full text-sm" wire:model.live="filters.año">

            @foreach ($años as $año)

                <option value="{{ $año }}">{{ $año }}</option>

            @endforeach

        </select>

        <input type="number" wire:model.live.debounce.500mse="filters.folio" placeholder="Folio" class="bg-white rounded-full text-sm w-24">

        <input type="number" wire:model.live.debounce.500mse="filters.localidad" placeholder="Localidad" class="bg-white rounded-full text-sm w-24">

        <input type="number" wire:model.live.debounce.500mse="filters.oficina" placeholder="Oficina" class="bg-white rounded-full text-sm w-24">

        <input type="number" wire:model.live.debounce.500mse="filters.tipo" placeholder="Tipo" class="bg-white rounded-full text-sm w-24">

        <input type="number" wire:model.live.debounce.500mse="filters.registro" placeholder="Registro" class="bg-white rounded-full text-sm w-24">

        <x-input-select class="bg-white rounded-full text-sm w-min" wire:model.live="pagination">

            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>

        </x-input-select>

    </div>

    <div class="overflow-x-auto rounded-lg shadow-xl border-t-2 border-t-gray-500">

        <x-table>

            <x-slot name="head">

                <x-table.heading sortable wire:click="sortBy('año')" :direction="$sort === 'año' ? $direction : null" >Año</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('folio')" :direction="$sort === 'folio' ? $direction : null" >Folio</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('estado')" :direction="$sort === 'estado' ? $direction : null" >Estado</x-table.heading>
                <x-table.heading >Cuenta predial</x-table.heading>
                <x-table.heading >Propietario</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('created_at')" :direction="$sort === 'created_at' ? $direction : null">Registro</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('updated_at')" :direction="$sort === 'updated_at' ? $direction : null">Actualizado</x-table.heading>
                <x-table.heading >Acciones</x-table.heading>

            </x-slot>

            <x-slot name="body">

                @forelse ($this->avaluos as $avaluo)

                    <x-table.row wire:loading.class.delaylongest="opacity-50" wire:key="row-{{ $avaluo->id }}">

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 text-[10px] text-white font-bold uppercase rounded-br-xl">Año</span>

                            {{ $avaluo->año }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 text-[10px] text-white font-bold uppercase rounded-br-xl">Folio</span>

                            {{ $avaluo->folio }}-{{ $avaluo->usuario }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 text-[10px] text-white font-bold uppercase rounded-br-xl">Estado</span>

                            <span class="bg-{{ $avaluo->estado_color }} py-1 px-2 rounded-full text-white text-xs">{{ ucfirst($avaluo->estado) }}</span>

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 text-[10px] text-white font-bold uppercase rounded-br-xl">Cuenta predial</span>

                            {{ $avaluo->predio->cuentaPredial() }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 text-[10px] text-white font-bold uppercase rounded-br-xl">Propietario</span>

                            <p class="mt-2">{{ $avaluo->predio->primerPropietario() }}</p>

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 text-[10px] text-white font-bold uppercase rounded-br-xl">Registrado</span>

                            <p class="mt-2">

                                {{ $avaluo->created_at }}

                            </p>

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 text-[10px] text-white font-bold uppercase rounded-br-xl">Actualizado</span>

                            <p class="mt-2">

                                {{ $avaluo->updated_at }}

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

                                    <a
                                        href="{{ route('ver_avaluo', $avaluo) }}"
                                        class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                        role="menuitem">
                                        Ver
                                    </a>

                                </div>

                            </div>

                        </x-table.cell>

                    </x-table.row>

                @empty

                    <x-table.row>

                        <x-table.cell colspan="9">

                            <div class="bg-white text-gray-500 text-center p-5 rounded-full text-lg">

                                No hay resultados.

                            </div>

                        </x-table.cell>

                    </x-table.row>

                @endforelse

            </x-slot>

            <x-slot name="tfoot">

                <x-table.row>

                    <x-table.cell colspan="9" class="bg-gray-50">

                        {{ $this->avaluos->links() }}

                    </x-table.cell>

                </x-table.row>

            </x-slot>

        </x-table>

    </div>

    <x-dialog-modal wire:model="modal_rechazar" maxWidth="sm">

        <x-slot name="title">

            Rechazar

        </x-slot>

        <x-slot name="content">

            <x-input-group for="observacion" label="Observación" :error="$errors->first('observacion')">

                <textarea class="bg-white rounded text-xs w-full " rows="4" wire:model="observacion" placeholder="Se lo más especifico sobre el rechazo."></textarea>

            </x-input-group>

        </x-slot>

        <x-slot name="footer">

            <div class="flex gap-3">

                <x-button-blue
                    wire:click="rechazar"
                    wire:loading.attr="disabled"
                    wire:target="rechazar">

                    <img wire:loading wire:target="rechazar" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                    Rechazar
                </x-button-blue>

                <x-button-red
                    wire:click="$toggle('modal_rechazar')"
                    wire:loading.attr="disabled"
                    wire:target="$toggle('modal_rechazar')"
                    type="button">
                    Cerrar
                </x-button-red>

            </div>

        </x-slot>

    </x-dialog-modal>

</div>
