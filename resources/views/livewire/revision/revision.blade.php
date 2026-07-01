<div>

    <x-header>Revisión</x-header>

    <div class="space-y-2 mb-5 bg-white rounded-lg p-2 shadow-lg">

        <x-input-group for="perito" label="Peritos" :error="$errors->first('perito')" class="w-fit mx-auto mb-5">

            <x-input-select id="perito" wire:model.live="perito">

                <option value="">Seleccione una opción</option>

                @foreach ($peritos as $perito_item)


                    <option value="{{ $perito_item->id }}">{{ $perito_item->name }}</option>

                @endforeach

            </x-input-select>

        </x-input-group>

        @if($perito)

            <button
                wire:click="revisarAvaluo"
                wire:loading.attr="disabled"
                wire:target="revisarAvaluo"
                type="button"
                class="bg-blue-400 hover:shadow-lg mx-auto text-white font-bold px-4 py-2 rounded text-xs hover:bg-blue-700 focus:outline-none flex items-center justify-center focus:outline-blue-400 focus:outline-offset-2">

                <img wire:loading wire:target="revisarAvaluo" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                Revisar avalúo aleatoriamente

            </button>

        @endif

    </div>

</div>
