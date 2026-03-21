<x-h4>Ubicación del predio</x-h4>

<div class="bg-white p-4 rounded-lg w-full shadow-lg mb-5 text-gray-600">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 text-sm">

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Tipo de asentamiento</strong>

            <p>{{ $predio->tipo_asentamiento }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Nombre del asentamiento</strong>

            <p>{{ $predio->nombre_asentamiento }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Tipo de vialidad</strong>

            <p>{{ $predio->tipo_vialidad }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Nombre de la vialidad</strong>

            <p>{{ $predio->nombre_vialidad }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Número exterior</strong>

            <p>{{ $predio->numero_exterior }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Número exterior 2</strong>

            <p>{{ $predio->numero_exterior_2 }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Número interior</strong>

            <p>{{ $predio->numero_interior }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Número adicional</strong>

            <p>{{ $predio->numero_adicional }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Número adicional 2</strong>

            <p>{{ $predio->numero_adicional_2 }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Código postal</strong>

            <p>{{ $predio->codigo_postal }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Lote del fraccionador</strong>

            <p>{{ $predio->lote_fraccionador }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Manzana del fraccionador</strong>

            <p>{{ $predio->manzana_fraccionador }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Etapa o zona del fraccionador</strong>

            <p>{{ $predio->etapa_fraccionador }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Nombre del Edificio</strong>

            <p>{{ $predio->nombre_edificio }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Clave del edificio</strong>

            <p>{{ $predio->clave_edificio }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Departamento</strong>

            <p>{{ $predio->departamento_edificio }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Predio Rústico Denominado ó Antecedente</strong>

            <p>{{ $predio->nombre_predio }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Ubicación en manzana</strong>

            <p>{{ $predio->ubicacion_en_manzana }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Coordenadas geográficas UTM</strong>

            <p>X: {{ $predio->xutm }}</p>
            <p>Y: {{ $predio->yutm }}</p>
            <p>Z: {{ $predio->zutm }}</p>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Coordenadas geográficas GEO</strong>

            <p>Lat: {{ $predio->lat }}</p>
            <p>Lon: {{ $predio->lon }}</p>
            <div class="flex items-center gap-2">

                <a href="{{ 'http://mapa.catastro.michoacan.gob.mx:8080/index.html?pzoom=20&plat=' . $predio->lat . '&plon=' . $predio->lon }}" title="SIG" target="_blank">
                    <img class="h-6 cursor-pointer" src="{{ asset('storage/img/ico.png') }}" alt="SIG">
                </a>

                <a href="{{ 'https://www.google.com/maps/?q=' . $predio->lat . ',' . $predio->lon . '&z=5&t=k' }}" title="Google" target="_blank">

                    <img class="h-6 cursor-pointer" src="{{ asset('storage/img/ico.png') }}" alt="Google">

                </a>

            </div>

        </div>

    </div>

</div>