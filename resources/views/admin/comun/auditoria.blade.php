<x-h4>Auditoria ({{ $predio->audits->count()}})</x-h4>

<div class="bg-white p-4 rounded-lg w-full shadow-lg mb-5 overflow-x-auto">

    <table class="table-auto lg:table-fixed w-full">

        <thead class="border-b border-gray-300 ">

            <tr class="text-sm text-gray-500 text-left traling-wider whitespace-nowrap">

                <th class="px-2">Usuario</th>
                <th class="px-2">Movimiento</th>
                <th class="px-2">Trámite</th>
                <th class="px-2">Fecha</th>

            </tr>

        </thead>

        <tbody class="divide-y divide-gray-200">

            @foreach ($predio->audits as $audit)

                <tr class="text-gray-500 text-sm leading-relaxed">
                    <td class=" px-2 w-full">{{ $audit->user->name }}</td>
                    <td class=" px-2 w-full">{{ Str::ucfirst($audit->event) }}: {{ $audit->tags }}</td>
                    <td class=" px-2 w-full">{{ $audit->tramite ? $audit->tramite->numeroControl() : 'N/A' }}</td>
                    <td class=" px-2 w-full">{{ $audit->created_at }}</td>
                </tr>

            @endforeach

        </tbody>

    </table>

</div>