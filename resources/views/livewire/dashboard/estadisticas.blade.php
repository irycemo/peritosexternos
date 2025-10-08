<div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

        <div class="flex md:block justify-evenly items-center space-x-2 border-t-4 border-blue-400 p-4 shadow-xl text-gray-600 rounded-xl bg-white text-center">

            <div class="  mb-2 items-center">

                <span class="font-semibold text-2xl text-blueGray-600 mb-2">

                    <p>{{ $avaluos_nuevos }}</p>

                </span>

                <h5 class="text-blueGray-400 uppercase  text-center  tracking-widest md:tracking-normal">Nuevos</h5>

            </div>

            <a href="{{ route('mis_avaluos') . "?estado=nuevo" }}" class="mx-auto rounded-full border border-blue-600 py-1 px-4 text-blue-500 hover:bg-blue-600 hover:text-white transition-all ease-in-out"> Ver avalúos</a>

        </div>

        <div class="flex md:block justify-evenly items-center space-x-2 border-t-4 border-green-400 p-4 shadow-xl text-gray-600 rounded-xl bg-white text-center">

            <div class="  mb-2 items-center">

                <span class="font-semibold text-2xl text-blueGray-600 mb-2">

                    <p>{{ $avaluos_concluidos }}</p>

                </span>

                <h5 class="text-blueGray-400 uppercase  text-center  tracking-widest md:tracking-normal">Concluidos</h5>

            </div>

            <a href="{{ route('mis_avaluos') . "?estado=concluido" }}" class="mx-auto rounded-full border border-green-600 py-1 px-4 text-green-500 hover:bg-green-600 hover:text-white transition-all ease-in-out"> Ver avalúos</a>

        </div>

        <div class="flex md:block justify-evenly items-center space-x-2 border-t-4 border-indigo-400 p-4 shadow-xl text-gray-600 rounded-xl bg-white text-center">

            <div class="  mb-2 items-center">

                <span class="font-semibold text-2xl text-blueGray-600 mb-2">

                    <p>{{ $avaluos_operados }}</p>

                </span>

                <h5 class="text-blueGray-400 uppercase  text-center  tracking-widest md:tracking-normal">Operados</h5>

            </div>

            <a href="{{ route('mis_avaluos') . "?estado=operado" }}" class="mx-auto rounded-full border border-indigo-600 py-1 px-4 text-indigo-500 hover:bg-indigo-600 hover:text-white transition-all ease-in-out"> Ver avalúos</a>

        </div>

        <div class="flex md:block justify-evenly items-center space-x-2 border-t-4 border-yellow-400 p-4 shadow-xl text-gray-600 rounded-xl bg-white text-center">

            <div class="  mb-2 items-center">

                <span class="font-semibold text-2xl text-blueGray-600 mb-2">

                    <p>{{ $avaluos_por_conciliar }}</p>

                </span>

                <h5 class="text-blueGray-400 uppercase  text-center  tracking-widest md:tracking-normal">Conciliación</h5>

            </div>

            <a href="{{ route('mis_avaluos') . "?estado=conciliar" }}" class="mx-auto rounded-full border border-yellow-600 py-1 px-4 text-yellow-500 hover:bg-yellow-600 hover:text-white transition-all ease-in-out"> Ver avalúos</a>

        </div>

    </div>

</div>
