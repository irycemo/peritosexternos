<x-h4>Datos generales</x-h4>

<div class="bg-white p-4 rounded-lg w-full shadow-lg mb-5 text-sm text-gray-600">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Folio</strong>

            <p>{{ $avaluo->año }}-{{ $avaluo->folio }}-{{ $avaluo->usuario }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Estado</strong>

            <p class="capitalize">{{ $avaluo->estado }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Registro</strong>

            <p>Registrado por: {{ $avaluo->creadoPor->name }}</p>
            <p>Registrado en: {{ $avaluo->created_at }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2 col-span-1 sm:col-span-2 lg:col-span-4">

            <strong>Observaciones</strong>

            <p>{{ $avaluo->observaciones }}</p>

        </div>

    </div>

</div>