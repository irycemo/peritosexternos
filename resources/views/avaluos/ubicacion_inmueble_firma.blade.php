<p class="separador">UBICACIÓN DEL INMUEBLE</p>

<div>

    @if ($avaluo->predio->tipo_vialidad)
        <span>TIPO DE VIALIDAD: <strong>{{ $avaluo->predio->tipo_vialidad }}</strong></span>
    @endif

    @if ($avaluo->predio->nombre_vialidad)
        <span style="padding-left: 5px;">NOMBRE DE LA VIALIDAD: <strong>{{ $avaluo->predio->nombre_vialidad }}</strong></span>
    @endif

    @if ($avaluo->predio->numero_exterior)
        <span style="padding-left: 5px;">NÚMERO EXTERIOR: <strong>{{ $avaluo->predio->numero_exterior }}</strong></span>
    @endif

    @if ($avaluo->predio->numero_interior)
        <span style="padding-left: 5px;">NÚMERO INTERIOR: <strong>{{ $avaluo->predio->numero_interior }}</strong></span>
    @endif

    @if ($avaluo->predio->numero_exterior_2)
        <span style="padding-left: 5px;">número exterior 2: <strong>{{ $avaluo->predio->numero_exterior_2 }}</strong></span>
    @endif

    @if ($avaluo->predio->numero_adicional)
        <span style="padding-left: 5px;">número adicional: <strong>{{ $avaluo->predio->numero_adicional }}</strong></span>
    @endif

    @if ($avaluo->predio->numero_adicional_2)
        <span style="padding-left: 5px;">número adicional 2: <strong>{{ $avaluo->predio->numero_adicional_2 }}</strong></span>
    @endif

    @if ($avaluo->predio->tipo_asentamiento)
        <span style="padding-left: 5px;">TIPO DE ASENTAMIENTO: <strong>{{ $avaluo->predio->tipo_asentamiento }}</strong></span>
    @endif

    @if ($avaluo->predio->nombre_asentamiento)
        <span style="padding-left: 5px;">NOMBRE DEL ASENTAMIENTO: <strong>{{ $avaluo->predio->nombre_asentamiento }}</strong></span>
    @endif

    @if ($avaluo->predio->codigo_postal)
        <span style="padding-left: 5px;">CÓDIGO POSTAL: <strong>{{ $avaluo->predio->codigo_postal }}</strong></span>
    @endif

</div>

<p class="parrafo">

    @if ($avaluo->predio->nombre_edificio)
        EDIFICIO: <strong>{{ $avaluo->predio->nombre_edificio }}</strong>
    @endif

    @if ($avaluo->predio->clave_edificio)
        clave del edificio: <strong>{{ $avaluo->predio->clave_edificio }}</strong>
    @endif

    @if ($avaluo->predio->departamento_edificio)
        DEPARTAMENTO: <strong>{{ $avaluo->predio->departamento_edificio }}</strong>
    @endif

    @if ($avaluo->predio->lote_fraccionador)
        lote del fraccionador: <strong>{{ $avaluo->predio->lote_fraccionador }}</strong>
    @endif

    @if ($avaluo->predio->manzana_fraccionador)
        manzana del fraccionador: <strong>{{ $avaluo->predio->manzana_fraccionador }}</strong>
    @endif

    @if ($avaluo->predio->etapa_fraccionador)
        etapa del fraccionador: <strong>{{ $avaluo->predio->etapa_fraccionador }}</strong>
    @endif

    @if ($avaluo->predio->ubicacion_en_manzana)
        ubicación en manzana: <strong>{{ $avaluo->predio->ubicacion_en_manzana }}</strong>
    @endif

    @if ($avaluo->predio->nombre_predio)
        Predio Rústico Denominado ó Antecedente: <strong>{{ $avaluo->predio->nombre_predio }}</strong>
    @endif

</p>

<p class="parrafo">

    @if ($avaluo->predio->municipio)
        MUNICIPIO: <strong>{{ $datos_control->municipio ?? $avaluo->predio->municipio }}</strong>
    @endif

    @if ($avaluo->predio->localidad)
        LOCALIDAD: <strong>{{ $datos_control->oficina ?? $avaluo->predio->localidad }}</strong>
    @endif

</p>

@if($avaluo->predio->xutm || $avaluo->predio->lat)

    Coordenadas geográficas:

    <table style="width: 100%;">

        <tbody>
            <tr>
                <td style="text-align: left;">

                    UTM
                    X: <strong>{{ $avaluo->predio->xutm }}</strong>, Y: <strong>{{ $avaluo->predio->yutm }}</strong>, Z: <strong>{{ $avaluo->predio->zutm }}</strong>

                </td>
                <td style="">

                    GEO
                    LAT: <strong>{{ $avaluo->predio->lat }}</strong>, LON: <strong>{{ $avaluo->predio->lon }}</strong>

                </td>
            </tr>
        </tbody>

    </table>

@endif

