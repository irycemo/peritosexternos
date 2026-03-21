<x-h4>Colindancias ({{ $predio->colindancias->count() }})</x-h4>

<div class="bg-white p-4 rounded-lg w-full shadow-lg mb-5 overflow-x-auto">

    <table class="table-auto lg:table-fixed w-full">

        <thead class="border-b border-gray-300 ">

            <tr class="text-sm text-gray-500 text-left traling-wider">

                <th class="px-2">Viento</th>
                <th class="px-2">Longitud(mts.)</th>
                <th class="px-2">Descripción</th>

            </tr>

        </thead>

        <tbody class="divide-y divide-gray-200">

            @foreach ($predio->colindancias as $colindancia)

                <tr class="text-gray-500 text-sm leading-relaxed">
                    <td class=" px-2 w-full">{{ $colindancia->viento }}</td>
                    <td class=" px-2 w-full">{{ $colindancia->longitud }}</td>
                    <td class=" px-2 w-full">{{ $colindancia->descripcion }}</td>
                </tr>

            @endforeach

        </tbody>

    </table>

</div>