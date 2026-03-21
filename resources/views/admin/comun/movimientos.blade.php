<x-h4>Movimientos ({{ $predio->movimientos->count() }})</x-h4>

<div class="bg-white p-4 rounded-lg w-full shadow-lg mb-5 overflow-x-auto">

    <table class="table-auto lg:table-fixed w-full">

        <thead class="border-b border-gray-300 ">

            <tr class="text-sm text-gray-500 text-left traling-wider whitespace-nowrap">

                <th class="px-2">Movimiento</th>
                <th class="px-2">Fecha</th>
                <th class="px-2">Descripción</th>
                <th class="px-2">Registrado por</th>

            </tr>

        </thead>

        <tbody class="divide-y divide-gray-200">

            @foreach ($predio->movimientos as $movimiento)

                <tr class="text-gray-500 text-sm leading-relaxed">
                    <td class=" px-2 w-full ">{{ $movimiento->nombre }}</td>
                    <td class=" px-2 w-full ">{{ $movimiento->fecha->format('d-m-Y') }}</td>
                    <td class=" px-2 w-full ">{{ $movimiento->descripcion }}</td>
                    @if(isset($movimiento->actualizado_nombre))

                        <td class=" px-2 w-full ">{{ $movimiento->actualizado_nombre }}</td>

                    @else

                        <td class=" px-2 w-full ">{{ $movimiento->creadoPor?->name }}</td>

                    @endif
                </tr>

            @endforeach

        </tbody>

    </table>

</div>