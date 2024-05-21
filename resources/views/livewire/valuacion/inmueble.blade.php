<div class="p-4 mb-1">

    @if(isset($predio->avaluo->folio))

        <div class="space-y-2 mb-5 bg-white rounded-lg p-2 text-right">

            <span class="bg-blue-400 text-white text-sm rounded-full px-2 py-1">Folio de avaluo: {{ $predio->avaluo->año }}-{{ $predio->avaluo->folio }}</span>

        </div>

    @endif

    <div class="space-y-2 mb-5 bg-white rounded-lg p-2">

        <h4 class="text-lg mb-5 text-center">Consultar predio</h4>

        <div class="flex-auto ">

            <div class="">

                <div class="flex-row lg:flex lg:space-x-2 mb-2 space-y-2 lg:space-y-0 items-center justify-center" >

                    <div class="text-left">

                        <Label class="text-base tracking-widest rounded-xl border-gray-500">Cuenta predial</Label>

                    </div>

                    <div class="space-y-1">

                        <input @if($predio->avaluo?->folio) readonly @endif title="Localidad" placeholder="Localidad" type="number" class="bg-white rounded text-xs w-20 @error('predio.localidad') border-1 border-red-500 @enderror" wire:model.blur="predio.localidad">

                        <input @if($predio->avaluo?->folio) readonly @endif title="Oficina" placeholder="Oficina" type="number" class="bg-white rounded text-xs w-20 @error('predio.oficina') border-1 border-red-500 @enderror" wire:model="predio.oficina">

                        <input @if($predio->avaluo?->folio) readonly @endif title="Tipo de predio" placeholder="Tipo" type="number" class="bg-white rounded text-xs w-20 @error('predio.tipo_predio') border-1 border-red-500 @enderror" wire:model="predio.tipo_predio">

                        <input @if($predio->avaluo?->folio) readonly @endif title="Número de registro" placeholder="Registro" type="number" class="bg-white rounded text-xs w-20 @error('predio.numero_registro') border-1 border-red-500 @enderror" wire:model.blur="predio.numero_registro">

                    </div>

                </div>

                <div class="flex-row lg:flex lg:space-x-2 space-y-2 lg:space-y-0 items-center justify-center">

                     <div class="text-left">

                        <Label class="text-base tracking-widest rounded-xl border-gray-500">Clave catastral </Label>

                    </div>

                    <div class="space-y-1">

                        <input placeholder="Estado" type="number" class="bg-white rounded text-xs w-20" title="Estado" value="16" readonly>

                        <input readonly title="Región catastral" placeholder="Región" type="number" class="bg-white rounded text-xs w-20  @error('predio.region_catastral') border-1 border-red-500 @enderror" wire:model="predio.region_catastral">

                        <input readonly title="Municipio" placeholder="Municipio" type="number" class="bg-white rounded text-xs w-20 @error('predio.municipio') border-1 border-red-500 @enderror" wire:model="predio.municipio">

                        <input readonly title="Zona" placeholder="Zona" type="number" class="bg-white rounded text-xs w-20 @error('predio.zona_catastral') border-1 border-red-500 @enderror" wire:model="predio.zona_catastral">

                        <input readonly title="Localidad" placeholder="Localidad" type="number" class="bg-white rounded text-xs w-20 @error('predio.localidad') border-1 border-red-500 @enderror" wire:model.blur="predio.localidad">

                        <input readonly title="Sector" placeholder="Sector" type="number" class="bg-white rounded text-xs w-20 @error('predio.sector') border-1 border-red-500 @enderror" wire:model="predio.sector">

                        <input readonly title="Manzana" placeholder="Manzana" type="number" class="bg-white rounded text-xs w-20 @error('predio.manzana') border-1 border-red-500 @enderror" wire:model="predio.manzana">

                        <input readonly title="Predio" placeholder="Predio" type="number" class="bg-white rounded text-xs w-20 @error('predio.predio') border-1 border-red-500 @enderror" wire:model.blur="predio.predio">

                        <input readonly title="Edificio" placeholder="Edificio" type="number" class="bg-white rounded text-xs w-20 @error('predio.edificio') border-1 border-red-500 @enderror" wire:model="predio.edificio">

                        <input readonly title="Departamento" placeholder="Departamento" type="number" class="bg-white rounded text-xs w-20 @error('predio.departamento') border-1 border-red-500 @enderror" wire:model="predio.departamento">

                    </div>

                </div>

            </div>

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

    <div class="space-y-2 mb-5 bg-white rounded-lg p-3">

        <h4 class="text-lg mb-5 text-center">Propietario</h4>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-7 gap-3 items-start">

            <div class="flex-auto ">

                <div>

                    <label class="text-sm" >Apellido Paterno</label>

                </div>

                <div>

                    <input type="text" class="bg-white rounded text-xs w-full" wire:model="ap_paterno" @if($flag) readonly @endif>

                </div>

                <div>

                    @error('ap_paterno') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="flex-auto ">

                <div>

                    <Label class="text-sm">Apellido Materno</Label>
                </div>

                <div>

                    <input type="text" class="bg-white rounded text-xs w-full" wire:model="ap_materno" @if($flag) readonly @endif>

                </div>

                <div>

                    @error('ap_materno') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="flex-auto ">

                <div>

                    <Label class="text-sm">Nombre</Label>
                </div>

                <div>

                    <input type="text" class="bg-white rounded text-xs w-full" wire:model="nombre" @if($flag) readonly @endif>

                </div>

                <div>

                    @error('nombre') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="flex-auto ">

                <div>

                    <Label class="text-sm">Tipo de persona</Label>
                </div>

                <div>

                    <select class="bg-white rounded text-xs w-full" wire:model="tipo_persona" @if($flag) disabled @endif>

                        <option value="" selected>Seleccione una opción</option>
                        <option value="FISICA" selected>Fisica</option>
                        <option value="MORAL" selected>Moral</option>

                    </select>

                </div>

                <div>

                    @error('tipo_persona') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="flex-auto ">

                <div>

                    <Label class="text-sm">Tipo de propietario</Label>
                </div>

                <div>

                    <select class="bg-white rounded text-xs w-full" wire:model="tipo_propietario" @if($flag) disabled @endif>
                        <option value="" selected>Seleccione una opción</option>

                        @foreach ($tipoPropietarios as $item)

                            <option value="{{ $item }}" selected>{{ $item }}</option>

                        @endforeach

                    </select>

                </div>

                <div>

                    @error('tipo_propietario') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="flex-auto ">

                <div>

                    <Label class="text-sm">Porcentaje</Label>
                </div>

                <div>

                    <input type="number" class="bg-white rounded text-xs w-full" wire:model="porcentaje" @if($flag) readonly @endif>

                </div>

                <div>

                    @error('porcentaje') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="flex-auto ">

                <div>

                    <Label class="text-sm">Sociedad</Label>
                </div>

                <div>

                    <input type="checkbox" class="bg-white rounded text-xs" wire:model="predio.sociedad" @if($flag) disabled @endif>

                </div>

            </div>

        </div>

    </div>

    <div class="space-y-2 mb-5 bg-white rounded-lg p-3">

        <h4 class="text-lg mb-5 text-center">Ubicación del predio</h4>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-3 items-start">

            <div class="flex-auto">

                <div>

                    <Label class="text-sm">Tipo de asentamiento</Label>
                </div>

                <div>

                    <select class="bg-white rounded text-xs w-full" wire:model="predio.tipo_asentamiento">
                        <option value="" selected>Seleccione una opción</option>

                        @foreach ($tipoAsentamientos as $item)

                            <option value="{{ $item }}" selected>{{ $item }}</option>

                        @endforeach

                    </select>

                </div>

                <div>

                    @error('predio.tipo_asentamiento') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="flex-auto">

                <div class="">

                    <label class="text-sm " >Nombre del asentamiento</label>

                </div>

                <div>

                    <input type="text" class="bg-white rounded text-xs w-full" wire:model="predio.nombre_asentamiento">

                </div>

                <div>

                    @error('predio.nombre_asentamiento') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="flex-auto ">

                <div>

                    <Label class="text-sm">Tipo de vialidad</Label>
                </div>

                <div>

                    <select class="bg-white rounded text-xs w-full" wire:model="predio.tipo_vialidad">
                        <option value="" selected>Seleccione una opción</option>

                        @foreach ($tipoVialidades as $item)

                            <option value="{{ $item }}" selected>{{ $item }}</option>

                        @endforeach

                    </select>

                </div>

                <div>

                    @error('predio.tipo_vialidad') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="flex-auto ">

                <div>

                    <label class="text-sm" >Nombre de la vialidad</label>

                </div>

                <div>

                    <input type="text" class="bg-white rounded text-xs w-full" wire:model="predio.nombre_vialidad">

                </div>

                <div>

                    @error('predio.nombre_vialidad') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="flex-auto ">

                <div>

                    <label class="text-sm" >Número exterior</label>

                </div>

                <div>

                    <input type="text" class="bg-white rounded text-xs w-full" wire:model="predio.numero_exterior">

                </div>

                <div>

                    @error('predio.numero_exterior') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="flex-auto ">

                <div>

                    <label class="text-sm" >Número exterior 2</label>

                </div>

                <div>

                    <input type="text" class="bg-white rounded text-xs w-full" wire:model="predio.numero_exterior_2">

                </div>

                <div>

                    @error('predio.numero_exterior_2') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="flex-auto ">

                <div>

                    <label class="text-sm" >Número interior</label>

                </div>

                <div>

                    <input type="text" class="bg-white rounded text-xs w-full" wire:model="predio.numero_interior">

                </div>

                <div>

                    @error('predio.numero_interior') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="flex-auto ">

                <div>

                    <label class="text-sm" >Número adicional</label>

                </div>

                <div>

                    <input type="text" class="bg-white rounded text-xs w-full" wire:model="predio.numero_adicional">

                </div>

                <div>

                    @error('predio.numero_adicional') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="flex-auto ">

                <div>

                    <label class="text-sm" >Número adicional 2</label>

                </div>

                <div>

                    <input type="text" class="bg-white rounded text-xs w-full" wire:model="predio.numero_adicional_2">

                </div>

                <div>

                    @error('predio.numero_adicional_2') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="flex-auto ">

                <div>

                    <label class="text-sm" >Código postal</label>

                </div>

                <div>

                    <input type="number" class="bg-white rounded text-xs w-full" wire:model="predio.codigo_postal">

                </div>

                <div>

                    @error('predio.codigo_postal') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="flex-auto ">

                <div>

                    <label class="text-sm" >Lote del fraccionador</label>

                </div>

                <div>

                    <input type="number" class="bg-white rounded text-xs w-full" wire:model="predio.lote_fraccionador">

                </div>

                <div>

                    @error('predio.lote_fraccionador') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="flex-auto ">

                <div>

                    <label class="text-sm" >Manzana del fraccionador</label>

                </div>

                <div>

                    <input type="number" class="bg-white rounded text-xs w-full" wire:model="predio.manzana_fraccionador">

                </div>

                <div>

                    @error('predio.manzana_fraccionador') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="flex-auto ">

                <div>

                    <label class="text-sm" >Etapa o zona del fraccionador</label>

                </div>

                <div>

                    <input type="number" class="bg-white rounded text-xs w-full" wire:model="predio.etapa_fraccionador">

                </div>

                <div>

                    @error('predio.etapa_fraccionador') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="flex-auto ">

                <div>

                    <label class="text-sm">Nombre del Edificio</label>

                </div>

                <div>

                    <input type="text" class="bg-white rounded text-xs w-full" wire:model="predio.nombre_edificio">

                </div>

                <div>

                    @error('predio.nombre_edificio') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="flex-auto ">

                <div>

                    <label class="text-sm">Clave del edificio</label>

                </div>

                <div>

                    <input type="text" class="bg-white rounded text-xs w-full" wire:model="predio.clave_edificio">

                </div>

                <div>

                    @error('predio.clave_edificio') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="flex-auto ">

                <div>

                    <label class="text-sm">Departamento</label>

                </div>

                <div>

                    <input type="text" class="bg-white rounded text-xs w-full" wire:model="predio.departamento_edificio">

                </div>

                <div>

                    @error('predio.departamento_edificio') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div class="flex-auto col-span-2">

                <div>

                    <label class="text-sm">Predio Rústico Denominado ó Antecedente</label>

                </div>

                <div>

                    <input type="text" class="bg-white rounded text-xs w-full" wire:model="predio.nombre_predio">

                </div>

                <div>

                    @error('predio.nombre_predio') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

        </div>

    </div>

    <div class="space-y-2 mb-5 bg-white rounded-lg p-3">

        <h4 class="text-lg mb-5 text-center">Coordenadas geografícas</h4>

        <div class="flex-auto ">

            <div class="">

                <div class="flex-row lg:flex lg:space-x-2 mb-2 space-y-2 lg:space-y-0 items-center justify-center" >

                    <div class="text-left">

                        <Label class="text-base tracking-widest rounded-xl border-gray-500">UTM</Label>

                    </div>

                    <div class="space-y-1">

                        <input placeholder="X" type="text" class="bg-white rounded text-xs w-40 @error('predio.xutm') border-red-500 @enderror" wire:model.blur="predio.xutm">

                        <input placeholder="Y" type="text" class="bg-white rounded text-xs w-40 @error('predio.yutm') border-red-500 @enderror" wire:model.blur="predio.yutm">

                        <select class="bg-white rounded text-xs" wire:model.blur="predio.zutm">

                            <option value="" selected>Z</option>
                            <option value="13" selected>13</option>
                            <option value="14" selected>14</option>

                        </select>

                        <input placeholder="Norte" type="text" class="bg-white rounded text-xs w-40" readonly>

                    </div>

                </div>

            </div>

            <div class="">

                <div class="flex-row lg:flex lg:space-x-2 mb-2 space-y-2 lg:space-y-0 items-center justify-center" >

                    <div class="text-left">

                        <Label class="text-base tracking-widest rounded-xl border-gray-500">GEO</Label>

                    </div>

                    <div class="space-y-1">

                        <input placeholder="Lat" type="number" class="bg-white rounded text-xs w-40 @error('predio.lat') border-red-500 @enderror" wire:model.blur="predio.lat">

                        <input placeholder="Lon" type="number" class="bg-white rounded text-xs w-40 @error('predio.lon') border-red-500 @enderror" wire:model.blur="predio.lon">

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="bg-white rounded-lg p-3 flex justify-end">

        @if(count($errors) > 0)

            <span class="bg-red-400 hover:shadow-lg text-white text-xs md:text-sm px-3 py-1 ml-auto rounded-full  hover:bg-red-700 flex items-center justify-center focus:outline-none ">
                Campos incorrectos {{ $errors }}
            </span>

        @endif

        @if(!$editar)

            <x-button-green
                wire:click="crear"
                wire:loading.attr="disabled"
                wire:target="crear"
            >

                <img wire:loading wire:target="crear" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                Guardar

            </x-button-green>

        @else

            <x-button-green
                wire:click="actualizar"
                wire:loading.attr="disabled"
                wire:target="actualizar"
            >

                <img wire:loading wire:target="actualizar" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                Actualizar

            </x-button-green>

        @endif

    </div>

</div>
