<x-h4>Caracteristicas</x-h4>

<div class="bg-white p-4 rounded-lg w-full shadow-lg mb-5 text-gray-600">

    <div class="flex gap-3 text-sm mb-5">

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Clasificación de la zona</strong>

            <p>{{ $avaluo->clasificacion_zona }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Tipo de construcción dominante</strong>

            <p>{{ $avaluo->construccion_dominante }}</p>

        </div>

    </div>

    <div class="flex gap-3 text-sm mb-5">

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <p><strong>Agua</strong> {{ $avaluo->agua ? 'Si' : 'No' }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <p><strong>Drenaje</strong> {{ $avaluo->drenaje ? 'Si' : 'No' }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <p><strong>Pavimento</strong> {{ $avaluo->pavimento ? 'Si' : 'No' }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <p><strong>Energia eléctrica</strong> {{ $avaluo->energia_electrica ? 'Si' : 'No' }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <p><strong>Alumbrado público</strong> {{ $avaluo->alumbrado_publico ? 'Si' : 'No' }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <p><strong>Banqueta</strong> {{ $avaluo->banqueta ? 'Si' : 'No' }}</p>

        </div>

    </div>

    @foreach ($avaluo->bloques as $bloque)

        <div class="rounded-lg bg-gray-100 py-1 px-2 text-center mb-5">

            <strong>Bloque {{ $loop->iteration }}</strong>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 text-sm mb-5">

            <div class="rounded-lg bg-gray-100 py-1 px-2 col-span-1 sm:col-span-2 lg:col-span-5">

                <strong>Uso</strong>

                <p>{{ $bloque->uso }}</p>

            </div>

            <div class="rounded-lg bg-gray-100 py-1 px-2">

                <strong>Cimentación</strong>

                <p>{{ $bloque->cimentacion }}</p>

            </div>

            <div class="rounded-lg bg-gray-100 py-1 px-2">

                <strong>Estructura</strong>

                <p>{{ $bloque->estructura }}</p>

            </div>

            <div class="rounded-lg bg-gray-100 py-1 px-2">

                <strong>Muros</strong>

                <p>{{ $bloque->muros }}</p>

            </div>

            <div class="rounded-lg bg-gray-100 py-1 px-2">

                <strong>Entrepisos</strong>

                <p>{{ $bloque->entrepiso }}</p>

            </div>

            <div class="rounded-lg bg-gray-100 py-1 px-2">

                <strong>Techo</strong>

                <p>{{ $bloque->techo }}</p>

            </div>

            <div class="rounded-lg bg-gray-100 py-1 px-2">

                <strong>Plafones</strong>

                <p>{{ $bloque->plafones }}</p>

            </div>

            <div class="rounded-lg bg-gray-100 py-1 px-2">

                <strong>Vidriería</strong>

                <p>{{ $bloque->vidrieria }}</p>

            </div>

            <div class="rounded-lg bg-gray-100 py-1 px-2">

                <strong>Lambrines</strong>

                <p>{{ $bloque->lambrines }}</p>

            </div>

            <div class="rounded-lg bg-gray-100 py-1 px-2">

                <strong>Pisos</strong>

                <p>{{ $bloque->pisos }}</p>

            </div>

            <div class="rounded-lg bg-gray-100 py-1 px-2">

                <strong>Herreria</strong>

                <p>{{ $bloque->herreria }}</p>

            </div>

            <div class="rounded-lg bg-gray-100 py-1 px-2">

                <strong>Pintura</strong>

                <p>{{ $bloque->pintura }}</p>

            </div>

            <div class="rounded-lg bg-gray-100 py-1 px-2">

                <strong>Carpinteria</strong>

                <p>{{ $bloque->carpinteria }}</p>

            </div>

            <div class="rounded-lg bg-gray-100 py-1 px-2">

                <strong>Recubrimiento especial</strong>

                <p>{{ $bloque->recubrimiento_especial }}</p>

            </div>

            <div class="rounded-lg bg-gray-100 py-1 px-2">

                <strong>Aplanados</strong>

                <p>{{ $bloque->aplanados }}</p>

            </div>

            <div class="rounded-lg bg-gray-100 py-1 px-2">

                <strong>Hidraulica</strong>

                <p>{{ $bloque->hidraulica }}</p>

            </div>

            <div class="rounded-lg bg-gray-100 py-1 px-2">

                <strong>Sanitaria</strong>

                <p>{{ $bloque->sanitaria }}</p>

            </div>

            <div class="rounded-lg bg-gray-100 py-1 px-2">

                <strong>Eléctrica</strong>

                <p>{{ $bloque->electrica }}</p>

            </div>

            <div class="rounded-lg bg-gray-100 py-1 px-2">

                <strong>Gas</strong>

                <p>{{ $bloque->gas }}</p>

            </div>

            <div class="rounded-lg bg-gray-100 py-1 px-2">

                <strong>Especiales</strong>

                <p>{{ $bloque->especiales }}</p>

            </div>

            <div class="rounded-lg bg-gray-100 py-1 px-2 col-span-1 sm:col-span-2 lg:col-span-5">

                <strong>Observaciones</strong>

                <p>{{ $bloque->observaciones }}</p>

            </div>

        </div>

    @endforeach

</div>