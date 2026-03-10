<div class="">

    <div class="mb-2 lg:mb-5">

        <x-header>Valores unitarios de construcción</x-header>

        <div class="flex gap-3 overflow-auto p-1">

            <input type="text" wire:model.live.debounce.500ms="tipo" placeholder="Tipo" class="bg-white rounded-full text-sm">

            <input type="text" wire:model.live.debounce.500ms="uso" placeholder="Uso" class="bg-white rounded-full text-sm">

            <input type="text" wire:model.live.debounce.500ms="estado" placeholder="Estado" class="bg-white rounded-full text-sm">

            <input type="text" wire:model.live.debounce.500ms="calidad" placeholder="Calidad" class="bg-white rounded-full text-sm">

            <select class="bg-white rounded-full text-sm" wire:model.live="pagination">

                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>

            </select>

        </div>

    </div>

    <div class="overflow-x-auto rounded-lg shadow-xl border-t-2 border-t-gray-500">

        <x-table>

            <x-slot name="head">

                <x-table.heading sortable wire:click="sortBy('tipo')" :direction="$sort === 'tipo' ? $direction : null" >Tipo</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('uso')" :direction="$sort === 'uso' ? $direction : null" >Uso</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('estado')" :direction="$sort === 'estado' ? $direction : null" >Categoría</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('calidad')" :direction="$sort === 'calidad' ? $direction : null" >Calidad</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('valor')" :direction="$sort === 'valor' ? $direction : null" >Valor</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('valor_aterior')" :direction="$sort === 'valor' ? $direction : null" >Valor anterior</x-table.heading>
                <x-table.heading>Acciones</x-table.heading>

            </x-slot>

            <x-slot name="body">

                @forelse ($this->valores as $valor)

                    <x-table.row wire:loading.class.delaylongest="opacity-50" wire:key="row-{{ $valor->id }}">

                        <x-table.cell title="Tipo">

                            {{ $valor->tipo }}

                        </x-table.cell>

                        <x-table.cell title="Uso">

                            {{ $valor->uso }}

                        </x-table.cell>

                        <x-table.cell title="Categoría">

                            {{ $valor->estado }}

                        </x-table.cell>

                        <x-table.cell title="Calidad">

                            {{ $valor->calidad }}

                        </x-table.cell>

                        <x-table.cell title="Valor">

                            ${{ number_format($valor->valor, 2) }}

                        </x-table.cell>

                        <x-table.cell title="Valor anterior">

                            ${{ number_format($valor->valor_aterior, 2) }}

                        </x-table.cell>

                        <x-table.cell title="Acciones">

                            <div class="ml-3 relative" x-data="{ open_drop_down:false }">

                                <div>

                                    <button x-on:click="open_drop_down=true" type="button" class="rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                        </svg>

                                    </button>

                                </div>

                                <div x-cloak x-show="open_drop_down" x-on:click="open_drop_down=false" x-on:click.away="open_drop_down=false" class="z-50 origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">

                                    <button
                                        wire:click="abrirModalEditar({{ $valor->id }})"
                                        wire:target="abrirModalEditar({{ $valor->id }})"
                                        wire:loading.attr="disabled"
                                        class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                        role="menuitem">
                                        Editar
                                    </button>

                                </div>

                            </div>

                        </x-table.cell>

                    </x-table.row>

                @empty

                    <x-table.row wire:key="row-empty">

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

                        {{ $this->valores->links()}}

                    </x-table.cell>

                </x-table.row>

            </x-slot>

        </x-table>

    </div>

    <x-dialog-modal wire:model="modal" maxWidth="sm">

        <x-slot name="title">

            Editar Valor

        </x-slot>

        <x-slot name="content">

            <x-input-group for="modelo_editar.tipo" label="Tipo" :error="$errors->first('modelo_editar.tipo')" class="w-full">

                <x-input-text type="number" id="modelo_editar.tipo" wire:model="modelo_editar.tipo" />

            </x-input-group>

            <x-input-group for="modelo_editar.uso" label="Uso" :error="$errors->first('modelo_editar.uso')" class="w-full">

                <x-input-text type="number" id="modelo_editar.uso" wire:model="modelo_editar.uso" />

            </x-input-group>

            <x-input-group for="modelo_editar.estado" label="Estado" :error="$errors->first('modelo_editar.estado')" class="w-full">

                <x-input-text type="number" id="modelo_editar.estado" wire:model="modelo_editar.estado" />

            </x-input-group>

            <x-input-group for="modelo_editar.calidad" label="Calidad" :error="$errors->first('modelo_editar.calidad')" class="w-full">

                <x-input-text type="number" id="modelo_editar.calidad" wire:model="modelo_editar.calidad" />

            </x-input-group>

            <x-input-group for="modelo_editar.valor" label="Valor" :error="$errors->first('modelo_editar.valor')" class="w-full">

                <x-input-text type="number" id="modelo_editar.valor" wire:model="modelo_editar.valor" />

            </x-input-group>

            <x-input-group for="modelo_editar.valor_aterior" label="Valor anterior" :error="$errors->first('modelo_editar.valor_aterior')" class="w-full">

                <x-input-text type="number" id="modelo_editar.valor_aterior" wire:model="modelo_editar.valor_aterior" />

            </x-input-group>

        </x-slot>

        <x-slot name="footer">

            <div class="flex gap-3">

                <x-button-blue
                    wire:click="actualizar"
                    wire:loading.attr="disabled"
                    wire:target="actualizar">

                    <img wire:loading wire:target="actualizar" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                    <span>Actualizar</span>
                </x-button-blue>

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

</div>
