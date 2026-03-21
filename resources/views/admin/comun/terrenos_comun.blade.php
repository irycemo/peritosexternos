<x-h4>Terrenos de área común ({{ $predio->terrenosCOmun->count() }})</x-h4>

<div class="bg-white p-4 rounded-lg w-full shadow-lg mb-5 overflow-x-auto">

    <table class="table-auto lg:table-fixed w-full">

        <thead class="border-b border-gray-300 ">

            <tr class="text-sm text-gray-500 text-left traling-wider whitespace-nowrap">

                <th class="px-2">Área común de terreno</th>
                <th class="px-2">Indiviso de terreno</th>
                <th class="px-2">Superficie proporcional</th>
                <th class="px-2">Valor unitario</th>
                <th class="px-2">Valor de terreno común</th>

            </tr>

        </thead>

        <tbody class="divide-y divide-gray-200">

            @foreach ($predio->terrenosComun as $terreno)

                <tr class="text-gray-500 text-sm leading-relaxed">
                    <td class=" px-2 w-full whitespace-nowrap">{{ $terreno->area_terreno_comun }}</td>
                    <td class=" px-2 w-full whitespace-nowrap">{{ $terreno->indiviso_terreno }}</td>
                    <td class=" px-2 w-full whitespace-nowrap">{{ $terreno->superficie_proporcional }}</td>
                    <td class=" px-2 w-full whitespace-nowrap">{{ $terreno->valor_unitario }}</td>
                    <td class=" px-2 w-full whitespace-nowrap">${{ number_format($terreno->valor_terreno_comun, 2) }}</td>
                </tr>

            @endforeach

        </tbody>

    </table>

</div>