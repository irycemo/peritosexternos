<div x-data="{openRoles:true, openDistritos:true}">

    <p class="uppercase text-md text-rojo mb-4 tracking-wider">Consultas</p>

    @can('Preguntas')

        <div class="flex items-center w-full justify-between hover:text-red-600 transition ease-in-out duration-500 hover:bg-gray-100 rounded-xl">

            <a href="{{ route('preguntas_frecuentes') }}" class="capitalize font-medium text-sm flex items-center w-full py-2 px-4 focus:outline-rojo focus:outline-offset-2 rounded-lg">

                Preguntas frecuentes

            </a>

        </div>

    @endcan

</div>
