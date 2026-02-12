<x-form-section submit="guardar">
    <x-slot name="title">
        Actualiza tu documentación
    </x-slot>

    <x-slot name="description">
        Actualiza los documentos necesarios y el trámite de refrendo
    </x-slot>

    <x-slot name="form">

        <div class="border border-gray-300 rounded-lg p-3 w-full col-span-6">

            <div class="flex justify-between items-center">

                <div>

                    <input type="file" id="acta_nacimiento" class="hidden" wire:model.live="acta_nacimiento" x-ref="acta_nacimiento" accept="application/pdf"/>

                    <x-label for="acta_nacimiento" value="Acta de nacimento" />

                    <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.acta_nacimiento.click()">Seleccione el archivo</x-secondary-button>

                </div>

                <div>

                    @if(auth()->user()->actaNacimiento)

                        <a href="{{ auth()->user()->actaNacimiento->getLink() }}" target="_blank">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                            </svg>

                        </a>

                    @elseif($acta_nacimiento)

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                        </svg>

                    @else

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>


                    @endif

                </div>

            </div>

            <div>

                @error('acta_nacimiento') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

        <div class="border border-gray-300 rounded-lg p-3 w-full col-span-6">

            <div class="flex justify-between items-center">

                <div>

                    <input type="file" id="comprobante_recidencia" class="hidden" wire:model.live="comprobante_recidencia" x-ref="comprobante_recidencia" accept="application/pdf"/>

                    <x-label for="comprobante_recidencia" value="Comprobante de recidencia" />

                    <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.comprobante_recidencia.click()">Seleccione el archivo</x-secondary-button>

                </div>

                <div>

                    @if(auth()->user()->comprobanteRecidencia)

                        <a href="{{ auth()->user()->actaNacimiento->getLink() }}" target="_blank">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                            </svg>

                        </a>

                    @elseif($comprobante_recidencia)

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                        </svg>

                    @else

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>


                    @endif

                </div>

            </div>

            <div>

                @error('comprobante_recidencia') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

        <div class="border border-gray-300 rounded-lg p-3 w-full col-span-6">

            <div class="flex justify-between items-center">

                <div>

                    <input type="file" id="curriculum" class="hidden" wire:model.live="curriculum" x-ref="curriculum" accept="application/pdf"/>

                    <x-label for="curriculum" value="Currículum vitae" />

                    <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.curriculum.click()">Seleccione el archivo</x-secondary-button>

                </div>

                <div>

                    @if(auth()->user()->curriculum)

                        <a href="{{ auth()->user()->actaNacimiento->getLink() }}" target="_blank">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                            </svg>

                        </a>

                    @elseif($curriculum)

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                        </svg>

                    @else

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>


                    @endif

                </div>

            </div>

            <div>

                @error('curriculum') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

        <div class="border border-gray-300 rounded-lg p-3 w-full col-span-6">

            <div class="flex justify-between items-center">

                <div>

                    <input type="file" id="cedula_especialidad" class="hidden" wire:model.live="cedula_especialidad" x-ref="cedula_especialidad" accept="application/pdf"/>

                    <x-label for="cedula_especialidad" value="Cédula de especialidad" />

                    <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.cedula_especialidad.click()">Seleccione el archivo</x-secondary-button>

                </div>

                <div>

                    @if(auth()->user()->cedulaEspecialidad)

                        <a href="{{ auth()->user()->cedulaEspecialidad->getLink() }}" target="_blank">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                            </svg>

                        </a>

                    @elseif($cedula_especialidad)

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                        </svg>

                    @else

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>


                    @endif

                </div>

            </div>

            <div>

                @error('cedula_especialidad') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

        <div class="border border-gray-300 rounded-lg p-3 w-full col-span-6">

            <div class="flex justify-between items-center">

                <div>

                    <input type="file" id="fianza" class="hidden" wire:model.live="fianza" x-ref="fianza" accept="application/pdf"/>

                    <x-label for="fianza" value="Fianza" />

                    <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.fianza.click()">Seleccione el archivo</x-secondary-button>

                </div>

                <div>

                    @if(auth()->user()->fianza)

                        <a href="{{ auth()->user()->fianza->getLink() }}" target="_blank">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                            </svg>

                        </a>

                    @elseif($fianza)

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                        </svg>

                    @else

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>


                    @endif

                </div>

            </div>

            <div>

                @error('fianza') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

        <div class="border border-gray-300 rounded-lg p-3 w-full col-span-6">

            <div class="flex justify-between items-center">

                <div>

                    <input type="file" id="pago_credencial" class="hidden" wire:model.live="pago_credencial" x-ref="pago_credencial" accept="application/pdf"/>

                    <x-label for="pago_credencial" value="Pago de renovación de credencial" />

                    <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.pago_credencial.click()">Seleccione el archivo</x-secondary-button>

                </div>

                <div>

                    @if(auth()->user()->pagoCredencial)

                        <a href="{{ auth()->user()->pagoCredencial->getLink() }}" target="_blank">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                            </svg>

                        </a>

                    @elseif($pago_credencial)

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                        </svg>

                    @else

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>


                    @endif

                </div>

            </div>

            <div>

                @error('pago_credencial') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

        <div class="border border-gray-300 rounded-lg p-3 w-full col-span-6">

            <div class="flex justify-between items-center">

                <div>

                    <input type="file" id="registro_asociacion" class="hidden" wire:model.live="registro_asociacion" x-ref="registro_asociacion" accept="application/pdf"/>

                    <x-label for="registro_asociacion" value="Registro de asociación" />

                    <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.registro_asociacion.click()">Seleccione el archivo</x-secondary-button>

                </div>

                <div>

                    @if(auth()->user()->registroAsociacion)

                        <a href="{{ auth()->user()->registroAsociacion->getLink() }}" target="_blank">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                            </svg>

                        </a>

                    @elseif($registro_asociacion)

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                        </svg>

                    @else

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>


                    @endif

                </div>

            </div>

            <div>

                @error('registro_asociacion') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

        <div class="border border-gray-300 rounded-lg p-3 w-full col-span-6">

            <div class="flex justify-between items-center">

                <div>

                    <input type="file" id="foto" class="hidden" wire:model.live="foto" x-ref="foto" accept="image"/>

                    <div class="flex items-center gap-3">

                        <x-label for="foto" value="Foto infantil" />

                        <a href="{{ asset('storage/img/foto.png') }}" target="_blank">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>

                        </a>

                    </div>

                    <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.foto.click()">Seleccione el archivo</x-secondary-button>

                </div>

                <div>

                    @if(in_array($foto?->getClientOriginalExtension(), ['png', 'jpg', 'jpeg', 'gif']))

                        <a href="{{ $foto->temporaryUrl() }}" target="_blank">

                            <img class="h-10 w-10 mx-auto my-3" src="{{ $foto->temporaryUrl() ?? asset('storage/img/ico.png') }}" alt="Foto 3">

                        </a>

                    @else

                        <a href="{{ auth()->user()->foto?->getLink() ?? asset('storage/img/ico.png') }}" target="_blank">

                            <img class="h-10 w-10 mx-auto my-3" src="{{ auth()->user()->foto?->getLink() ?? asset('storage/img/ico.png') }}" alt="Foto 3">

                        </a>

                    @endif

                </div>

            </div>

            <small>Foto tamaño infantil con fondo blanco.</small>

            <div>

                @error('foto') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

    </x-slot>

    <x-slot name="actions">

        @if(auth()->user()->status === 'revision')

            <x-action-message class="me-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>

            <x-button wire:loading.attr="disabled" >
                {{ __('Save') }}
            </x-button>

        @endif

    </x-slot>

</x-form-section>
