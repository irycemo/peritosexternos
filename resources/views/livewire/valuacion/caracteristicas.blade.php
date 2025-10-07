<div>

    @include('livewire.valuacion.comun.avaluo-folio')

    <div class="space-y-2 mb-5 bg-white rounded-lg p-2 shadow-xl">

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 items-start md:w-2/3 mx-auto mb-4">

            <x-input-group for="avaluo.clasificacion_zona" label="Clasificación de la zona" :error="$errors->first('avaluo.clasificacion_zona')" class="w-full">

                <x-input-select id="avaluo.clasificacion_zona" wire:model="avaluo.clasificacion_zona" class="w-full">

                    <option value="">Seleccione una opción</option>

                    @foreach ($zonas as $item)

                        <option value="{{ $item }}">{{ $item }}</option>

                    @endforeach

                </x-input-select>

            </x-input-group>

            <x-input-group for="avaluo.construccion_dominante" label="Tipo de construcción dominante" :error="$errors->first('avaluo.construccion_dominante')" class="w-full">

                <x-input-select id="avaluo.construccion_dominante" wire:model="avaluo.construccion_dominante" class="w-full">

                    <option value="">Seleccione una opción</option>

                    @foreach ($construcciones as $item)

                        <option value="{{ $item }}">{{ $item }}</option>

                    @endforeach

                </x-input-select>

            </x-input-group>

            <x-input-group for="predio.ubicacion_en_manzana" label="Ubicación del predio en la manzana" :error="$errors->first('predio.ubicacion_en_manzana')" class="w-full">

                <x-input-select id="predio.ubicacion_en_manzana" wire:model="predio.ubicacion_en_manzana" class="w-full">

                    <option value="">Seleccione una opción</option>

                    @foreach ($ubicaciones as $item)

                        <option value="{{ $item }}" selected>{{ $item }}</option>

                    @endforeach

                </x-input-select>

            </x-input-group>

        </div>

        <div class="flex-row lg:flex lg:space-x-2 mb-2 space-y-2 lg:space-y-0 items-center justify-center" >

            <div class="text-left">

                <Label class="text-base tracking-widest rounded-xl border-gray-500">Servicios municipales</Label>

            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 items-end text-center">

                <div class="flex-auto">

                    <div>

                        <Label class="text-sm">Agua potable</Label>
                    </div>

                    <div>

                        <input type="checkbox" class="bg-white rounded text-xs" wire:model="avaluo.agua" @if($predio && $predio->avaluo->agua == 1) checked @endif>

                    </div>

                    <div>

                        @error('avaluo.agua') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto">

                    <div>

                        <Label class="text-sm">Drenaje</Label>
                    </div>

                    <div>

                        <input type="checkbox" class="bg-white rounded text-xs" wire:model="avaluo.drenaje" @if($predio && $predio->avaluo->drenaje == 1) checked @endif>

                    </div>

                    <div>

                        @error('avaluo.drenaje') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto">

                    <div>

                        <Label class="text-sm">Pavimento</Label>
                    </div>

                    <div>

                        <input type="checkbox" class="bg-white rounded text-xs" wire:model="avaluo.pavimento" @if($predio && $predio->avaluo->pavimento == 1) checked @endif>

                    </div>

                    <div>

                        @error('avaluo.pavimento') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto">

                    <div>

                        <Label class="text-sm">Energía eléctrica</Label>
                    </div>

                    <div>

                        <input type="checkbox" class="bg-white rounded text-xs" wire:model="avaluo.energia_electrica" @if($predio && $predio->avaluo->energia_electrica == 1) checked @endif>

                    </div>

                    <div>

                        @error('avaluo.energia_electrica') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto">

                    <div>

                        <Label class="text-sm">Alumbrado público</Label>
                    </div>

                    <div>

                        <input type="checkbox" class="bg-white rounded text-xs" wire:model="avaluo.alumbrado_publico" @if($predio && $predio->avaluo->alumbrado_publico == 1) checked @endif>

                    </div>

                    <div>

                        @error('avaluo.alumbrado_publico') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto">

                    <div>

                        <Label class="text-sm">Banqueta</Label>
                    </div>

                    <div>

                        <input type="checkbox" class="bg-white rounded text-xs" wire:model="avaluo.banqueta" @if($predio && $predio->avaluo->banqueta == 1) checked @endif>

                    </div>

                    <div>

                        @error('avaluo.banqueta') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="flex justify-end lg:col-span-3 mb-5">

        <x-button-blue
            wire:click="agregarBloque"
            wire:loading.attr="disabled"
        >

            <img wire:loading wire:target="agregarBloque" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

            Agregar bloque

        </x-button-blue>

    </div>

    @foreach ($bloques as $index => $bloque)

       {{--  <div class="mb-5 bg-white rounded-lg p-4 shadow-xl ">

            <span class="p-2 bg-blue-400 text-white text-sm rounded-full">Bloque {{ $loop->iteration }}</span>

        </div> --}}

        <div class="space-y-2 mb-5 bg-white rounded-lg p-2 shadow-xl">

            <h4 class="text-lg mb-5 text-center">Bloque {{ $loop->iteration }}</h4>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-end  mx-auto">

                <x-input-group for="bloques.{{ $index }}.uso" label="Uso del bloque" :error="$errors->first('bloques.' . $index . '.uso')" class="w-full">

                    <x-input-select id="bloques.{{ $index }}.uso" wire:model="bloques.{{ $index }}.uso" class="w-full">

                        <option value="">Seleccione las opciones</option>

                        @foreach ($usos as $item)

                            <option value="{{ $item }}" selected>{{ $item }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

            </div>

            <h4 class="text-lg mb-5 text-center">Obra negra</h4>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-5 gap-3 items-end mx-auto">

                <x-input-group for="bloques.{{ $index }}.cimentacion" label="Cimentación" :error="$errors->first('bloques.' . $index . '.viento')" class="w-full">

                    <x-input-select id="bloques.{{ $index }}.cimentacion" wire:model="bloques.{{ $index }}.cimentacion" class="w-full" multiple>

                        <option value="">Seleccione las opciones</option>

                        @foreach ($cimentaciones as $item)

                            <option value="{{ $item }}" title="{{ $item }}">{{ $item }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

                <x-input-group for="bloques.{{ $index }}.estructura" label="Estructura" :error="$errors->first('bloques.' . $index . '.estructura')" class="w-full">

                    <x-input-select id="bloques.{{ $index }}.estructura" wire:model="bloques.{{ $index }}.estructura" class="w-full" multiple>

                        <option value="">Seleccione las opciones</option>

                        @foreach ($estructuras as $item)

                            <option value="{{ $item }}" title="{{ $item }}">{{ $item }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

                <x-input-group for="bloques.{{ $index }}.muros" label="Muros" :error="$errors->first('bloques.' . $index . '.muros')" class="w-full">

                    <x-input-select id="bloques.{{ $index }}.muros" wire:model="bloques.{{ $index }}.muros" class="w-full" multiple>

                        <option value="">Seleccione las opciones</option>

                        @foreach ($muros as $item)

                            <option value="{{ $item }}" title="{{ $item }}">{{ $item }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

                <x-input-group for="bloques.{{ $index }}.entrepiso" label="Entrepisos" :error="$errors->first('bloques.' . $index . '.entrepiso')" class="w-full">

                    <x-input-select id="bloques.{{ $index }}.entrepiso" wire:model="bloques.{{ $index }}.entrepiso" class="w-full" multiple>

                        <option value="">Seleccione las opciones</option>

                        @foreach ($entrepisos as $item)

                            <option value="{{ $item }}" title="{{ $item }}">{{ $item }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

                <x-input-group for="bloques.{{ $index }}.techo" label="Techo" :error="$errors->first('bloques.' . $index . '.techo')" class="w-full">

                    <x-input-select id="bloques.{{ $index }}.techo" wire:model="bloques.{{ $index }}.techo" class="w-full" multiple>

                        <option value="">Seleccione las opciones</option>

                        @foreach ($techos as $item)

                            <option value="{{ $item }}" title="{{ $item }}">{{ $item }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

            </div>

        </div>

        <div class="space-y-2 mb-5 bg-white rounded-lg p-2 shadow-xl">

            <h4 class="text-lg mb-5 text-center">Acabados</h4>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-5 gap-3 items-end mx-auto">

                <x-input-group for="bloques.{{ $index }}.plafones" label="Plafones" :error="$errors->first('bloques.' . $index . '.plafones')" class="w-full">

                    <x-input-select id="bloques.{{ $index }}.plafones" wire:model="bloques.{{ $index }}.plafones" class="w-full" multiple>

                        <option value="">Seleccione las opciones</option>

                        @foreach ($plafones as $item)

                            <option value="{{ $item }}"  title="{{ $item }}">{{ $item }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

                <x-input-group for="bloques.{{ $index }}.vidrieria" label="Vidriería" :error="$errors->first('bloques.' . $index . '.vidrieria')" class="w-full">

                    <x-input-select id="bloques.{{ $index }}.vidrieria" wire:model="bloques.{{ $index }}.vidrieria" class="w-full" multiple>

                        <option value="">Seleccione las opciones</option>

                        @foreach ($vidrieria as $item)

                            <option value="{{ $item }}" title="{{ $item }}">{{ $item }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

                <x-input-group for="bloques.{{ $index }}.lambrines" label="Lambrines" :error="$errors->first('bloques.' . $index . '.lambrines')" class="w-full">

                    <x-input-select id="bloques.{{ $index }}.lambrines" wire:model="bloques.{{ $index }}.lambrines" class="w-full" multiple>

                        <option value="">Seleccione las opciones</option>

                        @foreach ($lambrines as $item)

                            <option value="{{ $item }}"  title="{{ $item }}">{{ $item }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

                <x-input-group for="bloques.{{ $index }}.pisos" label="Pisos" :error="$errors->first('bloques.' . $index . '.pisos')" class="w-full">

                    <x-input-select id="bloques.{{ $index }}.pisos" wire:model="bloques.{{ $index }}.pisos" class="w-full" multiple>

                        <option value="">Seleccione las opciones</option>

                        @foreach ($pisos as $item)

                            <option value="{{ $item }}"  title="{{ $item }}">{{ $item }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

                <x-input-group for="bloques.{{ $index }}.herreria" label="Herrería" :error="$errors->first('bloques.' . $index . '.herreria')" class="w-full">

                    <x-input-select id="bloques.{{ $index }}.herreria" wire:model="bloques.{{ $index }}.herreria" class="w-full" multiple>

                        <option value="">Seleccione las opciones</option>

                        @foreach ($herreria as $item)

                            <option value="{{ $item }}"  title="{{ $item }}">{{ $item }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

                <x-input-group for="bloques.{{ $index }}.pintura" label="Pintura" :error="$errors->first('bloques.' . $index . '.pintura')" class="w-full">

                    <x-input-select id="bloques.{{ $index }}.pintura" wire:model="bloques.{{ $index }}.pintura" class="w-full" multiple>

                        <option value="">Seleccione las opciones</option>

                        @foreach ($pintura as $item)

                            <option value="{{ $item }}"  title="{{ $item }}">{{ $item }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

                <x-input-group for="bloques.{{ $index }}.carpinteria" label="Carpintería" :error="$errors->first('bloques.' . $index . '.carpinteria')" class="w-full">

                    <x-input-select id="bloques.{{ $index }}.carpinteria" wire:model="bloques.{{ $index }}.carpinteria" class="w-full" multiple>

                        <option value="">Seleccione las opciones</option>

                        @foreach ($carpinteria as $item)

                            <option value="{{ $item }}"  title="{{ $item }}">{{ $item }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

                <x-input-group for="bloques.{{ $index }}.aplanados" label="Aplanados" :error="$errors->first('bloques.' . $index . '.aplanados')" class="w-full">

                    <x-input-select id="bloques.{{ $index }}.aplanados" wire:model="bloques.{{ $index }}.aplanados" class="w-full" multiple>

                        <option value="">Seleccione las opciones</option>

                        @foreach ($aplanados as $item)

                            <option value="{{ $item }}"  title="{{ $item }}">{{ $item }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

                <x-input-group for="bloques.{{ $index }}.recubrimiento_especial" label="Recubrimiento especial" :error="$errors->first('bloques.' . $index . '.recubrimiento_especial')" class="w-full">

                    <x-input-select id="bloques.{{ $index }}.recubrimiento_especial" wire:model="bloques.{{ $index }}.recubrimiento_especial" class="w-full" multiple>

                        <option value="">Seleccione las opciones</option>

                        @foreach ($rec_especial as $item)

                            <option value="{{ $item }}"  title="{{ $item }}">{{ $item }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

            </div>

        </div>

        <div class="space-y-2 mb-5 bg-white rounded-lg p-2 shadow-xl">

            <h4 class="text-lg mb-5 text-center">Instalaciones</h4>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-5 gap-3 items-end mx-auto">

                <x-input-group for="bloques.{{ $index }}.hidraulica" label="Hidráulica" :error="$errors->first('bloques.' . $index . '.hidraulica')" class="w-full">

                    <x-input-select id="bloques.{{ $index }}.hidraulica" wire:model="bloques.{{ $index }}.hidraulica" class="w-full" multiple>

                        <option value="">Seleccione las opciones</option>

                        @foreach ($hidraulica as $item)

                            <option value="{{ $item }}" title="{{ $item }}">{{ $item }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

                <x-input-group for="bloques.{{ $index }}.sanitaria" label="Sanitaria" :error="$errors->first('bloques.' . $index . '.sanitaria')" class="w-full">

                    <x-input-select id="bloques.{{ $index }}.sanitaria" wire:model="bloques.{{ $index }}.sanitaria" class="w-full" multiple>

                        <option value="">Seleccione las opciones</option>

                        @foreach ($sanitaria as $item)

                            <option value="{{ $item }}" title="{{ $item }}">{{ $item }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

                <x-input-group for="bloques.{{ $index }}.electrica" label="Eléctrica" :error="$errors->first('bloques.' . $index . '.electrica')" class="w-full">

                    <x-input-select id="bloques.{{ $index }}.electrica" wire:model="bloques.{{ $index }}.electrica" class="w-full" multiple>

                        <option value="">Seleccione las opciones</option>

                        @foreach ($electrica as $item)

                            <option value="{{ $item }}" title="{{ $item }}">{{ $item }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

                <x-input-group for="bloques.{{ $index }}.gas" label="Gas" :error="$errors->first('bloques.' . $index . '.gas')" class="w-full">

                    <x-input-select id="bloques.{{ $index }}.gas" wire:model="bloques.{{ $index }}.gas" class="w-full" multiple>

                        <option value="">Seleccione las opciones</option>

                        @foreach ($gas as $item)

                            <option value="{{ $item }}" title="{{ $item }}">{{ $item }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

                <x-input-group for="bloques.{{ $index }}.especiales" label="Especiales" :error="$errors->first('bloques.' . $index . '.especiales')" class="w-full">

                    <x-input-select id="bloques.{{ $index }}.especiales" wire:model="bloques.{{ $index }}.especiales" class="w-full" multiple>

                        <option value="">Seleccione las opciones</option>

                        @foreach ($especiales as $item)

                            <option value="{{ $item }}" title="{{ $item }}">{{ $item }}</option>

                        @endforeach

                    </x-input-select>

                </x-input-group>

            </div>

        </div>

    @endforeach

    @include('livewire.valuacion.comun.errores')

    <div class="bg-white rounded-lg p-4 flex justify-end shadow-xl">

        @if($predio?->avaluo?->estado === 'nuevo')

            <x-button-green
                wire:click="guardar"
                wire:loading.attr="disabled"
                wire:target="guardar">

                <img wire:loading wire:target="guardar" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                Guardar características

            </x-button-green>

        @endif

    </div>

</div>
