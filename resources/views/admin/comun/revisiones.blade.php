<x-h4>Revisiones ({{ $predio->avaluo->revisiones->count() }})</x-h4>

<div class="bg-white p-4 rounded-lg w-full shadow-lg mb-5  overflow-x-auto table-fixed text-sm">

    <table class="table-auto lg:table-fixed w-full">

        <thead class="border-b border-gray-300 ">

            <tr class="text-sm text-gray-500 text-left traling-wider whitespace-nowrap">

                <th class="px-2">Observación</th>
                <th class="px-2">Fecha</th>
                <th class="px-2">Registrado por</th>

            </tr>

        </thead>

        <tbody class="divide-y divide-gray-200">

            @foreach ($predio->avaluo->revisiones as $revision)

                <tr class="text-gray-500 text-sm leading-relaxed">
                    <td class=" px-2 w-full ">{{ $revision->observaciones }}</td>
                    <td class=" px-2 w-full ">{{ $revision->created_at }}</td>
                    <td class=" px-2 w-full ">{{ $revision->creadoPor->name }}</td>
                </tr>

            @endforeach

        </tbody>

    </table>

</div>