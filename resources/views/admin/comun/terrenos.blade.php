<x-h4>Terrenos ({{ $predio->terrenos->count() }})</x-h4>

<div class="bg-white p-4 rounded-lg w-full shadow-lg mb-5 overflow-x-auto">

    <table class="table-auto lg:table-fixed w-full">

        <thead class="border-b border-gray-300 ">

            <tr class="text-sm text-gray-500 text-left traling-wider whitespace-nowrap">

                <th class="px-2">Superficie</th>
                <th class="px-2">Valor unitario</th>
                <th class="px-2">Demerito</th>
                <th class="px-2">Valor demeritado</th>
                <th class="px-2">Valor del terreno</th>

            </tr>

        </thead>

        <tbody class="divide-y divide-gray-200">

            @foreach ($predio->terrenos as $terreno)

                <tr class="text-gray-500 text-sm leading-relaxed">
                    <td class=" px-2 w-full whitespace-nowrap">{{ $terreno->superficie }}</td>
                    <td class=" px-2 w-full whitespace-nowrap">{{ $terreno->valor_unitario }}</td>
                    <td class=" px-2 w-full whitespace-nowrap">{{ $terreno->demerito }}</td>
                    <td class=" px-2 w-full whitespace-nowrap">{{ $terreno->demerito }}</td>
                    <td class=" px-2 w-full whitespace-nowrap">${{ number_format($terreno->valor_terreno, 2) }}</td>
                </tr>

            @endforeach

        </tbody>

    </table>

</div>
