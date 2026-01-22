<div>

    @include('livewire.valuacion.comun.avaluo-folio')

    <div class="mb-5">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-1 items-start  mx-auto">

            <div class="bg-white rounded-lg p-1 px-4 flex flex-col text-center">

                <p>Fachada</p>

                @if($fachada)

                    <a href="{{ $fachada->temporaryUrl() }}" data-lightbox="imagen" data-title="Fachada">

                        <img class="h-20 w-20 mx-auto my-3" src="{{ $fachada->temporaryUrl() }}" alt="Fachada">

                    </a>

                @else

                    @if($predio)

                        <a href="{{ $predio->avaluo->fachada() }}" data-lightbox="imagen" data-title="Fachada">

                            <img class="h-20 w-20 mx-auto my-3" src="{{ $predio->avaluo->fachada() }}" alt="Fachada">

                        </a>

                    @else

                        <a href="{{ asset('storage/img/ico.png') }}" data-lightbox="imagen" data-title="Fachada">

                            <img class="h-20 w-20 mx-auto my-3" src="{{ asset('storage/img/ico.png') }}" alt="Fachada">

                        </a>

                    @endif

                @endif

                <label for="fachada" class="bg-gray-400 hover:shadow-lg text-white font-bold px-4 py-1 rounded-full text-sm mb-2 hover:bg-gray-700 cursor-pointer">
                    <img wire:loading wire:target="fachada" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                    Subir archivo
                </label>

                <input type="file" class="sr-only" id="fachada" wire:model.live="fachada"  accept="image/png, image/jpeg, image/jpg">

                <div>

                    @error('fachada') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="bg-white rounded-lg p-1 px-4 flex flex-col text-center">

                <p>Fotografía 2</p>

                @if($foto2)

                    <a href="{{ $foto2->temporaryUrl() }}" data-lightbox="imagen" data-title="Foto 2">

                        <img class="h-20 w-20 mx-auto my-3" src="{{ $foto2->temporaryUrl() }}" alt="Foto 2">

                    </a>

                @else

                    @if($predio)

                        <a href="{{ $predio->avaluo->foto2() }}" data-lightbox="imagen" data-title="Foto 2">

                            <img class="h-20 w-20 mx-auto my-3" src="{{ $predio->avaluo->foto2() }}" alt="Foto 2">

                        </a>

                    @else

                        <a href="{{ asset('storage/img/ico.png') }}" data-lightbox="imagen" data-title="Foto 2">

                            <img class="h-20 w-20 mx-auto my-3" src="{{ asset('storage/img/ico.png') }}" alt="Foto 2">

                        </a>

                    @endif

                @endif

                <label for="foto2" class="bg-gray-400 hover:shadow-lg text-white font-bold px-4 py-1 rounded-full text-sm mb-2 hover:bg-gray-700 cursor-pointer">
                    <img wire:loading wire:target="foto2" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                    Subir archivo
                </label>

                <input type="file" class="sr-only" id="foto2" wire:model.live="foto2"  accept="image/png, image/jpeg, image/jpg">

                <div>

                    @error('foto2') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="bg-white rounded-lg p-1 px-4 flex flex-col text-center">

                <p>Fotografía 3</p>

                @if($foto3)

                    <a href="{{ $foto3->temporaryUrl() }}" data-lightbox="imagen" data-title="Foto 3">

                        <img class="h-20 w-20 mx-auto my-3" src="{{ $foto3->temporaryUrl() }}" alt="Foto 3">

                    </a>

                @else

                    @if($predio)

                        <a href="{{ $predio->avaluo->foto3() }}" data-lightbox="imagen" data-title="Foto 3">

                            <img class="h-20 w-20 mx-auto my-3" src="{{ $predio->avaluo->foto3() }}" alt="Foto 3">

                        </a>

                    @else

                        <a href="{{ asset('storage/img/ico.png') }}" data-lightbox="imagen" data-title="Foto 3">

                            <img class="h-20 w-20 mx-auto my-3" src="{{ asset('storage/img/ico.png') }}" alt="Foto 3">

                        </a>

                    @endif

                @endif

                <label for="foto3" class="bg-gray-400 hover:shadow-lg text-white font-bold px-4 py-1 rounded-full text-sm mb-2 hover:bg-gray-700 cursor-pointer">
                    <img wire:loading wire:target="foto3" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                    Subir archivo
                </label>

                <input type="file" class="sr-only" id="foto3" wire:model.live="foto3"  accept="image/png, image/jpeg, image/jpg">

                <div>

                    @error('foto3') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="bg-white rounded-lg p-1 px-4 flex flex-col text-center">

                <p>Fotografía 4</p>

                @if($foto4)

                    <a href="{{  $foto4->temporaryUrl() }}" data-lightbox="imagen" data-title="Foto 4">

                        <img class="h-20 w-20 mx-auto my-3" src="{{ $foto4->temporaryUrl() }}" alt="Foto 4">

                    </a>

                @else

                    @if($predio)

                        <a href="{{  $predio->avaluo->foto4() }}" data-lightbox="imagen" data-title="Foto 4">

                            <img class="h-20 w-20 mx-auto my-3" src="{{ $predio->avaluo->foto4() }}" alt="Foto 4">

                        </a>

                    @else

                        <a href="{{  asset('storage/img/ico.png') }}" data-lightbox="imagen" data-title="Foto 4">

                            <img class="h-20 w-20 mx-auto my-3" src="{{ asset('storage/img/ico.png') }}" alt="Foto 4">

                        </a>

                    @endif

                @endif

                <label for="foto4" class="bg-gray-400 hover:shadow-lg text-white font-bold px-4 py-1 rounded-full text-sm mb-2 hover:bg-gray-700 cursor-pointer">
                    <img wire:loading wire:target="foto4" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                    Subir archivo
                </label>

                <input type="file" class="sr-only" id="foto4" wire:model.live="foto4"  accept="image/png, image/jpeg, image/jpg">

                <div>

                    @error('foto4') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="bg-white rounded-lg p-1 px-4 flex flex-col text-center">

                <p>Macrolocalización</p>

                @if($macrolocalizacion)

                    <a href="{{ $macrolocalizacion->temporaryUrl() }}" data-lightbox="imagen" data-title="Macrolocalización">

                        <img class="h-20 w-20 mx-auto my-3" src="{{ $macrolocalizacion->temporaryUrl() }}" alt="Macrolocalización">

                    </a>

                @else

                      @if($predio)

                        <a href="{{ $predio->avaluo->macrolocalizacion() }}" data-lightbox="imagen" data-title="Macrolocalización">

                            <img class="h-20 w-20 mx-auto my-3" src="{{ $predio->avaluo->macrolocalizacion() }}" alt="Macrolocalización">

                        </a>

                    @else

                        <a href="{{ asset('storage/img/ico.png') }}" data-lightbox="imagen" data-title="Macrolocalización">

                            <img class="h-20 w-20 mx-auto my-3" src="{{ asset('storage/img/ico.png') }}" alt="Macrolocalización">

                        </a>

                    @endif

                @endif

                <label for="macrolocalizacion" class="bg-gray-400 hover:shadow-lg text-white font-bold px-4 py-1 rounded-full text-sm mb-2 hover:bg-gray-700 cursor-pointer">
                    <img wire:loading wire:target="macrolocalizacion" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                    Subir archivo
                </label>

                <input type="file" class="sr-only" id="macrolocalizacion" wire:model.live="macrolocalizacion"  accept="image/png, image/jpeg, image/jpg">

                <div>

                    @error('macrolocalizacion') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="bg-white rounded-lg p-1 px-4 flex flex-col text-center">

                <p>Microlocalización</p>

                @if($microlocalizacion)

                    <a href="{{ $microlocalizacion->temporaryUrl() }}" data-lightbox="imagen" data-title="Microlocalización">

                        <img class="h-20 w-20 mx-auto my-3" src="{{ $microlocalizacion->temporaryUrl() }}" alt="Microlocalización">

                    </a>

                @else

                    @if($predio)

                        <a href="{{ $predio->avaluo->microlocalizacion() }}" data-lightbox="imagen" data-title="Microlocalización">

                            <img class="h-20 w-20 mx-auto my-3" src="{{ $predio->avaluo->microlocalizacion() }}" alt="Microlocalización">

                        </a>

                    @else

                        <a href="{{ asset('storage/img/ico.png') }}" data-lightbox="imagen" data-title="Microlocalización">

                            <img class="h-20 w-20 mx-auto my-3" src="{{ asset('storage/img/ico.png') }}" alt="Microlocalización">

                        </a>

                    @endif

                @endif

                <label for="microlocalizacion" class="bg-gray-400 hover:shadow-lg text-white font-bold px-4 py-1 rounded-full text-sm mb-2 hover:bg-gray-700 cursor-pointer">
                    <img wire:loading wire:target="microlocalizacion" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                    Subir archivo
                </label>

                <input type="file" class="sr-only" id="microlocalizacion" wire:model.live="microlocalizacion"  accept="image/png, image/jpeg, image/jpg">

                <div>

                    @error('microlocalizacion') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="bg-white rounded-lg p-1 px-4 flex flex-col text-center">

                <p>Representación del poligono (Imagen)</p>

                @if($poligonoImagen)

                    <a href="{{ $poligonoImagen->temporaryUrl() }}" data-lightbox="imagen" data-title="Representación del poligono">

                        <img class="h-20 w-20 mx-auto my-3" src="{{ $poligonoImagen->temporaryUrl() }}" alt="Representación del poligono">

                    </a>

                @else

                    @if($predio)

                        <a href="{{ $predio->avaluo->poligonoImagen() }}" data-lightbox="imagen" data-title="Representación del poligono">

                            <img class="h-20 w-20 mx-auto my-3" src="{{ $predio->avaluo->poligonoImagen() }}" alt="Representación del poligono">

                        </a>

                    @else

                        <a href="{{ asset('storage/img/ico.png') }}" data-lightbox="imagen" data-title="Representación del poligono">

                            <img class="h-20 w-20 mx-auto my-3" src="{{ asset('storage/img/ico.png') }}" alt="Representación del poligono">

                        </a>

                    @endif

                @endif

                <label for="poligonoImagen" class="bg-gray-400 hover:shadow-lg text-white font-bold px-4 py-1 rounded-full text-sm mb-2 hover:bg-gray-700 cursor-pointer">
                    <img wire:loading wire:target="poligonoImagen" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                    Subir archivo
                </label>

                <input type="file" class="sr-only" id="poligonoImagen" wire:model.live="poligonoImagen" accept="image/png, image/jpeg, image/jpg">

                <div>

                    @error('poligonoImagen') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="bg-white rounded-lg p-1 px-4 flex flex-col text-center">

                <div class="mb-3">

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

                <div>

                    <p>Anexo</p>

                    <label for="anexo" class="bg-gray-400 hover:shadow-lg text-white font-bold px-4 py-1 rounded-full text-sm mb-2 hover:bg-gray-700 cursor-pointer">
                        <img wire:loading wire:target="anexo" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                        Subir archivo
                    </label>

                    <input type="file" class="sr-only" id="anexo" wire:model.live="anexo">

                    <div>

                        @error('anexo') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="bg-white rounded-lg p-1 flex justify-end mb-5">

        <div class="mx-auto w-full lg:w-1/2">

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
