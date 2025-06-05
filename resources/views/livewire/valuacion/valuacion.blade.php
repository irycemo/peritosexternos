<div class="">

    @include('livewire.valuacion.comun.avaluo-folio')

    <div class="space-y-2 mb-5 bg-white rounded-lg p-2 shadow-xl">

        <h4 class="text-lg mb-5 text-center">Consultar predio</h4>

        <div class="flex-auto ">

            @include('livewire.valuacion.comun.cuenta-clave')

            <div class="mb-2 flex-col sm:flex-row mx-auto mt-5 flex space-y-2 sm:space-y-0 sm:space-x-3 justify-center">

                <button
                    wire:click="buscarCuentaPredial"
                    wire:loading.attr="disabled"
                    wire:target="buscarCuentaPredial"
                    type="button"
                    class="bg-blue-400 hover:shadow-lg text-white font-bold px-4 py-2 rounded text-xs hover:bg-blue-700 focus:outline-none flex items-center justify-center focus:outline-blue-400 focus:outline-offset-2">

                    <img wire:loading wire:target="buscarCuentaPredial" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                    Consultar cuenta predial

                </button>

            </div>

        </div>

    </div>

    @include('livewire.valuacion.comun.ubicacion-predio')

    @include('livewire.valuacion.comun.coordenadas')

    @include('livewire.valuacion.comun.errores')

    <div class="bg-white rounded-lg p-3 flex justify-end  shadow-xl">

        @if(!$editar)

            <x-button-green
                wire:click="crearAvaluo"
                wire:loading.attr="disabled"
                wire:target="crearAvaluo">

                <img wire:loading wire:target="crearAvaluo" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                Guardar

            </x-button-green>

        @elseif($predio?->avaluo?->estado === 'nuevo')

            <x-button-green
                wire:click="actualizarAvaluo"
                wire:loading.attr="disabled"
                wire:target="actualizarAvaluo">

                <img wire:loading wire:target="actualizarAvaluo" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                Actualizar

            </x-button-green>

        @endif

    </div>

</div>