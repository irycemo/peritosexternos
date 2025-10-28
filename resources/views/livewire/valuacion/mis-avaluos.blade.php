<div class="">

    <div class="mb-6">

        <x-header>Mis avaluos</x-header>

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

        </div>

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


                            <span class="font-semibold">@if($avaluo->creadoPor != null)Registrado por: {{$avaluo->creadoPor->name}} @else Registro: @endif</span> <br>

                            {{ $avaluo->created_at }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="font-semibold">@if($avaluo->actualizadoPor != null)Actualizado por: {{$avaluo->actualizadoPor->name}} @else Actualizado: @endif</span> <br>

                            {{ $avaluo->updated_at }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 text-[10px] text-white font-bold uppercase rounded-br-xl">Acciones</span>

                            <div class="flex justify-center lg:justify-start gap-2">

                                <div class="ml-3 relative" x-data="{ open_drop_down:false }">

                                    <div>

                                        <button x-on:click="open_drop_down=true" type="button" class="rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                            </svg>

                                        </button>

                                    </div>

                                    <div x-cloak x-show="open_drop_down" x-on:click="open_drop_down=false" x-on:click.away="open_drop_down=false" class="z-50 origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">

                                        @if($avaluo->predio)

                                            @if($avaluo->firmaElectronica)

                                                <button
                                                    wire:click="reimprimir('{{ $avaluo->firmaElectronica->uuid }}')"
                                                    wire:loading.attr="disabled"
                                                    class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                                    role="menuitem">
                                                    Reimprimir
                                                </button>

                                            @else

                                                <button
                                                    wire:click="imprimir({{ $avaluo->id }})"
                                                    wire:loading.attr="disabled"
                                                    class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                                    role="menuitem">
                                                    Imprimir
                                                </button>

                                            @endif

                                            @if(in_array($avaluo->estado, ['impreso']))

                                                <button
                                                    wire:click="reactivarAvaluo({{ $avaluo->id }})"
                                                    wire:loading.attr="disabled"
                                                    class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                                    role="menuitem">
                                                    Reactivar avalúo
                                                </button>

                                            @endif

                                            @if(in_array($avaluo->estado, ['nuevo', 'impreso', 'conciliar']))

                                                <a href="{{ route('valuacion', $avaluo->id) }}" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100" role="menuitem">Ver</a>

                                                <button
                                                    wire:click="abrirModalConcluir({{ $avaluo->id }})"
                                                    wire:loading.attr="disabled"
                                                    class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                                    role="menuitem">
                                                    Concluir avalúo
                                                </button>

                                            @endif

                                        @endif

                                    </div>

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

    <x-dialog-modal wire:model="modalConcluir" maxWidth="sm">

        <x-slot name="title">

            Firma electrónica

        </x-slot>

        <x-slot name="content">

            <div class="flex flex-col md:flex-row justify-between gap-3 mb-3">

                <x-input-group for="contraseña" label="Contraseña" :error="$errors->first('contraseña')" class="w-full">

                    <x-input-text  id="contraseña" wire:model="contraseña" />

                </x-input-group>

            </div>

            <div class="flex flex-col md:flex-row justify-between gap-3 mb-3">

                <x-input-group for="cer" label="Archio CER" :error="$errors->first('cer')" class="w-full">

                    <div x-data="{ focused: false }" class="w-full">

                        <span class="rounded-md shadow-sm w-full ">

                            <input @focus="focused = true" @blur="focused = false" class="sr-only" type="file" wire:model.live="cer" id="cer">

                            <label for="cer" :class="{ 'outline-none border-blue-300 shadow-outline-blue': focused }" class="relative flex items-center justify-between w-full cursor-pointer py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                                Selecccione el archivo

                                <div wire:loading.flex wire:target="cer" class="flex absolute top-1 right-1 items-center">
                                    <svg class="animate-spin h-4 w-4 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </div>

                                @if($cer)

                                    <span class=" text-blue-700">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 rounded-full border border-blue-700">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                        </svg>

                                    </span>

                                @endif

                            </label>

                        </span>

                    </div>

                </x-input-group>

            </div>

            <div class="flex flex-col md:flex-row justify-between gap-3 mb-3">

                <x-input-group for="key" label="Archio KEY" :error="$errors->first('key')" class="w-full">

                    <div x-data="{ focused: false }" class="w-full">

                        <span class="rounded-md shadow-sm w-full ">

                            <input @focus="focused = true" @blur="focused = false" class="sr-only" type="file" wire:model.live="key" id="key">

                            <label for="key" :class="{ 'outline-none border-blue-300 shadow-outline-blue': focused }" class="flex items-center relative justify-between w-full cursor-pointer py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                                Selecccione el archivo

                                <div wire:loading.flex wire:target="key" class="flex absolute top-1 right-1 items-center">
                                    <svg class="animate-spin h-4 w-4 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </div>

                                @if($key)

                                    <span class=" text-blue-700">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 rounded-full border border-blue-700">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                        </svg>

                                    </span>

                                @endif

                            </label>

                        </span>

                    </div>

                </x-input-group>

            </div>

        </x-slot>

        <x-slot name="footer">

            <div class="flex gap-3">

                <x-button-blue
                    wire:click="concluirAvaluo"
                    wire:loading.attr="disabled"
                    wire:target="concluirAvaluo">

                    <img wire:loading wire:target="concluirAvaluo" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                    <span>Concluir avalúo</span>
                </x-button-blue>

                <x-button-red
                    wire:click="$toggle('modalConcluir')"
                    wire:loading.attr="disabled"
                    wire:target="$toggle('modalConcluir')"
                    type="button">
                    Cerrar
                </x-button-red>

            </div>

        </x-slot>

    </x-dialog-modal>

</div>
