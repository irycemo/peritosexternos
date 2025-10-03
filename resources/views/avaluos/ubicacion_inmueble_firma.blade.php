<p class="separador">UBICACIÓN DEL INMUEBLE</p>

<p class="parrafo">

    <strong>Cuenta predial:</strong> {{ $avaluo->predio->cuenta_predial }};

    <strong>Clave catastral:</strong> {{ $avaluo->predio->clave_catastral }};

    @if ($avaluo->predio->codigo_postal)
        <strong>CÓDIGO POSTAL:</strong> {{ $avaluo->predio->codigo_postal }};
    @endif

    @if ($avaluo->predio->tipo_asentamiento)
        <strong>TIPO DE ASENTAMIENTO:</strong> {{ $avaluo->predio->tipo_asentamiento }};
    @endif

    @if ($avaluo->predio->nombre_asentamiento)
        <strong>NOMBRE DEL ASENTAMIENTO:</strong> {{ $avaluo->predio->nombre_asentamiento }};
    @endif

    @if ($avaluo->predio->municipio)
        <strong>MUNICIPIO:</strong> {{ $avaluo->predio->municipio }};
    @endif

    @if ($avaluo->predio->localidad)
        <strong>LOCALIDAD:</strong> {{ $avaluo->predio->localidad }};
    @endif

    @if ($avaluo->predio->tipo_vialidad)
        <strong>TIPO DE VIALIDAD:</strong> {{ $avaluo->predio->tipo_vialidad }};
    @endif

    @if ($avaluo->predio->nombre_vialidad)
        <strong>NOMBRE DE LA VIALIDAD:</strong> {{ $avaluo->predio->nombre_vialidad }};
    @endif

    @if ($avaluo->predio->numero_exterior)
        <strong>NÚMERO EXTERIOR:</strong> {{ $avaluo->predio->numero_exterior }};
    @endif

    @if ($avaluo->predio->numero_interior)
        <strong>NÚMERO INTERIOR:</strong> {{ $avaluo->predio->numero_interior }};
    @endif

    @if ($avaluo->predio->nombre_edificio)
        <strong>EDIFICIO:</strong> {{ $avaluo->predio->nombre_edificio }};
    @endif

    @if ($avaluo->predio->clave_edificio)
        <strong>clave del edificio:</strong> {{ $avaluo->predio->clave_edificio }};
    @endif

    @if ($avaluo->predio->departamento_edificio)
        <strong>DEPARTAMENTO:</strong> {{ $avaluo->predio->departamento_edificio }};
    @endif

    @if ($avaluo->predio->numero_exterior_2)
        <strong>número exterior 2:</strong> {{ $avaluo->predio->numero_exterior_2 }};
    @endif

    @if ($avaluo->predio->numero_adicional)
        <strong>número adicional:</strong> {{ $avaluo->predio->numero_adicional }};
    @endif

    @if ($avaluo->predio->numero_adicional_2)
        <strong>número adicional 2:</strong> {{ $avaluo->predio->numero_adicional_2 }};
    @endif

    @if ($avaluo->predio->lote_fraccionador)
        <strong>lote del fraccionador:</strong> {{ $avaluo->predio->lote_fraccionador }};
    @endif

    @if ($avaluo->predio->manzana_fraccionador)
        <strong>manzana del fraccionador:</strong> {{ $avaluo->predio->manzana_fraccionador }};
    @endif

    @if ($avaluo->predio->etapa_fraccionador)
        <strong>etapa del fraccionador:</strong> {{ $avaluo->predio->etapa_fraccionador }};
    @endif

    @if ($avaluo->predio->ubicacion_en_manzana)
        <strong>ubicación en manzana:</strong> {{ $avaluo->predio->ubicacion_en_manzana }};
    @endif

    @if ($avaluo->predio->nombre_predio)
        <strong>Predio Rústico Denominado ó Antecedente:</strong> {{ $avaluo->predio->nombre_predio }};
    @endif

    @if ($avaluo->predio->observaciones)
        <strong>OBSERVACIONES:</strong> {{ $avaluo->predio->observaciones }}.
    @endif

</p>

@if($avaluo->predio->xutm || $avaluo->predio->lat)

    <p class="parrafo">
        <strong>Coordenadas geográficas: </strong>
    </p>

    @if($avaluo->predio->xutm)

        <p class="parrafo">

            <strong>UTM: </strong>
            <strong>X:</strong> {{ $avaluo->predio->xutm }}, <strong>Y:</strong> {{ $avaluo->predio->yutm }},  <strong>Z:</strong> {{ $avaluo->predio->zutm }}

            @if($avaluo->predio->xutm)

                 | <strong>GEO: </strong>
                <strong>LAT:</strong> {{ $avaluo->predio->lat }}, <strong>LON:</strong> {{ $avaluo->predio->lon }}

            @endif

        </p>

    @endif

@endif