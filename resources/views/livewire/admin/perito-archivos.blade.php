<x-form-section submit="guardar">
    <x-slot name="title">
        Actualiza tu documentación
    </x-slot>

    <x-slot name="description">
        Actualiza los documentos necesarios y el trámite de refrendo
    </x-slot>

    <x-slot name="form">

        <div class="mb-3  border border-gray-300 rounded-lg p-3 w-full col-span-6">

            <div class="flex justify-between items-center">

                <div>

                    <input type="file" id="ine_frente" class="hidden" wire:model.live="ine_frente" x-ref="ine_frente" accept="image/png, image/jpeg, image/jpg"/>

                    <x-label for="ine_frente" value="INE Frente" />

                    <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.ine_frente.click()">Seleccione el archivo</x-secondary-button>

                </div>

                <div>

                    @if(in_array($ine_frente?->getClientOriginalExtension(), ['png', 'jpg', 'jpeg', 'gif']))

                        <a href="{{ $ine_frente->temporaryUrl() }}" target="_blank">

                            <img class="h-10 w-10 mx-auto my-3" src="{{ $ine_frente->temporaryUrl() ?? asset('storage/img/ico.png') }}" alt="Foto 3">

                        </a>

                    @else

                        <a href="{{ auth()->user()->ineFrente?->getLink() ?? asset('storage/img/ico.png') }}" target="_blank">

                            <img class="h-10 w-10 mx-auto my-3" src="{{ auth()->user()->ineFrente?->getLink() ?? asset('storage/img/ico.png') }}" alt="Foto 3">

                        </a>

                    @endif

                </div>

            </div>

            <div>

                @error('ine_frente') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

        <div class="mb-3  border border-gray-300 rounded-lg p-3 w-full col-span-6">

            <div class="flex justify-between items-center">

                <div>

                    <input type="file" id="ine_reverso" class="hidden" wire:model.live="ine_reverso" x-ref="ine_reverso" accept="image/png, image/jpeg, image/jpg"/>

                    <x-label for="ine_reverso" value="INE Reverso" />

                    <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.ine_reverso.click()">Seleccione el archivo</x-secondary-button>

                </div>

                <div>

                    @if(in_array($ine_reverso?->getClientOriginalExtension(), ['png', 'jpg', 'jpeg', 'gif']))

                        <a href="{{ $ine_reverso->temporaryUrl() }}" target="_blank">

                            <img class="h-10 w-10 mx-auto my-3" src="{{ $ine_reverso->temporaryUrl() ?? asset('storage/img/ico.png') }}" alt="Foto 3">

                        </a>

                    @else

                        <a href="{{ auth()->user()->ineReverso?->getLink() ?? asset('storage/img/ico.png') }}" target="_blank">

                            <img class="h-10 w-10 mx-auto my-3" src="{{ auth()->user()->ineReverso?->getLink() ?? asset('storage/img/ico.png') }}" alt="Foto 3">

                        </a>

                    @endif

                </div>

            </div>

            <div>

                @error('ine_reverso') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

        <div class="mb-3  border border-gray-300 rounded-lg p-3 w-full col-span-6">

            <div class="flex justify-between items-center">

                <div>

                    <input type="file" id="cedula_profesional" class="hidden" wire:model.live="cedula_profesional" x-ref="cedula_profesional" accept="image/png, image/jpeg, image/jpg"/>

                    <x-label for="cedula_profesional" value="Cédula profesional" />

                    <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.cedula_profesional.click()">Seleccione el archivo</x-secondary-button>

                </div>

                <div>

                    @if(in_array($cedula_profesional?->getClientOriginalExtension(), ['png', 'jpg', 'jpeg', 'gif']))

                        <a href="{{ $cedula_profesional->temporaryUrl() }}" target="_blank">

                            <img class="h-10 w-10 mx-auto my-3" src="{{ $cedula_profesional->temporaryUrl() ?? asset('storage/img/ico.png') }}" alt="Foto 3">

                        </a>

                    @else

                        <a href="{{ auth()->user()->cedulaProfesional?->getLink() ?? asset('storage/img/ico.png') }}" target="_blank">

                            <img class="h-10 w-10 mx-auto my-3" src="{{ auth()->user()->cedulaProfesional?->getLink() ?? asset('storage/img/ico.png') }}" alt="Foto 3">

                        </a>

                    @endif

                </div>

            </div>

            <div>

                @error('cedula_profesional') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

        <div class="mb-3  border border-gray-300 rounded-lg p-3 w-full col-span-6">

            <div class="flex justify-between items-center">

                <div>

                    <input type="file" id="cedula_especialidad" class="hidden" wire:model.live="cedula_especialidad" x-ref="cedula_especialidad" accept="image/png, image/jpeg, image/jpg"/>

                    <x-label for="cedula_especialidad" value="Cédula de especialidad" />

                    <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.cedula_especialidad.click()">Seleccione el archivo</x-secondary-button>

                </div>

                <div>

                    @if(in_array($cedula_especialidad?->getClientOriginalExtension(), ['png', 'jpg', 'jpeg', 'gif']))

                        <a href="{{ $cedula_especialidad->temporaryUrl() }}" target="_blank">

                            <img class="h-10 w-10 mx-auto my-3" src="{{ $cedula_especialidad->temporaryUrl() ?? asset('storage/img/ico.png') }}" alt="Foto 3">

                        </a>

                    @else

                        <a href="{{ auth()->user()->cedulaEspecialidad?->getLink() ?? asset('storage/img/ico.png') }}" target="_blank">

                            <img class="h-10 w-10 mx-auto my-3" src="{{ auth()->user()->cedulaEspecialidad?->getLink() ?? asset('storage/img/ico.png') }}" alt="Foto 3">

                        </a>

                    @endif

                </div>

            </div>

            <div>

                @error('cedula_especialidad') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" >
            {{ __('Save') }}
        </x-button>
    </x-slot>

</x-form-section>
