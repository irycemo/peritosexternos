<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Avaluo</title>
</head>
<style>

    /* @page {
        margin: 0cm 0cm;
    } */

    header{
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 100px;
        text-align: center;
    }

    .encabezado{
        height: 100px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    body{
        margin-top: 120px;
        margin-bottom: 20px;
        counter-reset: page;
        height: 100%;
        background-image: url("storage/img/escudo_fondo.png");
        background-size: cover;
        font-family: sans-serif;
        font-weight: normal;
        line-height: 1.5;
        text-transform: uppercase;
        font-size: 9px;
    }

    .titulo{
        text-align: center;
        font-size: 11px;
        font-weight: bold;
        margin: 0;
    }

    .fundamento{
        text-align: justify;
        font-size: 9px;
    }

    .separador{
        text-align: justify;
        border-bottom: 1px solid black;
        padding: 0 20px 0 20px;
        border-radius: 25px;
        border-color: gray;
        letter-spacing: 5px;
        margin: 0 0 5px 0;
    }

    .informacion p{
        margin: 0;
    }

    table{
        margin-bottom: 5px;
        margin-left: auto;
        margin-right: auto;
    }

    footer{
        position: fixed;
        bottom: 0cm;
        left: 0cm;
        right: 0cm;
        background: #5E1D45;
        color: white;
        font-size: 12px;
        text-transform: lowercase;
    }

    .fot{
        padding: 2px;
    }

    .fot p{
        text-align: center;
        margin: 0;
        margin-left: 10px;
    }

    .qr{
        display: block;
    }

    .caracteristicas-tabla{
        page-break-inside: avoid;
    }

    .totales{
        flex: auto;
    }

    .imagenes{
        width: 200px;
    }

    .borde{
        display: inline;
        border-top: 1px solid;
    }

</style>
<body>

    <header>

            <img class="encabezado" src="{{ public_path('storage/img/encabezado.png') }}" alt="encabezado">

    </header>

    <footer>

        <div class="fot">
            <p>www.irycem.michoacan.gob.mx</p>
        </div>

    </footer>

    <main>

        <div>

            <p class="titulo">AVALÚO CATASTRAL</p>

        </div>

        <div class="content">

            <p class="separador">Información general</p>

            <div class="informacion">

                <table>

                    <tbody>

                        <tr>
                            <td style="padding-right: 40px;">
                                <p><strong>Folio del avalúo:</strong> {{ $predio->avaluo->año }}-{{ $predio->avaluo->folio }}</p>
                            </td>
                            <td style="padding-right: 40px;">
                                <p><strong>Cuenta predial:</strong> {{ $predio->localidad }}-{{ $predio->oficina }}-{{ $predio->tipo_predio }}-{{ $predio->numero_registro }}</p>
                            </td>
                            <td>
                                <p><strong>Clave catastral:</strong> {{ $predio->estado }}-{{ $predio->region_catastral }}-{{ $predio->municipio }}-{{ $predio->zona_catastral }}-{{ $predio->localidad }}-{{ $predio->sector }}-{{ $predio->manzana }}-{{ $predio->predio }}-{{ $predio->edificio ?? 0 }}-{{ $predio->departamento ?? 0 }}</p>
                            </td>
                        </tr>

                    </tbody>

                </table>

                <p><strong>Propietario:</strong> {{ $predio->propietarios->first()->persona->nombre }} {{ $predio->propietarios->first()->persona->ap_paterno }} {{ $predio->propietarios->first()->persona->ap_materno }} {{ $predio->sociedad ? ' y SOC.' : '' }}</p>

            </div>

            <p class="separador">Ubicación del predio</p>

            <div class="informacion">

                <p style=" margin-bottom: 8px;">
                    @if($predio->tipo_asentamiento)<strong>Tipo de asentamiento:</strong> {{ $predio->tipo_asentamiento }},@endif
                    @if($predio->nombre_asentamiento)<strong>Nombre del asentamiento:</strong> {{ $predio->nombre_asentamiento }},@endif
                    @if($predio->tipo_vialidad)<strong>Tipo de vialidad:</strong> {{ $predio->tipo_vialidad }},@endif
                    @if($predio->nombre_vialidad)<strong>Nombre de la vialidad:</strong> {{ $predio->nombre_vialidad }},@endif
                    @if($predio->numero_interior)<strong>Número interior:</strong> {{ $predio->numero_interior }},@endif
                    @if($predio->numero_exterior)<strong>Número exterior:</strong> {{ $predio->numero_exterior }},@endif
                    @if($predio->numero_exterior_2)<strong>Número exterior 2:</strong> {{ $predio->numero_exterior_2 }},@endif
                    @if($predio->numero_adicional)<strong>Número adicional:</strong> {{ $predio->numero_adicional }},@endif
                    @if($predio->numero_adicional_2)<strong>Número adicional 2:</strong> {{ $predio->numero_adicional_2 }},@endif
                    @if($predio->codigo_postal)<strong>Código postal:</strong> {{ $predio->codigo_postal }}@endif
                </p>

                <p style=" margin-bottom: 8px;">
                    @if($predio->nombre_edificio)<strong>Nombre del edificio:</strong> {{ $predio->nombre_edificio }},@endif
                    @if($predio->clave_edificio)<strong>Clave del edificio:</strong> {{ $predio->clave_edificio }},@endif
                    @if($predio->departamento_edificio)<strong>Departamento:</strong> {{ $predio->departamento_edificio }}@endif
                </p>

                <p style=" margin-bottom: 8px;">
                    @if($predio->lote_fraccionador)<strong>Lote del fraccionador:</strong> {{ $predio->lote_fraccionador }},@endif
                    @if($predio->manzana_fraccionador)<strong>Manzana del fraccionador:</strong> {{ $predio->manzana_fraccionador }},@endif
                    @if($predio->etapa_fraccionador)<strong>Etapa del fraccionador:</strong> {{ $predio->etapa_fraccionador }}@endif
                    @if($predio->ubicacion_en_manzana)<strong>Ubicación del predio en la manzana:</strong> {{ $predio->ubicacion_en_manzana }}@endif
                </p>

                <p style="">
                    @if($predio->nombre_predio)<strong>Predio Rústico Denominado ó Antecedente:</strong> {{ $predio->nombre_predio }}@endif
                </p>

                @if($predio->xutm || $predio->lat)

                    <p style=" margin-top: 8px;">
                        <strong>Coordenadas geográficas: </strong>
                    </p>

                    @if($predio->xutm)

                            <strong>UTM: </strong>
                            <strong>X:</strong> {{ $predio->xutm }}, <strong>Y:</strong> {{ $predio->yutm }},  <strong>Z:</strong> {{ $predio->zutm }}

                    @endif

                    @if($predio->xutm)
                        <p style="">
                            <strong>GEO: </strong>
                            <strong>LAT:</strong> {{ $predio->lat }}, <strong>LON:</strong> {{ $predio->lon }}
                        </p>
                    @endif

                @endif

            </div>

            @if($predio->colindancias->count())

                <p class="separador">Colindancias</p>

                <div class="informacion" >

                    <table>

                        <thead>

                            <tr>
                                <th>Viento</th>
                                <th>Longitud</th>
                                <th>Descripción</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($predio->colindancias as $colindancia)

                                <tr>
                                    <td style="padding-right: 40px;">
                                        <p>{{ $colindancia->viento }}</p>
                                    </td>
                                    <td style="padding-right: 40px;">
                                        <p>{{ number_format($colindancia->longitud, 2) }} mts.</p>
                                    </td>
                                    <td>
                                        <p>{{ $colindancia->descripcion }}</p>
                                    </td>
                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

            <p class="separador">Características</p>

            <div class="informacion">

                <p><strong>Clasificación de la zona:</strong> {{ $predio->avaluo->clasificacion_zona }}</p>
                <p><strong>Tipo de construcción dominante:</strong> {{ $predio->avaluo->construccion_dominante }}</p>

                <table style="margin-top: 20px;">

                    <thead>

                        <tr>
                            <th style="padding: 0 5px 0 5px;"></th>
                            <th style="padding: 0 5px 0 5px;">Agua</th>
                            <th style="padding: 0 5px 0 5px;">Drenaje</th>
                            <th style="padding: 0 5px 0 5px;">Pavimento</th>
                            <th style="padding: 0 5px 0 5px;">Energía eléctrica</th>
                            <th style="padding: 0 5px 0 5px;">Alumbrado púlico</th>
                            <th style="padding: 0 5px 0 5px;">Banqueta</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>
                            <td style="padding-right: 40px;">
                                <p><strong>Servicios municipales</strong></p>
                            </td>
                            <td style="padding-right: 40px; border: 1px solid black;">
                                {{ $predio->avaluo->agua ? 'Si' : 'No' }}
                            </td>
                            <td style="padding-right: 40px; border: 1px solid black;">
                                {{ $predio->avaluo->drenaje ? 'Si' : 'No' }}
                            </td>
                            <td style="padding-right: 40px; border: 1px solid black;">
                                {{ $predio->avaluo->drenaje ? 'Si' : 'No' }}
                            </td>
                            <td style="padding-right: 40px; border: 1px solid black;">
                                {{ $predio->avaluo->energia_electrica ? 'Si' : 'No' }}
                            </td>
                            <td style="padding-right: 40px; border: 1px solid black;">
                                {{ $predio->avaluo->alumbrado_publico ? 'Si' : 'No' }}
                            </td>
                            <td style="padding-right: 40px; border: 1px solid black;">
                                {{ $predio->avaluo->banqueta ? 'Si' : 'No' }}
                            </td>
                        </tr>

                    </tbody>

                </table>

                <div class="caracteristicas-tabla">

                    <p style="text-align: center; margin-top: 20px;"><strong>Obra negra</strong></p>

                    <table>

                        <thead>

                            <tr>
                                <th style="padding: 0 5px 0 5px;">Cimentación</th>
                                <th style="padding: 0 5px 0 5px;">Estructura</th>
                                <th style="padding: 0 5px 0 5px;">Muros</th>
                                <th style="padding: 0 5px 0 5px;">Entrepisos</th>
                                <th style="padding: 0 5px 0 5px;">Techo</th>
                            </tr>

                        </thead>

                        <tbody>

                            <tr>
                                <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                    <p>{{ $predio->avaluo->cimentacion }}</p>
                                </td>
                                <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                    <p>{{ $predio->avaluo->estructura }}</p>
                                </td>
                                <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                    <p>{{ $predio->avaluo->muros }}</p>
                                </td>
                                <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                    <p>{{ $predio->avaluo->entrepiso }}</p>
                                </td>
                                <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                    <p>{{ $predio->avaluo->techo }}</p>
                                </td>
                            </tr>

                        </tbody>

                    </table>

                </div>

                <div class="caracteristicas-tabla">

                    <p style="text-align: center; margin-top: 20px;"><strong>Acabados</strong></p>

                    <table>

                        <thead>

                            <tr>
                                <th style="padding: 0 5px 0 5px;">Plafones</th>
                                <th style="padding: 0 5px 0 5px;">Vidriería</th>
                                <th style="padding: 0 5px 0 5px;">Lambrines</th>
                                <th style="padding: 0 5px 0 5px;">Pisos</th>
                            </tr>

                        </thead>

                        <tbody>

                            <tr>
                                <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                    <p>{{ $predio->avaluo->plafones }}</p>
                                </td>
                                <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                    <p>{{ $predio->avaluo->vidrieria }}</p>
                                </td>
                                <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                    <p>{{ $predio->avaluo->lambrines }}</p>
                                </td>
                                <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                    <p>{{ $predio->avaluo->pisos }}</p>
                            </tr>

                        </tbody>

                    </table>

                    <table>

                        <thead>

                            <tr>
                                <th style="padding: 0 5px 0 5px;">Herrería</th>
                                <th style="padding: 0 5px 0 5px;">Pintura</th>
                                <th style="padding: 0 5px 0 5px;">Carpintería</th>
                                <th style="padding: 0 5px 0 5px;">Aplanados</th>
                                <th style="padding: 0 5px 0 5px;">Recubrimiento especial</th>
                            </tr>

                        </thead>

                        <tbody>

                            <tr>
                                <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                    <p>{{ $predio->avaluo->herreria }}</p>
                                </td>
                                <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                    <p>{{ $predio->avaluo->pintura }}</p>
                                </td>
                                <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                    <p>{{ $predio->avaluo->carpinteria }}</p>
                                </td>
                                <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                    <p>{{ $predio->avaluo->aplanados }}</p>
                                </td>
                                <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                    <p>{{ $predio->avaluo->recubrimiento_especial }}</p>
                                </td>
                            </tr>

                        </tbody>

                    </table>

                </div>

                <div class="caracteristicas-tabla">

                    <p style="text-align: center; margin-top: 20px;"><strong>Instalaciones</strong></p>

                    <table>

                        <thead>

                            <tr>
                                <th style="padding: 0 5px 0 5px;">Hidráulica</th>
                                <th style="padding: 0 5px 0 5px;">Sanitaria</th>
                                <th style="padding: 0 5px 0 5px;">Eléctrica</th>
                                <th style="padding: 0 5px 0 5px;">Gas</th>
                                <th style="padding: 0 5px 0 5px;">Especiales</th>
                            </tr>

                        </thead>

                        <tbody>

                            <tr>
                                <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                    <p>{{ $predio->avaluo->hidraulica }}</p>
                                </td>
                                <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                    <p>{{ $predio->avaluo->sanitaria }}</p>
                                </td>
                                <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                    <p>{{ $predio->avaluo->electrica }}</p>
                                </td>
                                <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                    <p>{{ $predio->avaluo->gas }}</p>
                                </td>
                                <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                    <p>{{ $predio->avaluo->especiales }}</p>
                                </td>
                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

            <p class="separador">Determinación de valor catastral</p>

            <div class="informacion">

                <p><strong>Uso del predio:</strong> {{ $predio->uso_1 }}</p>
                @if($predio->uso_2)<p><strong>Uso del predio 2:</strong> {{ $predio->uso_2 }}</p>@endif
                @if($predio->uso_3)<p><strong>Uso del predio 3:</strong> {{ $predio->uso_3 }}</p>@endif

                @if($predio->terrenos->count())

                    <div class="caracteristicas-tabla">

                        <p style="text-align: center; margin-top: 20px;"><strong>Terrenos</strong></p>

                        <table>

                            <thead>

                                <tr>
                                    <th style="padding: 0 5px 0 5px;">Superficie</th>
                                    <th style="padding: 0 5px 0 5px;">Valor del terreno</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($predio->terrenos as $terreno)

                                    <tr>
                                        <td style="padding-right: 40px; font-size:10px; border: 1px solid black; text-align: right">
                                            <p>{{ $terreno->superficie }}</p>
                                        </td>
                                        <td style="padding-right: 40px; font-size:10px; border: 1px solid black; text-align: right">
                                            <p>${{ number_format($terreno->valor_terreno, 2) }}</p>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @endif

                @if($predio->construcciones->count())

                    <div class="caracteristicas-tabla">

                        <p style="text-align: center; margin-top: 20px;"><strong>Construcciones</strong></p>

                        <table>

                            <thead>

                                <tr>
                                    <th style="padding: 0 5px 0 5px;">Referencia</th>
                                    <th style="padding: 0 5px 0 5px;">Clasificación de construcción</th>
                                    <th style="padding: 0 5px 0 5px;">Valor unitario</th>
                                    <th style="padding: 0 5px 0 5px;">Niveles</th>
                                    <th style="padding: 0 5px 0 5px;">Superficie</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($predio->construcciones as $construccion)

                                    <tr>
                                        <td style="padding-right: 40px; font-size:10px; border: 1px solid black; text-align: right">
                                            <p>{{ $construccion->referencia }}</p>
                                        </td>
                                        <td style="padding-right: 40px; font-size:10px; border: 1px solid black; text-align: right">
                                            <p>{{ $construccion->tipo }}{{ $construccion->uso }}{{ $construccion->estado }}{{ $construccion->calidad }}</p>
                                        </td>
                                        <td style="padding-right: 40px; font-size:10px; border: 1px solid black; text-align: right">
                                            <p>${{ number_format($construccion->valor_unitario, 2) }}</p>
                                        </td>
                                        <td style="padding-right: 40px; font-size:10px; border: 1px solid black; text-align: right">
                                            <p>{{ $construccion->niveles }}</p>
                                        </td>
                                        <td style="padding-right: 40px; font-size:10px; border: 1px solid black; text-align: right">
                                            <p>{{ $construccion->superficie }}</p>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @endif

                @if($predio->edificio != 0)

                    <div class="caracteristicas-tabla">

                        <p style="text-align: center; margin-top: 20px;"><strong>Condominios</strong></p>

                        <table>

                            <thead>

                                <tr>
                                    <th style="padding: 0 5px 0 5px;">Área común de terreno</th>
                                    <th style="padding: 0 5px 0 5px;">Indiviso de terreno</th>
                                    <th style="padding: 0 5px 0 5px;">Superficie proporcional</th>
                                    <th style="padding: 0 5px 0 5px;">Valor unitario</th>
                                    <th style="padding: 0 5px 0 5px;">Valor de terreno común</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($predio->condominioTerrenos as $constr)

                                    <tr>
                                        <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                            <p>{{ $constr->area_terreno_comun }}</p>
                                        </td>
                                        <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                            <p>{{ $constr->indiviso_terreno }}</p>
                                        </td>
                                        <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                            <p>{{ $constr->superficie_proporcional }}</p>
                                        </td>
                                        <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                            <p>{{ $constr->valor_unitario }}</p>
                                        </td>
                                        <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                            <p>{{ $constr->valor_terreno_comun }}</p>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                    @if($predio->condominioConstrucciones->count())

                        <div class="caracteristicas-tabla">

                            <p style="text-align: center; margin-top: 20px;"><strong>Construcciones de área común</strong></p>

                            <table>

                                <thead>

                                    <tr>
                                        <th style="padding: 0 5px 0 5px;">Área común de construcción</th>
                                        <th style="padding: 0 5px 0 5px;">Indiviso de construcción</th>
                                        <th style="padding: 0 5px 0 5px;">Superficie proporcional</th>
                                        <th style="padding: 0 5px 0 5px;">Clasificación de construccion</th>
                                        <th style="padding: 0 5px 0 5px;">Valor de construcción común</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach ($predio->condominioConstrucciones as $constr)

                                        <tr>
                                            <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                                <p>{{ $constr->area_comun_construccion }}</p>
                                            </td>
                                            <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                                <p>{{ $constr->indiviso_construccion }}</p>
                                            </td>
                                            <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                                <p>{{ $constr->superficie_proporcional }}</p>
                                            </td>
                                            <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                                <p>{{ $constr->valor_clasificacion_construccion }}</p>
                                            </td>
                                            <td style="padding-right: 40px; font-size:10px; border: 1px solid black;">
                                                <p>{{ $constr->valor_construccion_comun }}</p>
                                            </td>
                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @endif

                @endif

                <div class="caracteristicas-tabla totales">

                    <table>
                        <tr>
                            <td style="padding-right: 10px;">

                            <p style="text-align: center; margin-top: 20px;"><strong>Superficies</strong></p>

                            <table>

                                <thead>

                                    <tr>
                                        <th style="padding: 0 5px 0 5px;"></th>
                                        <th style="padding: 0 5px 0 5px;">Privativa</th>
                                        <th style="padding: 0 5px 0 5px;">Proporcional</th>
                                        <th style="padding: 0 5px 0 5px;">Total</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    <tr>
                                        <td style="padding-right: 40px; font-size:10px">
                                            <p>Superficie de terreno</p>
                                        </td>
                                        <td style="padding-right: 40px; font-size:10px; border: 1px solid black; text-align: right;">
                                            <p>{{ $predio->superficie_terreno }}</p>
                                        </td>
                                        <td style="padding-right: 40px; font-size:10px; border: 1px solid black; text-align: right;">
                                            <p>{{ collect($predio->condominioTerrenos)->sum('superficie_proporcional') }}</p>
                                        </td>
                                        <td style="padding-right: 40px; font-size:10px; border: 1px solid black; text-align: right;">
                                            <p>{{ $predio->superficie_terreno  + collect($predio->condominioTerrenos)->sum('superficie_proporcional') }}</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="padding-right: 40px; font-size:10px">
                                            <p>Superficie de construcción</p>
                                        </td>
                                        <td style="padding-right: 40px; font-size:10px; border: 1px solid black; text-align: right;">
                                            <p>{{ $predio->superficie_construccion }}</p>
                                        </td>
                                        <td style="padding-right: 40px; font-size:10px; border: 1px solid black; text-align: right;">
                                            <p>{{ collect($predio->condominioConstrucciones)->sum('superficie_proporcional') }}</p>
                                        </td>
                                        <td style="padding-right: 40px; font-size:10px; border: 1px solid black; text-align: right;">
                                            <p>{{ $predio->superficie_construccion  + collect($predio->condominioConstrucciones)->sum('superficie_proporcional') }}</p>
                                        </td>
                                    </tr>

                                </tbody>

                            </table>
                            </td>
                            <td>
                            <div class="caracteristicas-tabla">

                                <p style="text-align: center; margin-top: 20px;"><strong>Valores</strong></p>

                                <table >

                                    <thead><tr><th></th></tr></thead>

                                    <tbody>

                                        <tr>
                                            <td style="padding-right: 40px; font-size:10px">Privativo + Proporcional</td>
                                            <td style="padding-right: 40px; font-size:10px; border: 1px solid black; text-align: right;">${{ number_format($predio->valor_total_terreno + $predio->valor_terreno_comun, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding-right: 40px; font-size:10px">Privativo + Proporcional</td>
                                            <td style="padding-right: 40px; font-size:10px; border: 1px solid black; text-align: right;">${{ number_format($predio->valor_total_construccion + $predio->valor_construccion_comun, 2) }}</td>
                                        </tr>
                                        @if($predio->ubicacion_en_manzana == 'ESQUINA')

                                            <tr>
                                                <td style="padding-right: 40px; font-size:10px">Sub Total</td>
                                                <td style="padding-right: 40px; font-size:10px; border: 1px solid black; text-align: right;">${{ number_format($predio->valor_total_terreno + $predio->valor_terreno_comun + $predio->valor_total_construccion + $predio->valor_construccion_comun, 2) }}</td>
                                            </tr>

                                            <tr>
                                                <td style="padding-right: 40px; font-size:10px">Ubicación en esquina</td>
                                                <td style="padding-right: 40px; font-size:10px; border: 1px solid black; text-align: right;">${{ number_format(($predio->valor_total_terreno + $predio->valor_terreno_comun + $predio->valor_total_construccion + $predio->valor_construccion_comun) * 0.15, 2) }}</td>
                                            </tr>

                                            <tr>
                                                <td style="padding-right: 40px; font-size:10px">Total</td>
                                                <td style="padding-right: 40px; font-size:10px; border: 1px solid black; text-align: right;">${{ number_format(($predio->valor_total_terreno + $predio->valor_terreno_comun + $predio->valor_total_construccion + $predio->valor_construccion_comun) + ($predio->valor_total_terreno + $predio->valor_terreno_comun + $predio->valor_total_construccion + $predio->valor_construccion_comun) * 0.15, 2) }}</td>
                                            </tr>

                                        @else

                                            <tr>
                                                <td style="padding-right: 40px; font-size:10px">Total</td>
                                                <td style="padding-right: 40px; font-size:10px; border: 1px solid black; text-align: right;">${{ number_format($predio->valor_total_terreno + $predio->valor_terreno_comun + $predio->valor_total_construccion + $predio->valor_construccion_comun, 2) }}</td>
                                            </tr>

                                        @endif

                                    </tbody>

                                </table>

                            </div>
                            </td>
                        </tr>
                    </table>

                    <p style="font-size: 14; text-align: center"><strong>Valor catastral del predio : ${{ number_format($predio->valor_catastral, 2) }}</strong></p>

                </div>

            </div>

            @if($predio->avaluo->observaciones)

            <div class="caracteristicas-tabla">

                <p class="separador">Observaciones</p>

                <div class="informacion">
                    @if($predio->avaluo->observaciones)<p style="text-align: justify">{{ $predio->avaluo->observaciones }}</p>@endif
                </div>

            </div>

            @endif

            <p class="separador">Imágenes</p>

            <div class="informacion">

                <table>

                    <tbody>
                            <tr>
                                <td style="font-size:12px;">

                                    <div>

                                       <p style="margin-bottom: 10px;">Fachada</p>

                                        <img class="imagenes" src="{{ public_path($predio->avaluo->fachada_pdf()) }}" alt="Fachada">

                                    </div>

                                </td>
                                <td style="font-size:12px;">
                                    <div>

                                        <p style="margin-bottom: 10px;">Fotografía 2</p>

                                        <img class="imagenes" src="{{ public_path($predio->avaluo->foto2_pdf()) }}" alt="Fotografia 2">

                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="font-size:12px;">
                                    <div>

                                        <p style="margin-bottom: 10px;">Fotografía 3</p>

                                        <img class="imagenes" src="{{ public_path($predio->avaluo->foto3_pdf()) }}" alt="Fotografia 3">

                                    </div>
                                </td>
                                <td style="font-size:12px;">
                                    <div>

                                        <p style="margin-bottom: 10px;">Fotografía 4</p>

                                        <img class="imagenes" src="{{ public_path($predio->avaluo->foto4_pdf()) }}" alt="Fotografia 4">

                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="font-size:12px;">
                                    <div>

                                        <p style="margin-bottom: 10px;">Macrolocalización</p>

                                        <img class="imagenes" src="{{ public_path($predio->avaluo->macrolocalizacion_pdf()) }}" alt="Macrolocalización">

                                    </div>
                                </td>
                                <td style="font-size:12px;">
                                    <div>

                                        <p style="margin-bottom: 10px;">Microlocalización</p>

                                        <img class="imagenes" src="{{ public_path($predio->avaluo->microlocalizacion_pdf()) }}" alt="Microlocalización">

                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="font-size:12px;">
                                    <div>

                                        <p style="margin-bottom: 10px;">Representación del polígono</p>

                                        <img class="imagenes" src="{{ public_path($predio->avaluo->poligonoImagen_pdf()) }}" alt="Representación del polígono">

                                    </div>
                                </td>
                            </tr>
                    </tbody>

                </table>

            </div>

            <p class="fundamento">AVALÚO CATASTRAL PARA EFECTOS DE DETERMINAR LA BASE GRAVABLE DEL IMPUESTO SOBRE ADQUISICIÓN DE INMUEBLES Y DEL IMPUESTO PREDIAL, DE CONFORMIDAD CON LOS ARTÍCULOS 20  FRACCIÓN I INCISO B Y 53 DE LA LEY DE HACIENDA MUNICIPAL DEL ESTADO DE MICHOACÁN DE OCAMPO
            </p>

            <div class="informacion">

                <table style="margin-top: 10px">

                    <tbody>
                        <tr>
                            <td style="padding-right: 40px;">

                                <img class="qr" src="{{ $qr }}" alt="QR">
                            </td>
                            <td style="padding-right: 40px;">

                                <p><strong>Elaborado por el perito valuador:</strong> {{ $predio->avaluo->creadoPor->name }} {{ $predio->avaluo->creadoPor->ap_paterno }} {{ $predio->avaluo->creadoPor->ap_materno }}, con clave: {{ $predio->avaluo->creadoPor->clave }}, ante la Secretaría de Finanzas y Administración. Asociación: {{ $predio->avaluo->creadoPor->asociacion }}, cédula profesional: {{ $predio->avaluo->creadoPor->cedula }}, @if($predio->avaluo->creadoPor->especialidad) especialidad: {{ $predio->avaluo->creadoPor->especialidad }} @endif</p>

                                <p><strong>Impreso el día:</strong> {{ now()->format('d-m-Y H:i:s') }}</p>

                                <p><strong>Firma del perito valuador:</strong> ___________________________________</p>

                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>

        </div>

        <div style="text-align: center;">

        </div>

    </main>

    <script type="text/php">
        if (isset($predio)) {
            $x = 280;
            $y = 810;
            $text = "Página: {PAGE_NUM} de {PAGE_COUNT}";
            $font = null;
            $size = 9;
            $color = array(0,0,0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script>

</body>
</html>
