<x-h4>Construcciones de área común ({{ $predio->construccionesComun->count() }})</x-h4>

<div class="bg-white p-4 rounded-lg w-full shadow-lg mb-5 overflow-x-auto">

    <table class="table-auto lg:table-fixed w-full">

        <thead class="border-b border-gray-300 ">

            <tr class="text-sm text-gray-500 text-left traling-wider whitespace-nowrap">

                <th class="px-2">Área común de construcción</th>
                <th class="px-2">Indiviso de construcción</th>
                <th class="px-2">Superficie proporcional</th>
                <th class="px-2">Clasificación de construccion</th>
                <th class="px-2">Valor de construcción común</th>

            </tr>

        </thead>

        <tbody class="divide-y divide-gray-200">

            @foreach ($predio->construccionesComun as $construccion)

                <tr class="text-gray-500 text-sm leading-relaxed">
                    <td class=" px-2 w-full whitespace-nowrap">{{ $construccion->area_comun_construccion }}</td>
                    <td class=" px-2 w-full whitespace-nowrap">{{ $construccion->indiviso_construccion }}</td>
                    <td class=" px-2 w-full whitespace-nowrap">{{ $construccion->superficie_proporcional }}</td>
                    <td class=" px-2 w-full whitespace-nowrap">{{ $construccion->valor_clasificacion_construccion }}</td>
                    <td class=" px-2 w-full whitespace-nowrap">${{ number_format($construccion->valor_construccion_comun, 2) }}</td>
                </tr>

            @endforeach

        </tbody>

    </table>

</div>