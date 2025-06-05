<div>

    @include('livewire.valuacion.comun.avaluo-folio')

    <div class="mb-5">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-1 items-start  mx-auto">

            <div class="bg-white rounded-lg p-1 px-4 flex flex-col text-center">

                <p>Fachada</p>

                @if($fachada)

                    <img class="h-20 w-20 mx-auto my-3" src="{{ $fachada->temporaryUrl() }}" alt="">

                @else

                    @if($predio)

                        <img class="h-20 w-20 mx-auto my-3" src="{{ $predio->avaluo->fachada() }}" alt="">

                    @else

                        <img class="h-20 w-20 mx-auto my-3" src="{{ asset('storage/img/ico.png') }}" alt="">

                    @endif

                @endif

                <label for="fachada" class="bg-gray-400 hover:shadow-lg text-white font-bold px-4 py-1 rounded-full text-sm mb-2 hover:bg-gray-700 cursor-pointer">
                    <img wire:loading wire:target="fachada" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                    Subir archivo
                </label>

                <input type="file" class="sr-only" id="fachada" wire:model.live="fachada">

                <div>

                    @error('fachada') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="bg-white rounded-lg p-1 px-4 flex flex-col text-center">

                <p>Fotografía 2</p>

                @if($foto2)

                    <img class="h-20 w-20 mx-auto my-3" src="{{ $foto2->temporaryUrl() }}" alt="">

                @else

                    @if($predio)

                        <img class="h-20 w-20 mx-auto my-3" src="{{ $predio->avaluo->foto2() }}" alt="">

                    @else

                        <img class="h-20 w-20 mx-auto my-3" src="{{ asset('storage/img/ico.png') }}" alt="">

                    @endif

                @endif

                <label for="foto2" class="bg-gray-400 hover:shadow-lg text-white font-bold px-4 py-1 rounded-full text-sm mb-2 hover:bg-gray-700 cursor-pointer">
                    <img wire:loading wire:target="foto2" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                    Subir archivo
                </label>

                <input type="file" class="sr-only" id="foto2" wire:model.live="foto2">

                <div>

                    @error('foto2') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="bg-white rounded-lg p-1 px-4 flex flex-col text-center">

                <p>Fotografía 3</p>

                @if($foto3)

                    <img class="h-20 w-20 mx-auto my-3" src="{{ $foto3->temporaryUrl() }}" alt="">

                @else

                    @if($predio)

                        <img class="h-20 w-20 mx-auto my-3" src="{{ $predio->avaluo->foto3() }}" alt="">

                    @else

                        <img class="h-20 w-20 mx-auto my-3" src="{{ asset('storage/img/ico.png') }}" alt="">

                    @endif

                @endif

                <label for="foto3" class="bg-gray-400 hover:shadow-lg text-white font-bold px-4 py-1 rounded-full text-sm mb-2 hover:bg-gray-700 cursor-pointer">
                    <img wire:loading wire:target="foto3" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                    Subir archivo
                </label>

                <input type="file" class="sr-only" id="foto3" wire:model.live="foto3">

                <div>

                    @error('foto3') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="bg-white rounded-lg p-1 px-4 flex flex-col text-center">

                <p>Fotografía 4</p>

                @if($foto4)

                    <img class="h-20 w-20 mx-auto my-3" src="{{ $foto4->temporaryUrl() }}" alt="">

                @else

                    @if($predio)

                        <img class="h-20 w-20 mx-auto my-3" src="{{ $predio->avaluo->foto4() }}" alt="">

                    @else

                        <img class="h-20 w-20 mx-auto my-3" src="{{ asset('storage/img/ico.png') }}" alt="">

                    @endif

                @endif

                <label for="foto4" class="bg-gray-400 hover:shadow-lg text-white font-bold px-4 py-1 rounded-full text-sm mb-2 hover:bg-gray-700 cursor-pointer">
                    <img wire:loading wire:target="foto4" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                    Subir archivo
                </label>

                <input type="file" class="sr-only" id="foto4" wire:model.live="foto4">

                <div>

                    @error('foto4') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="bg-white rounded-lg p-1 px-4 flex flex-col text-center">

                <p>Macrolocalización</p>

                @if($macrolocalizacion)

                    <img class="h-20 w-20 mx-auto my-3" src="{{ $macrolocalizacion->temporaryUrl() }}" alt="">

                @else

                      @if($predio)

                        <img class="h-20 w-20 mx-auto my-3" src="{{ $predio->avaluo->macrolocalizacion() }}" alt="">

                    @else

                        <img class="h-20 w-20 mx-auto my-3" src="{{ asset('storage/img/ico.png') }}" alt="">

                    @endif

                @endif

                <label for="macrolocalizacion" class="bg-gray-400 hover:shadow-lg text-white font-bold px-4 py-1 rounded-full text-sm mb-2 hover:bg-gray-700 cursor-pointer">
                    <img wire:loading wire:target="macrolocalizacion" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                    Subir archivo
                </label>

                <input type="file" class="sr-only" id="macrolocalizacion" wire:model.live="macrolocalizacion">

                <div>

                    @error('macrolocalizacion') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="bg-white rounded-lg p-1 px-4 flex flex-col text-center">

                <p>Microlocalización</p>

                @if($microlocalizacion)

                    <img class="h-20 w-20 mx-auto my-3" src="{{ $microlocalizacion->temporaryUrl() }}" alt="">

                @else

                    @if($predio)

                        <img class="h-20 w-20 mx-auto my-3" src="{{ $predio->avaluo->microlocalizacion() }}" alt="">

                    @else

                        <img class="h-20 w-20 mx-auto my-3" src="{{ asset('storage/img/ico.png') }}" alt="">

                    @endif

                @endif

                <label for="microlocalizacion" class="bg-gray-400 hover:shadow-lg text-white font-bold px-4 py-1 rounded-full text-sm mb-2 hover:bg-gray-700 cursor-pointer">
                    <img wire:loading wire:target="microlocalizacion" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                    Subir archivo
                </label>

                <input type="file" class="sr-only" id="microlocalizacion" wire:model.live="microlocalizacion">

                <div>

                    @error('microlocalizacion') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="bg-white rounded-lg p-1 px-4 flex flex-col text-center">

                <p>Representación del poligono (Imagen)</p>

                @if($poligonoImagen)

                    <img class="h-20 w-20 mx-auto my-3" src="{{ $poligonoImagen->temporaryUrl() }}" alt="">

                @else

                    @if($predio)

                        <img class="h-20 w-20 mx-auto my-3" src="{{ $predio->avaluo->poligonoImagen() }}" alt="">

                    @else

                        <img class="h-20 w-20 mx-auto my-3" src="{{ asset('storage/img/ico.png') }}" alt="">

                    @endif

                @endif

                <label for="poligonoImagen" class="bg-gray-400 hover:shadow-lg text-white font-bold px-4 py-1 rounded-full text-sm mb-2 hover:bg-gray-700 cursor-pointer">
                    <img wire:loading wire:target="poligonoImagen" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                    Subir archivo
                </label>

                <input type="file" class="sr-only" id="poligonoImagen" wire:model.live="poligonoImagen">

                <div>

                    @error('poligonoImagen') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="bg-white rounded-lg p-1 px-4 flex flex-col text-center">

                <p>Representación del poligono (DWG)</p>

                <label for="poligonoDwg" class="bg-gray-400 hover:shadow-lg text-white font-bold px-4 py-1 rounded-full text-sm mb-2 hover:bg-gray-700 cursor-pointer">
                    <img wire:loading wire:target="poligonoDwg" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                    Subir archivo
                </label>

                <input type="file" class="sr-only" id="poligonoDwg" wire:model.live="poligonoDwg">

                <div>

                    @error('poligonoDwg') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

        </div>

    </div>

    <div class="bg-white rounded-lg p-1 flex justify-end mb-5">

        <div class=" mx-auto lg:w-1/2">

            <div>

                <h4 class="text-lg mb-1 text-center">Observaciones</h4>

            </div>

            <div>

                <textarea class="bg-white rounded text-xs w-full " rows="4" wire:model="predio.avaluo.observaciones"></textarea>

            </div>

            <div>

                @error('predio.avaluo.observaciones') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

    </div>

    @include('livewire.valuacion.comun.errores')

    <div class="bg-white rounded-lg p-3 flex justify-end mt-5  shadow-xl">

        @if($predio?->avaluo?->estado === 'nuevo')

            <x-button-green
                wire:click="guardar"
                wire:loading.attr="disabled"
                wire:target="guardar">

                <img wire:loading wire:target="guardar" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                Guardar

            </x-button-green>

        @endif

    </div>

</div>
