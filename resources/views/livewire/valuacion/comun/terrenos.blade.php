<div class="bg-white shadow-xl rounded-lg p-4">

    <h4 class="text-lg mb-5 text-center">Terrenos</h4>

    <div class="mb-5  divide-y">

        @foreach ($terrenos as $index => $terreno)

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-12 gap-3 items-start mb-2 bg-gray-50 p-4 rounded-lg" wire:key="row-{{ $loop->index }}">

                <div class="flex-auto lg:col-span-2">

                    <div>

                        <label class="text-sm" >Superficie</label>

                    </div>

                    <div>

                        <input type="number" class="bg-white rounded text-xs w-full" wire:model.blur="terrenos.{{ $index }}.superficie">

                    </div>

                    <div>

                        @error('terrenos.' . $index . '.superficie') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                @if($predio && $predio->tipo_predio == 2)

                    <div class="flex-auto lg:col-span-2">

                        <div>

                            <label class="text-sm" >Valor por hectarea</label>

                        </div>

                        <div>

                            <select class="bg-white rounded text-xs w-full" wire:model.live="terrenos.{{ $index }}.valor_unitario">

                                <option value="" selected>Seleccione una opción</option>

                                @foreach ($valores_rusticos as $item)

                                    <option value="{{ $item->valor }}" selected>{{ $item->concepto }} - ${{ number_format($item->valor, 2) }}</option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            @error('terrenos.{{ $index }}.valor_unitario') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                @endif

                <div class="flex-auto lg:col-span-2">

                    <div>

                        <label class="text-sm" >Valor unitario</label>

                    </div>

                    <div>

                        <input type="number" class="bg-white rounded text-xs w-full" wire:model.blur="terrenos.{{ $index }}.valor_unitario" @if($predio && $predio->tipo_predio == 2) readonly @endif>

                    </div>

                    <div>

                        @error('terrenos.' . $index . '.valor_unitario') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                @if(auth()->user()->hasRole('Jefe departamento'))

                    <div class="flex-auto lg:col-span-2 xl:col-span-1">

                        <div>

                            <label class="text-sm" >Demérito</label>

                        </div>

                        <div>

                            <input type="number" min="0" class="bg-white rounded text-xs w-full" wire:model.blur="terrenos.{{ $index }}.demerito">

                        </div>

                        <div>

                            @error('terrenos.' . $index . '.demerito') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                    <div class="flex-auto lg:col-span-2">

                        <div>

                            <label class="text-sm" >Valor demeritado</label>

                        </div>

                        <div>

                            <input type="number" class="bg-white rounded text-xs w-full" wire:model="terrenos.{{ $index }}.valor_demeritado" readonly>

                        </div>

                    </div>

                @endif

                <div class="flex-auto lg:col-span-2">

                    <div>

                        <label class="text-sm" >Valor del terreno</label>

                    </div>

                    <div>

                        <input type="number" class="bg-white rounded text-xs w-full" wire:model="terrenos.{{ $index }}.valor_terreno" readonly>

                    </div>

                </div>

                <div class="flex-auto lg:col-span-1 my-auto">

                    <x-button-red
                        wire:click="borrarTerreno({{ $index }})"
                        wire:loading.attr="disabled"
                        wire:target="borrarTerreno({{ $index }})">

                        <img wire:loading wire:target="borrarTerreno({{ $index }})" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                        Borrar

                    </x-button-red>

                </div>

            </div>

        @endforeach

    </div>

    @if(auth()->user()->hasRole('Jefe departamento'))

        <x-button-blue
            wire:click="agregarTerreno"
            wire:loading.attr="disabled"
            wire:target="agregarTerreno">

            <img wire:loading wire:target="agregarTerreno" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

            Agregar nuevo

        </x-button-blue>

    @endif

    <div class="flex justify-end">

        @if($predio?->avaluo?->estado === 'nuevo')

            <x-button-green
                wire:click="guardarTerrenos"
                wire:loading.attr="disabled"
                wire:target="guardarTerrenos">

                <img wire:loading wire:target="guardarTerrenos" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                Guardar terrenos

            </x-button-green>

        @endif

    </div>

</div>
