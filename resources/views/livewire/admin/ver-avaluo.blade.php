<div>

    @push('styles')

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @endpush

    <x-header>Avaluo</x-header>

    <div class="bg-white p-4 rounded-lg w-full shadow-lg mb-5 overflow-x-auto flex justify-between gap-5">

        @if($avaluo->anexo())

            <x-link-blue href="{{ $avaluo->anexo() }}" target="_blank">

                <img wire:loading wire:target="verTramiteAviso" class="h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                Anexo
            </x-link-blue>

        @else

            <div></div>

        @endif

        <button
            wire:click="$toggle('modal_revision')"
            wire:loading.attr="disabled"
            wire:target="$toggle('modal_revision')"
            type="button"
            class="bg-blue-400 hover:shadow-lg  text-white font-bold px-4 py-2 rounded-full text-xs hover:bg-blue-700 focus:outline-none flex items-center justify-center focus:outline-blue-400 focus:outline-offset-2">

            <img wire:loading wire:target="$toggle('modal_revision')" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

            Generar revisión

        </button>

    </div>

    @include('admin.comun.datos_generales_avaluo')

    @include('admin.comun.datos_generales_predio')

    @include('admin.comun.ubicacion')

    @include('admin.comun.colindancias')

    @include('admin.comun.terrenos')

    @include('admin.comun.construcciones')

    @include('admin.comun.terrenos_comun')

    @include('admin.comun.construcciones_comun')

    @include('admin.comun.caracteristicas_avaluo')

    @include('admin.comun.propietarios')

    @include('admin.comun.imagenes_avaluo')

    @include('admin.comun.revisiones')

    <x-dialog-modal wire:model="modal_revision"  maxWidth="sm">

        <x-slot name="title">

            Generar revisión

        </x-slot>

        <x-slot name="content">

            <x-input-group for="observacion" label="Observación" :error="$errors->first('observacion')" class="w-full">

                <textarea class="bg-white rounded text-xs w-full " rows="4" wire:model="observacion" placeholder="Se lo más especifico sobre la revisión"></textarea>

            </x-input-group>

        </x-slot>

        <x-slot name="footer">

            <div class="flex gap-3">

                <x-button-blue
                    wire:click="revisar"
                    wire:loading.attr="disabled"
                    wire:target="revisar">

                    <img wire:loading wire:target="revisar" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                    <span>Generar revisión</span>
                </x-button-blue>

                <x-button-red
                    wire:click="$toggle('modal_revision')"
                    wire:loading.attr="disabled"
                    wire:target="$toggle('modal_revision')"
                    type="button">
                    Cerrar
                </x-button-red>

            </div>

        </x-slot>

    </x-dialog-modal>

    @push('scripts')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @endpush

</div>