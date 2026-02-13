<x-section submit="crearTramite">
    <x-slot name="title">
        Refrendo
    </x-slot>

    <x-slot name="description">
        Ingresa el tramite de refrendo del año actual
    </x-slot>

    <x-slot name="form">

        <div class="mb-3   rounded-lg p-3 w-full col-span-6">

            <div class="mb-2 text-center">

                <Label class="tracking-widest rounded-xl border-gray-500">Buscar trámite</Label>

            </div>

            <div class="flex justify-center lg:w-1/2 mx-auto">

                <select class="bg-white rounded-l text-sm border border-r-transparent  focus:ring-0" wire:model="año">
                    @foreach ($años as $año)

                        <option value="{{ $año }}">{{ $año }}</option>

                    @endforeach
                </select>

                <input type="number" placeholder="Folio" min="1" class="bg-white text-sm w-20 focus:ring-0 @error('folio') border-red-500 @enderror" wire:model="folio">

                <input type="number" placeholder="Usuario" min="1" class="bg-white text-sm w-20 focus:ring-0 border-l-0 @error('usuario') border-red-500 @enderror" wire:model="usuario">

                <button
                    wire:click="buscarTramite"
                    wire:loading.attr="disabled"
                    wire:target="buscarTramite"
                    type="button"
                    class="bg-blue-400 hover:shadow-lg text-white font-bold px-4 rounded-r text-sm hover:bg-blue-700 focus:outline-blue-400 focus:outline-offset-2">

                    <img wire:loading wire:target="buscarTramite" class="mx-auto h-5 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                    <svg wire:loading.remove wire:target="buscarTramite" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>

                </button>

            </div>

        </div>

        <div class="mb-3  border border-gray-300 rounded-lg p-3 w-full col-span-6 overflow-auto space-y-4">

            <table class="w-full table-fixed">

                <thead class="border-b border-gray-300 ">

                    <tr class="text-sm text-gray-500 text-left traling-wider whitespace-nowrap">

                        <th class="px-2">Tramite</th>
                        <th class="px-2">Linea de captura</th>
                        <th class="px-2">Estado</th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200">

                    @foreach (auth()->user()->refrendos as $refrendo)

                        <tr class="text-gray-500 text-sm leading-relaxed">
                            <td class=" px-2 w-full">{{ $refrendo->año }}-{{ $refrendo->folio }}-{{ $refrendo->usuario }}</td>
                            <td class=" px-2 w-min">{{ $refrendo->linea_captura }}</td>
                            <td class=" px-2 w-min">{{ ucfirst($refrendo->estado) }}</td>
                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <div class="w-full col-span-6">

            @if($pdf)

                <div class="space-y-3">

                    <x-button-red
                        wire:click="descargarOrdenPago"
                        wire:loading.attr="disabled"
                        class="mx-auto">

                        <img wire:loading wire:target="descargarOrdenPago" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                        Descargar orden de pago
                    </x-button-red>

                    <form action="{{ $link_pago_linea }}" method="post" class="w-full">

                        <input type="hidden" name="concepto" value="{{ config('services.sap.concepto') }}">
                        <input type="hidden" name="lcaptura" value="{{ $linea_de_captura }}">
                        <input type="hidden" name="monto" value="{{ $monto }}">
                        <input type="hidden" name="urlRetorno" value="{{ route('acredita_pago') }}">
                        <input type="hidden" name="fecha_vencimiento" value="{{ $fecha_vencimiento }}">
                        <input type="hidden" name="tkn" value="{{ $token }}">

                        <x-button-blue
                            wire:loading.attr="disabled"
                            type="submit"
                            class="mx-auto">

                            <img wire:loading wire:target="pagarEnLinea" class="h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                            <p>Pagar en linea</p>

                        </x-button-blue>

                    </form>

                </div>

            @endif

        </div>

    </x-slot>

    <x-slot name="actions">

        <x-button wire:click="crearTramite" wire:loading.attr="disabled" >
            Generar trámite de refrendo
        </x-button>
    </x-slot>

</x-section>
