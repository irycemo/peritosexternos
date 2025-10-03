<p class="separador">Características</p>

<p class="parrafo">

    <p><strong>Clasificación de la zona:</strong> {{ $predio->avaluo->clasificacion_zona }}</p>
    <p><strong>Tipo de construcción dominante:</strong> {{ $predio->avaluo->construccion_dominante }}</p>

</p>

<table style="margin-top: 20px;" class="no-break">

    <thead>

        <tr>
            <th style="padding: 0 5px 0 5px; text-align: center;"></th>
            <th style="padding: 0 5px 0 5px; text-align: center;">Agua</th>
            <th style="padding: 0 5px 0 5px; text-align: center;">Drenaje</th>
            <th style="padding: 0 5px 0 5px; text-align: center;">Pavimento</th>
            <th style="padding: 0 5px 0 5px; text-align: center;">Energía eléctrica</th>
            <th style="padding: 0 5px 0 5px; text-align: center;">Alumbrado púlico</th>
            <th style="padding: 0 5px 0 5px; text-align: center;">Banqueta</th>
        </tr>

    </thead>

    <tbody>

        <tr>
            <td style="padding-right: 40px;">
                <p><strong>Servicios municipales</strong></p>
            </td>
            <td style="text-align: center;">
                {{ $predio->avaluo->agua ? 'Si' : 'No' }}
            </td>
            <td style="text-align: center;">
                {{ $predio->avaluo->drenaje ? 'Si' : 'No' }}
            </td>
            <td style="text-align: center;">
                {{ $predio->avaluo->drenaje ? 'Si' : 'No' }}
            </td>
            <td style="text-align: center;">
                {{ $predio->avaluo->energia_electrica ? 'Si' : 'No' }}
            </td>
            <td style="text-align: center;">
                {{ $predio->avaluo->alumbrado_publico ? 'Si' : 'No' }}
            </td>
            <td style="text-align: center;">
                {{ $predio->avaluo->banqueta ? 'Si' : 'No' }}
            </td>
        </tr>

    </tbody>

</table>

@foreach ($predio->avaluo->bloques as $bloque)

    <p class="separador">Bloque {{ $loop->iteration }}</p>

    <strong>Uso del bloque:</strong> {{ $bloque->uso }}

    <p style="text-align: center; margin-top: 20px;"><strong>Obra negra</strong></p>

    <table class="no-break">

        <thead>

            <tr>
                <th style="padding: 0 5px 0 5px; text-align: center;">Cimentación</th>
                <th style="padding: 0 5px 0 5px; text-align: center;">Estructura</th>
                <th style="padding: 0 5px 0 5px; text-align: center;">Muros</th>
                <th style="padding: 0 5px 0 5px; text-align: center;">Entrepisos</th>
                <th style="padding: 0 5px 0 5px; text-align: center;">Techo</th>
            </tr>

        </thead>

        <tbody style="border-right: 1px solid black;">

            <tr>
                <td style="padding: 0 10px 0 10px; text-align: center;">
                    <p>{{ $bloque->cimentacion }}</p>
                </td>
                <td style="padding: 0 10px 0 10px; text-align: center;">
                    <p>{{ $bloque->estructura }}</p>
                </td>
                <td style="padding: 0 10px 0 10px; text-align: center;">
                    <p>{{ $bloque->muros }}</p>
                </td>
                <td style="padding: 0 10px 0 10px; text-align: center;">
                    <p>{{ $bloque->entrepiso }}</p>
                </td>
                <td style="padding: 0 10px 0 10px; text-align: center;">
                    <p>{{ $bloque->techo }}</p>
                </td>
            </tr>

        </tbody>

    </table>

    <p style="text-align: center; margin-top: 20px;"><strong>Acabados</strong></p>

    <table class="no-break">

        <thead>

            <tr>
                <th style="padding: 0 5px 0 5px; text-align: center;">Plafones</th>
                <th style="padding: 0 5px 0 5px; text-align: center;">Vidriería</th>
                <th style="padding: 0 5px 0 5px; text-align: center;">Lambrines</th>
                <th style="padding: 0 5px 0 5px; text-align: center;">Pisos</th>
            </tr>

        </thead>

        <tbody>

            <tr>
                <td style="padding: 0 10px 0 10px; text-align: center;">
                    <p>{{ $bloque->plafones }}</p>
                </td>
                <td style="padding: 0 10px 0 10px; text-align: center;">
                    <p>{{ $bloque->vidrieria }}</p>
                </td>
                <td style="padding: 0 10px 0 10px; text-align: center;">
                    <p>{{ $bloque->lambrines }}</p>
                </td>
                <td style="padding: 0 10px 0 10px; text-align: center;">
                    <p>{{ $bloque->pisos }}</p>
                </td>
            </tr>

        </tbody>

    </table>

    <table class="no-break">

        <thead>

            <tr>
                <th style="padding: 0 5px 0 5px; text-align: center;">Herrería</th>
                <th style="padding: 0 5px 0 5px; text-align: center;">Pintura</th>
                <th style="padding: 0 5px 0 5px; text-align: center;">Carpintería</th>
                <th style="padding: 0 5px 0 5px; text-align: center;">Aplanados</th>
                <th style="padding: 0 5px 0 5px; text-align: center;">Recubrimiento especial</th>
            </tr>

        </thead>

        <tbody>

            <tr>
                <td style="padding: 0 10px 0 10px; text-align: center;">
                    <p>{{ $bloque->herreria }}</p>
                </td>
                <td style="padding: 0 10px 0 10px; text-align: center;">
                    <p>{{ $bloque->pintura }}</p>
                </td>
                <td style="padding: 0 10px 0 10px; text-align: center;">
                    <p>{{ $bloque->carpinteria }}</p>
                </td>
                <td style="padding: 0 10px 0 10px; text-align: center;">
                    <p>{{ $bloque->aplanados }}</p>
                </td>
                <td style="padding: 0 10px 0 10px; text-align: center;">
                    <p>{{ $bloque->recubrimiento_especial }}</p>
                </td>
            </tr>

        </tbody>

    </table>

    <p style="text-align: center; margin-top: 20px;"><strong>Instalaciones</strong></p>

    <table class="no-break">

        <thead>

            <tr>
                <th style="padding: 0 5px 0 5px; text-align: center;">Hidráulica</th>
                <th style="padding: 0 5px 0 5px; text-align: center;">Sanitaria</th>
                <th style="padding: 0 5px 0 5px; text-align: center;">Eléctrica</th>
                <th style="padding: 0 5px 0 5px; text-align: center;">Gas</th>
                <th style="padding: 0 5px 0 5px; text-align: center;">Especiales</th>
            </tr>

        </thead>

        <tbody>

            <tr>
                <td style="padding: 0 10px 0 10px; text-align: center;">
                    <p>{{ $bloque->hidraulica }}</p>
                </td>
                <td style="padding: 0 10px 0 10px; text-align: center;">
                    <p>{{ $bloque->sanitaria }}</p>
                </td>
                <td style="padding: 0 10px 0 10px; text-align: center;">
                    <p>{{ $bloque->electrica }}</p>
                </td>
                <td style="padding: 0 10px 0 10px; text-align: center;">
                    <p>{{ $bloque->gas }}</p>
                </td>
                <td style="padding: 0 10px 0 10px; text-align: center;">
                    <p>{{ $bloque->especiales }}</p>
                </td>
            </tr>

        </tbody>

    </table>

@endforeach