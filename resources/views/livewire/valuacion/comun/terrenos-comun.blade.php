<div class="bg-white shadow-xl rounded-lg p-4">

    <h4 class="text-lg mb-5 text-center">Terrenos de área común</h4>

    <div class="mb-5  divide-y">

        @foreach ($terrenosComun as $index => $item)

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-6 gap-3 items-start mb-2 bg-gray-50 p-4 rounded-lg" wire:key="terrenoComun-"{{ $index }}>

                <div class="flex-auto lg:col-span-1">

                    <div>

                        <label class="text-sm" >Área común de terreno</label>

                    </div>

                    <div>

                        <input type="number" class="bg-white rounded text-xs w-full" wire:model.blur="terrenosComun.{{ $index }}.area_terreno_comun">

                    </div>

                    <div>

                        @error('terrenosComun.' .  $index . '.area_terreno_comun') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto lg:col-span-1">

                    <div>

                        <label class="text-sm" >Indiviso de terreno</label>

                    </div>

                    <div>

                        <input type="number" max="100" step=".0001" class="bg-white rounded text-xs w-full" wire:model.blur="terrenosComun.{{ $index }}.indiviso_terreno">

                    </div>

                    <div>

                        @error('terrenosComun.' . $index . '.indiviso_terreno') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto lg:col-span-1">

                    <div>

                        <label class="text-sm" >Valor unitario</label>

                    </div>

                    <div>

                        <input type="number" class="bg-white rounded text-xs w-full" wire:model.blur="terrenosComun.{{ $index }}.valor_unitario">

                    </div>

                    <div>

                        @error('terrenosComun.' . $index . '.valor_unitario') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto lg:col-span-1">

                    <div>

                        <label class="text-sm" >Superficie proporcional</label>

                    </div>

                    <div>

                        <input type="number" max="100" step=".0001" class="bg-white rounded text-xs w-full" wire:model.blur="terrenosComun.{{ $index }}.superficie_proporcional" readonly>

                    </div>

                    <div>

                        @error('terrenosComun.' . $index . '.superficie_proporcional') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto lg:col-span-1">

                    <div>

                        <label class="text-sm" >Valor de terreno común</label>

                    </div>

                    <div>

                        <input type="number" class="bg-white rounded text-xs w-full" wire:model.blur="terrenosComun.{{ $index }}.valor_terreno_comun" readonly>

                    </div>

                    <div>

                        @error('terrenosComun.' . $index . '.valor_terreno_comun') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto lg:col-span-1 my-auto">

                    <x-button-red
                        wire:click="borrarTerrenoComun({{ $index }})"
                        wire:loading.attr="disabled"
                        wire:target="borrarTerrenoComun({{ $index }})">

                        <img wire:loading wire:target="borrarTerrenoComun({{ $index }})" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                        Borrar

                    </x-button-red>

                </div>

            </div>

        @endforeach

        <x-button-blue
            wire:click="agregarTerrenoComun"
            wire:loading.attr="disabled"
            wire:target="agregarTerrenoComun">

            <img wire:loading wire:target="agregarTerrenoComun" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

            Agregar nuevo

        </x-button-blue>

    </div>

    <div class="flex justify-end">

        @if($predio?->avaluo?->estado === 'nuevo')

            <x-button-green
                wire:click="guardarTerrenosComun"
                wire:loading.attr="disabled"
                wire:target="guardarTerrenosComun">

                <img wire:loading wire:target="guardarTerrenosComun" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                Guardar terrenos en común

            </x-button-green>

        @endif

    </div>

</div>
