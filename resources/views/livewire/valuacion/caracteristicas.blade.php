<div>

    @include('livewire.valuacion.comun.avaluo-folio')

    <div class="space-y-2 mb-5 bg-white rounded-lg p-2">

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 items-start md:w-2/3 mx-auto mb-4">

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

    <div class="space-y-2 mb-5 bg-white rounded-lg p-2">

        <h4 class="text-lg mb-5 text-center">Obra negra</h4>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-5 gap-3 items-end mx-auto">

            <x-input-group for="avaluo.cimentacion" label="Cimentación" :error="$errors->first('avaluo.cimentacion')" class="w-full">

                <x-input-select id="avaluo.cimentacion" wire:model="avaluo.cimentacion" class="w-full">

                    <option value="">Seleccione una opción</option>

                    @foreach ($cimentaciones as $item)

                        <option value="{{ $item }}">{{ $item }}</option>

                    @endforeach

                </x-input-select>

            </x-input-group>

            <x-input-group for="avaluo.estructura" label="Estructura" :error="$errors->first('avaluo.estructura')" class="w-full">

                <x-input-select id="avaluo.estructura" wire:model="avaluo.estructura" class="w-full">

                    <option value="">Seleccione una opción</option>

                    @foreach ($estructuras as $item)

                        <option value="{{ $item }}">{{ $item }}</option>

                    @endforeach

                </x-input-select>

            </x-input-group>

            <x-input-group for="avaluo.muros" label="Muros" :error="$errors->first('avaluo.muros')" class="w-full">

                <x-input-select id="avaluo.muros" wire:model="avaluo.muros" class="w-full">

                    <option value="">Seleccione una opción</option>

                    @foreach ($muros as $item)

                        <option value="{{ $item }}">{{ $item }}</option>

                    @endforeach

                </x-input-select>

            </x-input-group>

            <x-input-group for="avaluo.entrepiso" label="Entrepisos" :error="$errors->first('avaluo.entrepiso')" class="w-full">

                <x-input-select id="avaluo.entrepiso" wire:model="avaluo.entrepiso" class="w-full">

                    <option value="">Seleccione una opción</option>

                    @foreach ($entrepisos as $item)

                        <option value="{{ $item }}">{{ $item }}</option>

                    @endforeach

                </x-input-select>

            </x-input-group>

            <x-input-group for="avaluo.techo" label="Techo" :error="$errors->first('avaluo.techo')" class="w-full">

                <x-input-select id="avaluo.techo" wire:model="avaluo.techo" class="w-full">

                    <option value="">Seleccione una opción</option>

                    @foreach ($techos as $item)

                        <option value="{{ $item }}">{{ $item }}</option>

                    @endforeach

                </x-input-select>

            </x-input-group>

        </div>

    </div>

    <div class="space-y-2 mb-5 bg-white rounded-lg p-2">

        <h4 class="text-lg mb-5 text-center">Acabados</h4>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-9 gap-3 items-end mx-auto">

            <x-input-group for="avaluo.plafones" label="Plafones" :error="$errors->first('avaluo.plafones')" class="w-full">

                <x-input-select id="avaluo.plafones" wire:model="avaluo.plafones" class="w-full">

                    <option value="">Seleccione una opción</option>

                    @foreach ($plafones as $item)

                        <option value="{{ $item }}">{{ $item }}</option>

                    @endforeach

                </x-input-select>

            </x-input-group>

            <x-input-group for="avaluo.vidrieria" label="Vidriería" :error="$errors->first('avaluo.vidrieria')" class="w-full">

                <x-input-select id="avaluo.vidrieria" wire:model="avaluo.vidrieria" class="w-full">

                    <option value="">Seleccione una opción</option>

                    @foreach ($vidrieria as $item)

                        <option value="{{ $item }}">{{ $item }}</option>

                    @endforeach

                </x-input-select>

            </x-input-group>

            <x-input-group for="avaluo.lambrines" label="Lambrines" :error="$errors->first('avaluo.lambrines')" class="w-full">

                <x-input-select id="avaluo.lambrines" wire:model="avaluo.lambrines" class="w-full">

                    <option value="">Seleccione una opción</option>

                    @foreach ($lambrines as $item)

                        <option value="{{ $item }}">{{ $item }}</option>

                    @endforeach

                </x-input-select>

            </x-input-group>

            <x-input-group for="avaluo.pisos" label="Pisos" :error="$errors->first('avaluo.pisos')" class="w-full">

                <x-input-select id="avaluo.pisos" wire:model="avaluo.pisos" class="w-full">

                    <option value="">Seleccione una opción</option>

                    @foreach ($pisos as $item)

                        <option value="{{ $item }}">{{ $item }}</option>

                    @endforeach

                </x-input-select>

            </x-input-group>

            <x-input-group for="avaluo.herreria" label="Herrería" :error="$errors->first('avaluo.herreria')" class="w-full">

                <x-input-select id="avaluo.herreria" wire:model="avaluo.herreria" class="w-full">

                    <option value="">Seleccione una opción</option>

                    @foreach ($herreria as $item)

                        <option value="{{ $item }}">{{ $item }}</option>

                    @endforeach

                </x-input-select>

            </x-input-group>

            <x-input-group for="avaluo.pintura" label="Pintura" :error="$errors->first('avaluo.pintura')" class="w-full">

                <x-input-select id="avaluo.pintura" wire:model="avaluo.pintura" class="w-full">

                    <option value="">Seleccione una opción</option>

                    @foreach ($pintura as $item)

                        <option value="{{ $item }}">{{ $item }}</option>

                    @endforeach

                </x-input-select>

            </x-input-group>

            <x-input-group for="avaluo.carpinteria" label="Carpintería" :error="$errors->first('avaluo.carpinteria')" class="w-full">

                <x-input-select id="avaluo.carpinteria" wire:model="avaluo.carpinteria" class="w-full">

                    <option value="">Seleccione una opción</option>

                    @foreach ($carpinteria as $item)

                        <option value="{{ $item }}">{{ $item }}</option>

                    @endforeach

                </x-input-select>

            </x-input-group>

            <x-input-group for="avaluo.aplanados" label="Aplanados" :error="$errors->first('avaluo.aplanados')" class="w-full">

                <x-input-select id="avaluo.aplanados" wire:model="avaluo.aplanados" class="w-full">

                    <option value="">Seleccione una opción</option>

                    @foreach ($aplanados as $item)

                        <option value="{{ $item }}">{{ $item }}</option>

                    @endforeach

                </x-input-select>

            </x-input-group>

            <x-input-group for="avaluo.recubrimiento_especial" label="Recubrimiento especial" :error="$errors->first('avaluo.recubrimiento_especial')" class="w-full">

                <x-input-select id="avaluo.recubrimiento_especial" wire:model="avaluo.recubrimiento_especial" class="w-full">

                    <option value="">Seleccione una opción</option>

                    @foreach ($rec_especial as $item)

                        <option value="{{ $item }}">{{ $item }}</option>

                    @endforeach

                </x-input-select>

            </x-input-group>

        </div>

    </div>

    <div class="space-y-2 mb-5 bg-white rounded-lg p-2">

        <h4 class="text-lg mb-5 text-center">Instalaciones</h4>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-5 gap-3 items-end mx-auto">

            <x-input-group for="avaluo.hidraulica" label="Hidráulica" :error="$errors->first('avaluo.hidraulica')" class="w-full">

                <x-input-select id="avaluo.hidraulica" wire:model="avaluo.hidraulica" class="w-full">

                    <option value="">Seleccione una opción</option>

                    @foreach ($hidraulica as $item)

                        <option value="{{ $item }}">{{ $item }}</option>

                    @endforeach

                </x-input-select>

            </x-input-group>

            <x-input-group for="avaluo.sanitaria" label="Sanitaria" :error="$errors->first('avaluo.sanitaria')" class="w-full">

                <x-input-select id="avaluo.sanitaria" wire:model="avaluo.sanitaria" class="w-full">

                    <option value="">Seleccione una opción</option>

                    @foreach ($sanitaria as $item)

                        <option value="{{ $item }}">{{ $item }}</option>

                    @endforeach

                </x-input-select>

            </x-input-group>

            <x-input-group for="avaluo.electrica" label="Eléctrica" :error="$errors->first('avaluo.electrica')" class="w-full">

                <x-input-select id="avaluo.electrica" wire:model="avaluo.electrica" class="w-full">

                    <option value="">Seleccione una opción</option>

                    @foreach ($electrica as $item)

                        <option value="{{ $item }}">{{ $item }}</option>

                    @endforeach

                </x-input-select>

            </x-input-group>

            <x-input-group for="avaluo.gas" label="Gas" :error="$errors->first('avaluo.gas')" class="w-full">

                <x-input-select id="avaluo.gas" wire:model="avaluo.gas" class="w-full">

                    <option value="">Seleccione una opción</option>

                    @foreach ($gas as $item)

                        <option value="{{ $item }}">{{ $item }}</option>

                    @endforeach

                </x-input-select>

            </x-input-group>

            <x-input-group for="avaluo.especiales" label="Especiales" :error="$errors->first('avaluo.especiales')" class="w-full">

                <x-input-select id="avaluo.especiales" wire:model="avaluo.especiales" class="w-full">

                    <option value="">Seleccione una opción</option>

                    @foreach ($especiales as $item)

                        <option value="{{ $item }}">{{ $item }}</option>

                    @endforeach

                </x-input-select>

            </x-input-group>

        </div>

    </div>

    @include('livewire.valuacion.comun.errores')

    <div class="bg-white rounded-lg p-4 flex justify-end">

        @if($predio?->avaluo?->estado === 'nuevo')

            <x-button-green
                wire:click="guardar"
                wire:loading.attr="disabled"
                wire:target="guardar">

                <img wire:loading wire:target="guardar" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                Guardar colindancias

            </x-button-green>

        @endif

    </div>

</div>
