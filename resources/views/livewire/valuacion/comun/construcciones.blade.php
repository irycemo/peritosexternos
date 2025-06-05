<div class="bg-white shadow-xl rounded-lg p-4">

    <h4 class="text-lg mb-5 text-center">Construcciones</h4>

        <div class="mb-5  divide-y">

            @foreach ($construcciones as $index => $construccion)

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-12 gap-3 mb-2 bg-gray-50 p-4 rounded-lg items-start">

                    <div class="flex-auto lg:col-span-1">

                        <div>

                            <label class="text-sm" >Referencia</label>

                        </div>

                        <div>

                            <input type="text" class="bg-white rounded text-xs w-full" wire:model.blur="construcciones.{{ $index }}.referencia">

                        </div>

                        <div>

                            @error('construcciones.' . $index . '.referencia') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                    <div class="flex-auto lg:col-span-3">

                        <div>

                            <label class="text-sm" >Clasificación de construcción</label>

                        </div>

                        <div>

                            <select class="bg-white rounded text-xs w-full" wire:model.live="construcciones.{{ $index }}.valores">

                                <option value="" selected>Seleccione una opción</option>

                                @foreach ($valores_construccion as $item)

                                    <option value="{{ $item }}" selected>{{ $item->tipo }}{{ $item->uso }}{{ $item->calidad }}{{ $item->estado }} - ${{ number_format($item->valor, 2) }}</option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            @error('construcciones.{{ $index }}.valores') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                    <div class="flex space-x-1 lg:col-span-2">

                        <div class="flex-auto">

                            <div>

                                <label class="text-sm" >Tipo</label>

                            </div>

                            <div>

                                <input type="number" class="bg-white rounded text-xs w-full" readonly wire:model.blur="construcciones.{{ $index }}.tipo">

                            </div>

                        </div>

                        <div class="flex-auto">

                            <div>

                                <label class="text-sm" >Uso</label>

                            </div>

                            <div>

                                <input type="number" class="bg-white rounded text-xs w-full" readonly wire:model.blur="construcciones.{{ $index }}.uso">

                            </div>

                        </div>

                        <div class="flex-auto">

                            <div>

                                <label class="text-sm" >Calidad</label>

                            </div>

                            <div>

                                <input type="number" class="bg-white rounded text-xs w-full" readonly wire:model.blur="construcciones.{{ $index }}.calidad">

                            </div>

                        </div>

                        <div class="flex-auto">

                            <div>

                                <label class="text-sm" >Estado</label>

                            </div>

                            <div>

                                <input type="number" class="bg-white rounded text-xs w-full" readonly wire:model.blur="construcciones.{{ $index }}.estado">

                            </div>

                        </div>

                    </div>

                    <div class="flex-auto lg:col-span-2">

                        <div>

                            <label class="text-sm" >Valor unitario</label>

                        </div>

                        <div>

                            <input type="number" class="bg-white rounded text-xs w-full" wire:model.blur="construcciones.{{ $index }}.valor_unitario" readonly>

                        </div>

                        <div>

                            @error('construcciones.' . $index . '.valor_unitario') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                    <div class="flex-auto lg:col-span-1">

                        <div>

                            <label class="text-sm" >Niveles</label>

                        </div>

                        <div>

                            <input type="number" class="bg-white rounded text-xs w-full" wire:model.blur="construcciones.{{ $index }}.niveles">

                        </div>

                        <div>

                            @error('construcciones.' . $index . '.niveles') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                    <div class="flex-auto lg:col-span-1">

                        <div>

                            <label class="text-sm" >Superficie</label>

                        </div>

                        <div>

                            <input type="number" class="bg-white rounded text-xs w-full" wire:model.blur="construcciones.{{ $index }}.superficie">

                        </div>

                        <div>

                            @error('construcciones.' . $index . '.superficie') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                    <div class="flex-auto lg:col-span-1">

                        <div>

                            <label class="text-sm" >Valor</label>

                        </div>

                        <div>

                            <input type="number" class="bg-white rounded text-xs w-full" wire:model.blur="construcciones.{{ $index }}.valor_construccion" readonly>

                        </div>

                        <div>

                            @error('construcciones.' . $index . '.valor_construccion') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                    <div class="flex-auto lg:col-span-1 my-auto">

                        <x-button-red
                            wire:click="borrarConstruccion({{ $index }})"
                            wire:loading.attr="disabled"
                            wire:target="borrarConstruccion({{ $index }})">

                            <img wire:loading wire:target="borrarConstruccion({{ $index }})" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                            Borrar

                        </x-button-red>

                    </div>

                </div>

            @endforeach

        </div>

        <x-button-blue
            wire:click="agregarConstruccion"
            wire:loading.attr="disabled"
            wire:target="agregarConstruccion">

            <img wire:loading wire:target="agregarConstruccion" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

            Agregar nuevo

        </x-button-blue>

        <div class="flex justify-end">

            @if($predio?->avaluo?->estado === 'nuevo')

                <x-button-green
                    wire:click="guardarConstrucciones"
                    wire:loading.attr="disabled"
                    wire:target="guardarConstrucciones">

                    <img wire:loading wire:target="guardarConstrucciones" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                    Guardar construcciones

                </x-button-green>

            @endif

        </div>

</div>
