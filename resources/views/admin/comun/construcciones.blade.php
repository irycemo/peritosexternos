<x-h4>Construcciones ({{ $predio->construcciones->count() }})</x-h4>

<div class="bg-white p-4 rounded-lg w-full shadow-lg mb-5 overflow-x-auto">

    <table class="table-auto lg:table-fixed w-full">

        <thead class="border-b border-gray-300 ">

            <tr class="text-sm text-gray-500 text-left traling-wider whitespace-nowrap">

                <th class="px-2">Referencia</th>
                <th class="px-2">Clasificación de construcción</th>
                <th class="px-2">Niveles</th>
                <th class="px-2">Superficie</th>
                <th class="px-2">Valor unitario</th>
                <th class="px-2">Valor de construcción</th>

            </tr>

        </thead>

        <tbody class="divide-y divide-gray-200">

            @foreach ($predio->construcciones as $construccion)

                <tr class="text-gray-500 text-sm leading-relaxed">
                    <td class=" px-2 w-full whitespace-nowrap">{{ $construccion->referencia }}</td>
                    <td class=" px-2 w-full whitespace-nowrap">{{ $construccion->tipo }}-{{ $construccion->uso }}-{{ $construccion->calidad }}-{{ $construccion->estado }}</td>
                    <td class=" px-2 w-full whitespace-nowrap">{{ $construccion->niveles }}</td>
                    <td class=" px-2 w-full whitespace-nowrap">{{ $construccion->superficie }}</td>
                    <td class=" px-2 w-full whitespace-nowrap">{{ $construccion->valor_unitario }}</td>
                    <td class=" px-2 w-full whitespace-nowrap">${{ number_format($construccion->valor_construccion, 2) }}</td>
                </tr>

            @endforeach

        </tbody>

    </table>

</div>