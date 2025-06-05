<div class="bg-white shadow-xl rounded-lg p-4">

    <h4 class="text-lg mb-5 text-center">Construcciones de área común</h4>

        <div class="mb-5  divide-y">

            @foreach ($construccionesComun as $index => $item)

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-6 gap-3 items-end mb-2 bg-gray-50 p-4 rounded-lg">

                    <div class="flex-auto lg:col-span-1">

                        <div>

                            <label class="text-sm" >Clasificación de construccion</label>

                        </div>

                        <div>

                            <select class="bg-white rounded text-xs w-full" wire:model.blur="construccionesComun.{{ $index }}.valor_clasificacion_construccion">

                                <option value="" selected>Seleccione una opción</option>

                                @foreach ($valores_construccion as $item)

                                    <option value="{{ $item->valor }}" selected>{{ $item->tipo }}{{ $item->uso }}{{ $item->calidad }}{{ $item->estado }} - ${{ number_format($item->valor, 2) }}</option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            @error('construccionesComun.' . $index . '.valor_clasificacion_construccion') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                    <div class="flex-auto lg:col-span-1">

                        <div>

                            <label class="text-sm" >Área común de construcción</label>

                        </div>

                        <div>

                            <input type="number" class="bg-white rounded text-xs w-full" wire:model.blur="construccionesComun.{{ $index }}.area_comun_construccion">

                        </div>

                        <div>

                            @error('construccionesComun.' .  $index . '.area_comun_construccion') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                    <div class="flex-auto lg:col-span-1">

                        <div>

                            <label class="text-sm" >Indiviso de construcción</label>

                        </div>

                        <div>

                            <input type="number" max="100" step=".0001" class="bg-white rounded text-xs w-full" wire:model.blur="construccionesComun.{{ $index }}.indiviso_construccion">

                        </div>

                        <div>

                            @error('construccionesComun.' . $index . '.indiviso_construccion') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                    <div class="flex-auto lg:col-span-1">

                        <div>

                            <label class="text-sm" >Superficie proporcional</label>

                        </div>

                        <div>

                            <input type="number" max="100" step=".0001" class="bg-white rounded text-xs w-full" wire:model.blur="construccionesComun.{{ $index }}.superficie_proporcional" readonly>

                        </div>

                        <div>

                            @error('construccionesComun.' . $index . '.superficie_proporcional') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                    <div class="flex-auto lg:col-span-1">

                        <div>

                            <label class="text-sm" >Valor de construcción común</label>

                        </div>

                        <div>

                            <input type="number" class="bg-white rounded text-xs w-full" wire:model.blur="construccionesComun.{{ $index }}.valor_construccion_comun" readonly>

                        </div>

                        <div>

                            @error('construccionesComun.' . $index . '.valor_construccion_comun') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                    <div class="flex-auto lg:col-span-1 my-auto">

                        <x-button-red
                            wire:click="borrarConstruccionComun({{ $index }})"
                            wire:loading.attr="disabled"
                            wire:target="borrarConstruccionComun({{ $index }})">

                            <img wire:loading wire:target="borrarConstruccionComun({{ $index }})" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                            Borrar

                        </x-button-red>

                    </div>

                </div>

            @endforeach

            <x-button-blue
                wire:click="agregarConstruccionComun"
                wire:loading.attr="disabled"
                wire:target="agregarConstruccionComun">

                <img wire:loading wire:target="agregarConstruccionComun" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                Agregar nuevo

            </x-button-blue>

        </div>

        <div class="flex justify-end">

            @if($predio?->avaluo?->estado === 'nuevo')

                <x-button-green
                    wire:click="guardarConstruccionComun"
                    wire:loading.attr="disabled"
                    wire:target="guardarCoonstruccionComun">

                    <img wire:loading wire:target="guardarConstruccionComun" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                    Guardar construcciones en común

                </x-button-green>

            @endif

        </div>

</div>
