<div class="p-4 mb-1">

    @if(isset($predio->avaluo->folio))

        <div class="space-y-2 mb-5 bg-white rounded-lg p-2 text-right">

            <span class="bg-blue-400 text-white text-sm rounded-full px-2 py-1">Folio de avaluo: {{ $predio->avaluo->año }}-{{ $predio->avaluo->folio }}</span>

        </div>

    @endif

    @if($predio)

        <div class="space-y-2 mb-5 bg-white rounded-lg p-2">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 items-start  mx-auto">

                <div class="flex-auto">

                    <div class="text-left">

                        <Label class="text-base tracking-widest rounded-xl border-gray-500">Uso del predio</Label>

                    </div>

                    <div class="">

                        <select class="bg-white rounded text-xs w-full" wire:model="predio.uso_1">

                            <option value="" selected>Seleccione una opción</option>

                            @foreach ($usos as $item)

                                <option value="{{ $item }}" selected>{{ $item }}</option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        @error('predio.uso_1') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto">

                    <div class="text-left">

                        <Label class="text-base tracking-widest rounded-xl border-gray-500">Uso del predio</Label>

                    </div>

                    <div class="">

                        <select class="bg-white rounded text-xs w-full" wire:model="predio.uso_2">

                            <option value="" selected>Seleccione una opción</option>

                            @foreach ($usos as $item)

                                <option value="{{ $item }}" selected>{{ $item }}</option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <div class="flex-auto">

                    <div class="text-left">

                        <Label class="text-base tracking-widest rounded-xl border-gray-500">Uso del predio</Label>

                    </div>

                    <div class="">

                        <select class="bg-white rounded text-xs w-full" wire:model="predio.uso_3">

                            <option value="" selected>Seleccione una opción</option>

                            @foreach ($usos as $item)

                                <option value="{{ $item }}" selected>{{ $item }}</option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <div class="flex-auto">

                    <div class="text-left">

                        <Label class="text-base tracking-widest rounded-xl border-gray-500">Ubicación del predio en la manzana</Label>

                    </div>

                    <div class="">

                        <select class="bg-white rounded text-xs w-full" wire:model.live="predio.ubicacion_en_manzana">

                            <option value="" selected>Seleccione una opción</option>

                            @foreach ($ubicaciones as $item)

                                <option value="{{ $item }}" selected>{{ $item }}</option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        @error('predio.ubicacion_en_manzana') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

            </div>

        </div>

    @endif

    <div class="space-y-2 mb-5 bg-white rounded-lg p-2">

        <h4 class="text-lg mb-5 text-center">Terrenos</h4>

        <div class="mb-5  divide-y">

            @foreach ($terrenos as $index => $terreno)

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-12 gap-3 items-start mb-2 bg-gray-50 p-4 rounded-lg">

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

                    <div class="flex-auto lg:col-span-2 xl:col-span-1">

                        <div>

                            <label class="text-sm" >Demerito</label>

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

                    <div class="flex-auto lg:col-span-2">

                        <div>

                            <label class="text-sm" >Valor del terreno</label>

                        </div>

                        <div>

                            <input type="number" class="bg-white rounded text-xs w-full" wire:model="terrenos.{{ $index }}.valor_terreno" readonly>

                        </div>

                    </div>

                    @if($predio && in_array($predio->avaluo->estado, ['nuevo', 'impreso']))

                        <div class="flex-auto lg:col-span-1 my-auto">

                            <x-button-red
                                wire:click="borrarTerreno({{ $index }})"
                                wire:loading.attr="disabled"
                                wire:target="borrarTerreno({{ $index }})"
                            >

                                <img wire:loading wire:target="borrarTerreno({{ $index }})" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                                Borrar

                            </x-button-red>

                        </div>

                    @endif

                </div>

            @endforeach

        </div>

        @if($predio && in_array($predio->avaluo->estado, ['nuevo', 'impreso']))

            <x-button-blue
                wire:click="agregarTerreno"
                wire:loading.attr="disabled"
                wire:target="agregarTerreno"
            >

                <img wire:loading wire:target="agregarTerreno" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                Agregar nuevo

            </x-button-blue>

            <div class="flex justify-end">

                <x-button-green
                    wire:click="guardarTerrenos"
                    wire:loading.attr="disabled"
                    wire:target="guardarTerrenos"
                >

                    <img wire:loading wire:target="guardarTerrenos" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                    Guardar terreno

                </x-button-green>

            </div>

        @endif

    </div>

    <div class="space-y-2 mb-5 bg-white rounded-lg p-2">

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

                            <label class="text-sm" >Clasificación de construccion</label>

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

                    <div class="flex-auto lg:col-span-2">

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

                    @if($predio && in_array($predio->avaluo->estado, ['nuevo', 'impreso']))

                        <div class="flex-auto lg:col-span-1 my-auto">

                            <x-button-red
                                wire:click="borrarConstruccion({{ $index }})"
                                wire:loading.attr="disabled"
                                wire:target="borrarConstruccion({{ $index }})"
                            >

                                <img wire:loading wire:target="borrarConstruccion({{ $index }})" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                                Borrar

                            </x-button-red>

                        </div>

                    @endif

                </div>

            @endforeach

        </div>

        @if($predio && in_array($predio->avaluo->estado, ['nuevo', 'impreso']))

            <x-button-blue
                wire:click="agregarConstruccion"
                wire:loading.attr="disabled"
                wire:target="agregarConstruccion"
            >

                <img wire:loading wire:target="agregarConstruccion" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                Agregar nuevo

            </x-button-blue>

            <div class="flex justify-end">

                <x-button-green
                    wire:click="guardarConstrucciones"
                    wire:loading.attr="disabled"
                    wire:target="guardarConstrucciones"
                >

                    <img wire:loading wire:target="guardarConstrucciones" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                    Guardar construcciones

                </x-button-green>

            </div>

        @endif

    </div>

    @if($predio && $predio->edificio != 0)

        <div class="space-y-2 mb-5 bg-white rounded-lg p-2">

            <h4 class="text-lg mb-5 text-center">Terrenos de área común</h4>

            <div class="mb-5  divide-y">

                @foreach ($terrenosCondominio as $index => $item)

                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-3 items-start mb-2 bg-gray-50 p-4 rounded-lg">

                        <div class="flex-auto lg:col-span-1">

                            <div>

                                <label class="text-sm" >Área común de terreno</label>

                            </div>

                            <div>

                                <input type="number" class="bg-white rounded text-xs w-full" wire:model.blur="terrenosCondominio.{{ $index }}.area_terreno_comun">

                            </div>

                            <div>

                                @error('terrenosCondominio.' .  $index . '.area_terreno_comun') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                            </div>

                        </div>

                        <div class="flex-auto lg:col-span-1">

                            <div>

                                <label class="text-sm" >Indiviso de terreno</label>

                            </div>

                            <div>

                                <input type="number" max="100" step=".0001" class="bg-white rounded text-xs w-full" wire:model.blur="terrenosCondominio.{{ $index }}.indiviso_terreno">

                            </div>

                            <div>

                                @error('terrenosCondominio.' . $index . '.indiviso_terreno') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                            </div>

                        </div>

                        <div class="flex-auto lg:col-span-1">

                            <div>

                                <label class="text-sm" >Superficie proporcional</label>

                            </div>

                            <div>

                                <input type="number" max="100" step=".0001" class="bg-white rounded text-xs w-full" wire:model.blur="terrenosCondominio.{{ $index }}.superficie_proporcional" readonly>

                            </div>

                            <div>

                                @error('terrenosCondominio.' . $index . '.superficie_proporcional') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                            </div>

                        </div>

                        <div class="flex-auto lg:col-span-1">

                            <div>

                                <label class="text-sm" >Valor unitario</label>

                            </div>

                            <div>

                                <input type="number" class="bg-white rounded text-xs w-full" wire:model.blur="terrenosCondominio.{{ $index }}.valor_unitario">

                            </div>

                            <div>

                                @error('terrenosCondominio.' . $index . '.valor_unitario') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                            </div>

                        </div>

                        <div class="flex-auto lg:col-span-1">

                            <div>

                                <label class="text-sm" >Valor de terreno común</label>

                            </div>

                            <div>

                                <input type="number" class="bg-white rounded text-xs w-full" wire:model.blur="terrenosCondominio.{{ $index }}.valor_terreno_comun" readonly>

                            </div>

                            <div>

                                @error('terrenosCondominio.' . $index . '.valor_terreno_comun') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                            </div>

                        </div>

                        <div class="flex-auto lg:col-span-1 my-auto">

                            @if($predio && in_array($predio->avaluo->estado, ['nuevo', 'impreso']))

                                <x-button-red
                                    wire:click="borrarCondominioTerreno({{ $index }})"
                                    wire:loading.attr="disabled"
                                    wire:target="borrarCondominioTerreno({{ $index }})"
                                >

                                    <img wire:loading wire:target="borrarCondominioTerreno({{ $index }})" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                                    Borrar

                                </x-button-red>

                            @endif

                        </div>

                    </div>

                @endforeach

                @if($predio && in_array($predio->avaluo->estado, ['nuevo', 'impreso']))

                    <x-button-blue
                        wire:click="agregarTerrenoConstruccion"
                        wire:loading.attr="disabled"
                        wire:target="agregarTerrenoConstruccion"
                    >

                        <img wire:loading wire:target="agregarTerrenoConstruccion" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                        Agregar nuevo

                    </x-button-blue>

                @endif

            </div>

            <div class="flex justify-end">

                @if($predio && in_array($predio->avaluo->estado, ['nuevo', 'impreso']))

                    <x-button-green
                        wire:click="guardarTerrenosCondominio"
                        wire:loading.attr="disabled"
                        wire:target="guardarTerrenosCondominio"
                    >

                        <img wire:loading wire:target="guardarTerrenosCondominio" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                        Guardar condominio

                    </x-button-green>

                @endif

            </div>

        </div>

        <div class="space-y-2 mb-5 bg-white rounded-lg p-2">

            <h4 class="text-lg mb-5 text-center">Construcciones de área común</h4>

            <div class="mb-5  divide-y">

                @foreach ($construccionesCondominio as $index => $item)

                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-3 items-start mb-2 bg-gray-50 p-4 rounded-lg">

                        <div class="flex-auto lg:col-span-1">

                            <div>

                                <label class="text-sm" >Área común de construcción</label>

                            </div>

                            <div>

                                <input type="number" class="bg-white rounded text-xs w-full" wire:model.blur="construccionesCondominio.{{ $index }}.area_comun_construccion">

                            </div>

                            <div>

                                @error('construccionesCondominio.' .  $index . '.area_comun_construccion') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                            </div>

                        </div>

                        <div class="flex-auto lg:col-span-1">

                            <div>

                                <label class="text-sm" >Indiviso de construcción</label>

                            </div>

                            <div>

                                <input type="number" max="100" step=".0001" class="bg-white rounded text-xs w-full" wire:model.blur="construccionesCondominio.{{ $index }}.indiviso_construccion">

                            </div>

                            <div>

                                @error('construccionesCondominio.' . $index . '.indiviso_construccion') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                            </div>

                        </div>

                        <div class="flex-auto lg:col-span-1">

                            <div>

                                <label class="text-sm" >Superficie proporcional</label>

                            </div>

                            <div>

                                <input type="number" max="100" step=".0001" class="bg-white rounded text-xs w-full" wire:model.blur="construccionesCondominio.{{ $index }}.superficie_proporcional" readonly>

                            </div>

                            <div>

                                @error('construccionesCondominio.' . $index . '.superficie_proporcional') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                            </div>

                        </div>

                        <div class="flex-auto lg:col-span-1">

                            <div>

                                <label class="text-sm" >Clasificación de construccion</label>

                            </div>

                            <div>

                                <select class="bg-white rounded text-xs w-full" wire:model.blur="construccionesCondominio.{{ $index }}.valor_clasificacion_construccion">

                                    <option value="" selected>Seleccione una opción</option>

                                    @foreach ($valores_construccion as $item)

                                        <option value="{{ $item->valor }}" selected>{{ $item->tipo }}{{ $item->uso }}{{ $item->calidad }}{{ $item->estado }} - ${{ number_format($item->valor, 2) }}</option>

                                    @endforeach

                                </select>

                            </div>

                            <div>

                                @error('construccionesCondominio.' . $index . '.valor_clasificacion_construccion') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                            </div>

                        </div>

                        <div class="flex-auto lg:col-span-1">

                            <div>

                                <label class="text-sm" >Valor de construcción común</label>

                            </div>

                            <div>

                                <input type="number" class="bg-white rounded text-xs w-full" wire:model.blur="construccionesCondominio.{{ $index }}.valor_construccion_comun" readonly>

                            </div>

                            <div>

                                @error('construccionesCondominio.' . $index . '.valor_construccion_comun') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                            </div>

                        </div>

                        <div class="flex-auto lg:col-span-1 my-auto">

                            @if($predio && in_array($predio->avaluo->estado, ['nuevo', 'impreso']))

                                <x-button-red
                                    wire:click="borrarCondominioConstruccion({{ $index }})"
                                    wire:loading.attr="disabled"
                                    wire:target="borrarCondominioConstruccion({{ $index }})"
                                >

                                    <img wire:loading wire:target="borrarCondominioConstruccion({{ $index }})" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                                    Borrar

                                </x-button-red>

                            @endif

                        </div>

                    </div>

                @endforeach

                @if($predio && in_array($predio->avaluo->estado, ['nuevo', 'impreso']))

                    <x-button-blue
                        wire:click="agregarCondominioConstruccion"
                        wire:loading.attr="disabled"
                        wire:target="agregarCondominioConstruccion"
                    >

                        <img wire:loading wire:target="agregarCondominioConstruccion" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                        Agregar nuevo

                    </x-button-blue>

                @endif

            </div>

            <div class="flex justify-end">

                @if($predio && in_array($predio->avaluo->estado, ['nuevo', 'impreso']))

                    <x-button-green
                        wire:click="guardarCondominio"
                        wire:loading.attr="disabled"
                        wire:target="guardarCondominio"
                    >

                        <img wire:loading wire:target="guardarCondominio" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                        Guardar condominio

                    </x-button-green>

                @endif

            </div>

        </div>

    @endif

    @if($predio)

        <div class="bg-white rounded-lg p-3 flex justify-end">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 items-start  mx-auto">

                <div>

                    <h4 class="text-lg mb-5">Superficies</h4>

                    <table>

                        <thead>

                            <tr>
                                <th></th>
                                <th class="text-sm font-light tracking-widest rounded-xl border-gray-500">Privativa</th>
                                <th class="text-sm font-light tracking-widest rounded-xl border-gray-500">Proporcional</th>
                                <th class="text-sm font-light tracking-widest rounded-xl border-gray-500">Total</th>
                            </tr>

                        </thead>

                        <tbody>

                            <tr>
                                <td>Superficie de terreno</td>
                                <td><input readonly class="bg-white rounded text-xs w-full" type="text" wire:model.live="predio.superficie_terreno"></td>
                                <td><input readonly class="bg-white rounded text-xs w-full" type="text" value="{{ collect($terrenosCondominio)->sum('superficie_proporcional') }}"></td>
                                <td><input readonly class="bg-white rounded text-xs w-full" type="text" value="{{ $predio->superficie_terreno  + collect($terrenosCondominio)->sum('superficie_proporcional') }}"></td>
                            </tr>

                            <tr>
                                <td>Superficie de construcción</td>
                                <td><input readonly class="bg-white rounded text-xs w-full" type="text" wire:model.live="predio.superficie_construccion"></td>
                                <td><input readonly class="bg-white rounded text-xs w-full" type="text" value="{{ collect($construccionesCondominio)->sum('superficie_proporcional') }}"></td>
                                <td><input readonly class="bg-white rounded text-xs w-full" type="text" value="{{ $predio->superficie_construccion  + collect($construccionesCondominio)->sum('superficie_proporcional') }}"></td>
                            </tr>

                        </tbody>

                    </table>

                </div>

                <div>

                    <h4 class="text-lg mb-5">Valores</h4>

                    <table class="mx-auto">

                        <tbody>

                            <tr>
                                <td class="text-sm">Privatio + Proporcional</td>
                                <td><input readonly class="bg-white rounded text-xs w-full" type="text" value="${{ number_format($predio->valor_total_terreno + $predio->valor_terreno_comun, 2) }}"></td>
                            </tr>
                            <tr>
                                <td class="text-sm">Privatio + Proporcional</td>
                                <td><input readonly class="bg-white rounded text-xs w-full" type="text" value="${{ number_format($predio->valor_total_construccion + $predio->valor_construccion_comun, 2) }}"></td>
                            </tr>
                            @if($this->predio->ubicacion_en_manzana == 'ESQUINA')

                                <tr>
                                    <td class="text-sm">Sub Total</td>
                                    <td><input readonly class="bg-white rounded text-xs w-full" type="text" value="${{ number_format($predio->valor_total_terreno + $predio->valor_terreno_comun + $predio->valor_total_construccion + $predio->valor_construccion_comun, 2) }}"></td>
                                </tr>

                                <tr>
                                    <td class="text-sm">Ubicación en esquina</td>
                                    <td><input readonly class="bg-white rounded text-xs w-full" type="text" value="${{ number_format(($predio->valor_total_terreno + $predio->valor_terreno_comun + $predio->valor_total_construccion + $predio->valor_construccion_comun) * 0.15, 2) }}"></td>
                                </tr>

                                <tr>
                                    <td class="text-sm">Total</td>
                                    <td><input readonly class="bg-white rounded text-xs w-full" type="text" value="${{ number_format(($predio->valor_total_terreno + $predio->valor_terreno_comun + $predio->valor_total_construccion + $predio->valor_construccion_comun) + ($predio->valor_total_terreno + $predio->valor_terreno_comun + $predio->valor_total_construccion + $predio->valor_construccion_comun) * 0.15, 2) }}"></td>
                                </tr>

                            @else

                                <tr>
                                    <td class="text-sm">Total</td>
                                    <td><input readonly class="bg-white rounded text-xs w-full" type="text" value="${{ number_format($predio->valor_total_terreno + $predio->valor_terreno_comun + $predio->valor_total_construccion + $predio->valor_construccion_comun, 2) }}"></td>
                                </tr>

                            @endif

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    @endif

    @if(count($errors) > 0)

        <div class="mb-5 bg-white rounded-lg p-2 shadow-lg flex gap-2 flex-wrap ">

            <ul class="flex gap-2 felx flex-wrap list-disc ml-5">
            @foreach ($errors->all() as $error)

                <li class="text-red-500 text-xs md:text-sm ml-5">
                    {{ $error }}
                </li>

            @endforeach

        </ul>

        </div>

    @endif

    @if($predio && in_array($predio->avaluo->estado, ['nuevo', 'impreso']))

        <div class="bg-white rounded-lg p-3 flex justify-end mt-5">

            @if($predio && $predio->avaluo && $predio->avaluo->estado === 'nuevo')

                <x-button-green
                    wire:click="guardar"
                    wire:loading.attr="disabled"
                    wire:target="guardar"                >

                    <img wire:loading wire:target="guardar" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                    Guardar

                </x-button-green>

            @endif

        </div>

    @endif

</div>
