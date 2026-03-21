<x-h4>Datos generales del predio</x-h4>

<div class="bg-white p-4 rounded-lg w-full shadow-lg mb-5 text-sm text-gray-600">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Cuenta predial</strong>

            <p>{{ $predio->localidad }}-{{ $predio->oficina }}-{{ $predio->tipo_predio }}-{{ $predio->numero_registro }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Clave catastral</strong>

            <p>{{ $predio->estado }}-{{ $predio->region_catastral }}-{{ $predio->municipio }}-{{ $predio->zona_catastral }}-{{ $predio->localidad }}-{{ $predio->sector }}-{{ $predio->manzana }}-{{ $predio->predio }}-{{ $predio->edificio }}-{{ $predio->departamento }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Fecha de notificación</strong>

            <p>{{ $predio->fecha_notificacion ?? 'N/A' }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Fecha de efectos</strong>

            <p>{{ $predio->fecha_efectos ?? 'N/A' }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Superficie notarial</strong>

            <p>{{ number_format($predio->superficie_notarial, 2) }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Superficie judicial</strong>

            <p>{{ number_format($predio->superficie_judicial, 2) }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Superficie de terreno</strong>

            <p>{{ number_format($predio->superficie_terreno, 2) }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Superficie total de construcción</strong>

            <p>{{ number_format($predio->superficie_total_construccion, 2) }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Valor total de terreno</strong>

            <p>${{ number_format($predio->valor_total_terreno, 2) }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Valor total de construcción</strong>

            <p>${{ number_format($predio->valor_total_construccion, 2) }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Valor catastral</strong>

            <p>${{ number_format($predio->valor_catastral, 2) }}</p>

        </div>

    </div>

</div>