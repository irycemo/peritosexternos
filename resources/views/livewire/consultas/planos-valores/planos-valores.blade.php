<div>

    <x-header>Planos de valores</x-header>

    <div class="overflow-x-auto rounded-lg shadow-xl border-t-2 border-t-gray-500 lg:w-1/2 mx-auto w-full">

        <x-table class="mx-auto">

            <x-slot name="head">

                <x-table.heading >Archivo</x-table.heading>
                <x-table.heading >Link</x-table.heading>

            </x-slot>

            <x-slot name="body">

                @forelse ($planos as $key => $plano)

                    <x-table.row wire:loading.class.delaylongest="opacity-50" wire:key="row-{{ $key }}">

                        <x-table.cell title="Archivo">

                            {{ $plano['name'] }}

                        </x-table.cell>

                        <x-table.cell title="Link">

                            <x-link-blue href="{{ $plano['url'] }}" target="_blank" class="w-min">Link</x-link-blue>

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

            <x-slot name="tfoot"></x-slot>

        </x-table>

    </div>

</div>
