<div class="p-4 mb-1">

    @include('livewire.valuacion.comun.avaluo-folio')

    @if($predio)

        <div class="space-y-5 mb-5">

            @include('livewire.valuacion.comun.terrenos')

            @include('livewire.valuacion.comun.construcciones')

            @if($predio->edificio != 0)

                @include('livewire.valuacion.comun.terrenos-comun')

                @include('livewire.valuacion.comun.construcciones-comun')

            @endif

        </div>

        <div class="bg-white rounded-lg p-3 flex justify-end  shadow-xl">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 items-center justify-center  mx-auto">

                <div class="bg-gray-100 p-4 rounded-xl">

                    <h4 class="text-lg mb-5 text-center">Superficies</h4>

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
                                <td class="text-right">Superficie de terreno</td>
                                <td><input readonly class="bg-white rounded text-xs w-full text-right" type="text" value="{{ $predio->superficie_terreno }}"></td>
                                <td><input readonly class="bg-white rounded text-xs w-full text-right" type="text" value="{{ $predio->terrenosComun->sum('superficie_proporcional') }}"></td>
                                <td><input readonly class="bg-white rounded text-xs w-full text-right" type="text" value="{{ $predio->superficie_terreno + $predio->terrenosComun->sum('superficie_proporcional')}}"></td>
                            </tr>

                            <tr>
                                <td class="text-right">Superficie de construcción</td>
                                <td><input readonly class="bg-white rounded text-xs w-full text-right" type="text" value="{{ $predio->superficie_construccion }}"></td>
                                <td><input readonly class="bg-white rounded text-xs w-full text-right" type="text" value="{{ $predio->construccionesComun->sum('superficie_proporcional') }}"></td>
                                <td><input readonly class="bg-white rounded text-xs w-full text-right" type="text" value="{{ $predio->superficie_construccion  + $predio->construccionesComun->sum('superficie_proporcional') }}"></td>
                            </tr>

                        </tbody>

                    </table>

                </div>

                <div class="bg-gray-100 p-4 rounded-xl">

                    <h4 class="text-lg mb-5 text-center">Valores</h4>

                    <table class="mx-auto">

                        <tbody>

                            <tr>
                                <td class="text-sm text-right">Privativa + Proporcional Terreno</td>
                                <td><input readonly class="bg-white rounded text-xs w-full ml-4 text-right" type="text" value="${{ number_format($predio->valor_total_terreno, 2) }}"></td>
                            </tr>

                            <tr>
                                <td class="text-sm text-right">Privativa + Proporcional Construcción</td>
                                <td><input readonly class="bg-white rounded text-xs w-full ml-4 text-right" type="text" value="${{ number_format($predio->valor_total_construccion, 2) }}"></td>
                            </tr>

                            @if($this->predio->ubicacion_en_manzana == 'ESQUINA')

                                <tr>
                                    <td class="text-sm text-right">Sub Total</td>
                                    <td><input readonly class="bg-white rounded text-xs w-full ml-4 text-right" type="text" value="${{ number_format($predio->valor_total_terreno + $predio->valor_total_construccion, 2) }}"></td>
                                </tr>

                                <tr>
                                    <td class="text-sm text-right">Ubicación en esquina</td>
                                    <td><input readonly class="bg-white rounded text-xs w-full ml-4 text-right" type="text" value="${{ number_format(($predio->valor_total_terreno + $predio->valor_total_construccion) * 0.15, 2) }}"></td>
                                </tr>

                                <tr>
                                    <td class="text-sm text-right">Total</td>
                                    <td><input readonly class="bg-white rounded text-xs w-full ml-4 text-right" type="text" value="${{ number_format(($predio->valor_total_terreno + $predio->valor_total_construccion) + ($predio->valor_total_terreno + $predio->valor_total_construccion) * 0.15, 2) }}"></td>
                                </tr>

                            @else

                                <tr>
                                    <td class="text-sm text-right">Total</td>
                                    <td><input readonly class="bg-white rounded text-xs w-full ml-4 text-right" type="text" value="${{ number_format($predio->valor_total_terreno + $predio->valor_total_construccion, 2) }}"></td>
                                </tr>

                            @endif

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    @endif

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
