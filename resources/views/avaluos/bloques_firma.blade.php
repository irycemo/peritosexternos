<p class="separador">Características</p>

<p class="parrafo">

    <p><strong>Clasificación de la zona:</strong> {{ $avaluo->clasificacion_zona }}</p>
    <p><strong>Tipo de construcción dominante:</strong> {{ $avaluo->construccion_dominante }}</p>

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
                {{ $avaluo->agua ? 'Si' : 'No' }}
            </td>
            <td style="text-align: center;">
                {{ $avaluo->drenaje ? 'Si' : 'No' }}
            </td>
            <td style="text-align: center;">
                {{ $avaluo->drenaje ? 'Si' : 'No' }}
            </td>
            <td style="text-align: center;">
                {{ $avaluo->energia_electrica ? 'Si' : 'No' }}
            </td>
            <td style="text-align: center;">
                {{ $avaluo->alumbrado_publico ? 'Si' : 'No' }}
            </td>
            <td style="text-align: center;">
                {{ $avaluo->banqueta ? 'Si' : 'No' }}
            </td>
        </tr>

    </tbody>

</table>

@foreach ($avaluo->bloques as $bloque)

    <p class="separador">Bloque {{ $loop->iteration }}</p>

    <strong>Uso del bloque:</strong> {{ $bloque->uso }}

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
        <strong>PiRecubrimientoos:</strong> {{ $bloque->recubrimiento_especial }};

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