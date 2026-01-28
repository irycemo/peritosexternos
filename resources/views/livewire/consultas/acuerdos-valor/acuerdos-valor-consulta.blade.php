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

        </div>

    </div>

    <div class="overflow-x-auto rounded-lg shadow-xl border-t-2 border-t-gray-500">

        <x-table>

            <x-slot name="head">

                <x-table.heading sortable wire:click="sortBy('año')" :direction="$sort === 'año' ? $direction : null" >Año</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('folio')" :direction="$sort === 'folio' ? $direction : null" >Folio</x-table.heading>
                <x-table.heading >Municipio</x-table.heading>
                <x-table.heading >Localidad</x-table.heading>
                <x-table.heading >Nombre del asentamiento</x-table.heading>
                <x-table.heading >Calles</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('valor_inicial')" :direction="$sort === 'valor_inicial' ? $direction : null" >Valor inicial</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('valor_actualizado')" :direction="$sort === 'valor_actualizado' ? $direction : null" >Valor actualizado</x-table.heading>

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

</div>
