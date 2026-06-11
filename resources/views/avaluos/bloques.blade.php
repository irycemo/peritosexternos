<p class="separador">Características</p>

<p class="parrafo">

    <p>Clasificación de la zona: <strong>{{ $predio->avaluo->clasificacion_zona }}</strong></p>
    <p>Tipo de construcción dominante: <strong>{{ $predio->avaluo->construccion_dominante }}</strong></p>

</p>

<table style="margin-top: 20px;" class="no-break">

    <thead>

        <tr>
            <th style="padding: 0 5px 0 5px; text-align: center;"></th>
            <th style="padding: 0 5px 0 5px; text-align: center;">Agua</th>
            <th style="padding: 0 5px 0 5px; text-align: center;">Drenaje</th>
            <th style="padding: 0 5px 0 5px; text-align: center;">Pavimento</th>
            <th style="padding: 0 5px 0 5px; text-align: center;">Energía eléctrica</th>
            <th style="padding: 0 5px 0 5px; text-align: center;">Alumbrado público</th>
            <th style="padding: 0 5px 0 5px; text-align: center;">Banqueta</th>
        </tr>

    </thead>

    <tbody>

        <tr>
            <td style="padding-right: 40px;">
                <p>Servicios municipales</p>
            </td>
            <td style="text-align: center;">
                <strong>{{ $predio->avaluo->agua ? 'Si' : 'No' }}</strong>
            </td>
            <td style="text-align: center;">
                <strong>{{ $predio->avaluo->drenaje ? 'Si' : 'No' }}</strong>
            </td>
            <td style="text-align: center;">
                <strong>{{ $predio->avaluo->drenaje ? 'Si' : 'No' }}</strong>
            </td>
            <td style="text-align: center;">
                <strong>{{ $predio->avaluo->energia_electrica ? 'Si' : 'No' }}</strong>
            </td>
            <td style="text-align: center;">
                <strong>{{ $predio->avaluo->alumbrado_publico ? 'Si' : 'No' }}</strong>
            </td>
            <td style="text-align: center;">
                <strong>{{ $predio->avaluo->banqueta ? 'Si' : 'No' }}</strong>
            </td>
        </tr>

    </tbody>

</table>

@foreach ($predio->avaluo->bloques as $bloque)

    <p class="separador">Bloque {{ $loop->iteration }}</p>

    Uso del bloque: <strong>{{ $bloque->uso }}</strong>

    <p style="text-align: center; margin-top: 20px;"><strong>Obra negra</strong></p>

    <p class="parrafo">

        <strong>Cimentación:</strong> {{ $bloque->cimentacion }};
        <strong>Estructura:</strong> {{ $bloque->estructura }};
        <strong>Muros:</strong> {{ $bloque->muros }};
        <strong>Entrepisos:</strong> {{ $bloque->entrepiso }};
        <strong>Techo:</strong> {{ $bloque->techo }};

    </p>

    <p style="text-align: center; margin-top: 20px;"><strong>Acabados</strong></p>

    <p class="parrafo">

        <strong>Plafones:</strong> {{ $bloque->plafones }};
        <strong>Vidriería:</strong> {{ $bloque->vidrieria }};
        <strong>Lambrines:</strong> {{ $bloque->lambrines }};
        <strong>Pisos:</strong> {{ $bloque->pisos }};
        <strong>Herrería:</strong> {{ $bloque->herreria }};
        <strong>Pintura:</strong> {{ $bloque->pintura }};
        <strong>Carpintería:</strong> {{ $bloque->carpinteria }};
        <strong>Aplanados:</strong> {{ $bloque->aplanados }};
        <strong>Recubrimientos:</strong> {{ $bloque->recubrimiento_especial }};

    </p>

    <p style="text-align: center; margin-top: 20px;"><strong>Instalaciones</strong></p>

    <p class="parrafo">

        <strong>Hidráulica:</strong> {{ $bloque->hidraulica }};
        <strong>Sanitaria:</strong> {{ $bloque->sanitaria }};
        <strong>Eléctrica:</strong> {{ $bloque->electrica }};
        <strong>Gas:</strong> {{ $bloque->gas }};
        <strong>Especiales:</strong> {{ $bloque->especiales }};

    </p>

@endforeach