<div>

    <div class="mb-2 flex justify-end">

        <x-button-blue wire:click="abrirModal">Agregar propietario</x-button-blue>

    </div>

    <x-dialog-modal wire:model="modal">

        <x-slot name="title">Nuevo propietario</x-slot>

        <x-slot name="content">

            @if($flag_agregar)

                @include('livewire.valuacion.comun.modal-content-form')

            @else

                @include('livewire.valuacion.comun.modal-content-search')

                @include('livewire.valuacion.comun.modal-content-table')

            @endif

        </x-slot>

        <x-slot name="footer">

            @include('livewire.valuacion.comun.modal-footer')

        </x-slot>

    </x-dialog-modal>

</div>
