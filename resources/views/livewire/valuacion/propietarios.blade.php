<div class="">

    @include('livewire.valuacion.comun.avaluo-folio')

    <div class="">

        <div class="mb-3 bg-white rounded-lg p-3 shadow-lg">

            <span class="flex items-center justify-center text-lg text-gray-700 mb-5">Propietarios</span>
{{--
            <div class="flex justify-end mb-2">

                <div class="flex justify-end mb-2">

                    @livewire('valuacion.propietario-crear', ['modelo' => $predio])

                </div>

            </div> --}}

            <x-table>

                <x-slot name="head">
                    <x-table.heading >Nombre / Razón social</x-table.heading>
                    <x-table.heading >Porcentaje propiedad</x-table.heading>
                    <x-table.heading >Porcentaje nuda</x-table.heading>
                    <x-table.heading >Porcentaje usufructo</x-table.heading>
                    {{-- <x-table.heading ></x-table.heading> --}}
                </x-slot>

                <x-slot name="body">

                    @if($predio)

                        @foreach ($predio->propietarios as $propietario)

                            <x-table.row wire:key="row-{{ $propietario->id }}">

                                <x-table.cell>{{ $propietario->persona->nombre }} {{ $propietario->persona->ap_paterno }} {{ $propietario->persona->ap_materno }} {{ $propietario->persona->razon_social }}</x-table.cell>
                                <x-table.cell>{{ $propietario->porcentaje_propiedad }}%</x-table.cell>
                                <x-table.cell>{{ $propietario->porcentaje_nuda }}%</x-table.cell>
                                <x-table.cell>{{ $propietario->porcentaje_usufructo }}%</x-table.cell>
                                {{-- <x-table.cell>
                                    <div class="flex items-center gap-3">
                                        <div>

                                            <livewire:valuacion.propietario-actualizar :propietario="$propietario" :predio="$predio" wire:key="button-propietario-{{ $propietario->id }}" />

                                        </div>
                                        <x-button-red
                                            wire:click="borrarActor({{ $propietario->id }})"
                                            wire:loading.attr="disabled">
                                            Borrar
                                        </x-button-red>
                                    </div>
                                </x-table.cell> --}}

                            </x-table.row>

                        @endforeach

                    @endif

                </x-slot>

                <x-slot name="tfoot"></x-slot>

            </x-table>

        </div>

    </div>

</div>