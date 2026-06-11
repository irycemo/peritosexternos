<p class="separador">Superficies y valor catastral</p>

<table style="width: 100%">
    <tbody  >
        <tr style="text-align: left;">
            <td style="width: 50%;">

                superficie notarial: <strong>{{ $avaluo->predio->superficie_notarial ?? 0 }} @if(isset($avaluo->predio->tipo_predio) && $avaluo->predio->tipo_predio == 2) Hectareas @else Metros cuadrados @endif</strong>

            </td>
            <td style="width: 50%;">

                superficie judicial: <strong>{{ $avaluo->predio->superficie_judicial ?? 0 }} @if(isset($avaluo->predio->tipo_predio) && $avaluo->predio->tipo_predio == 2) Hectareas @else Metros cuadrados @endif</strong>

            </td>
        </tr>
    </tbody>

</table>

<table style="width: 100%">

    <tbody>
        <tr style="text-align: left;">
            <td style="width: 50%;">

                Superficie total de terreno: <strong>{{ $avaluo->predio->superficie_total_terreno ?? 0 }} @if(isset($avaluo->predio->tipo_predio) && $avaluo->predio->tipo_predio == 2) Hectareas @else Metros cuadrados @endif</strong>

            </td>
            <td style="width: 50%;">

                Superficie total de construcción: <strong>{{ $avaluo->predio->superficie_total_construccion ?? 0 }} Metros cuadrados</strong>

            </td>
        </tr>
    </tbody>

</table>

@if(isset($avaluo->predio->terrenosComun) && count($avaluo->predio->terrenosComun) || isset($avaluo->predio->construccionesComun) && count($avaluo->predio->construccionesComun))

    <table style="width: 100%">

        <tbody>
            <tr style="text-align: left;">
                <td style="width: 50%;">

                    @if(isset($avaluo->predio->terrenosComun))

                        Superficie privativa de terreno: <strong>{{ collect($avaluo->predio->terrenos)->sum('superficie') }}  Metros cuadrados</strong>

                    @else

                        Superficie privativa de terreno: <strong>0  Metros cuadrados</strong>

                    @endif

                </td>
                <td style="width: 50%;">

                    @if(isset($avaluo->predio->terrenosComun))

                        Superficie privativa de construccion: <strong>{{ collect($avaluo->predio->construcciones)->sum('superficie') }}  Metros cuadrados</strong>

                    @else

                        Superficie proporcional de construccion: <strong>0  Metros cuadrados</strong>


                    @endif

                </td>
            </tr>
        </tbody>

    </table>

    <table style="width: 100%">

        <tbody>
            <tr style="text-align: left;">
                <td style="width: 50%;">

                    @if(isset($avaluo->predio->terrenosComun))

                        Superficie proporcional de terreno: <strong>{{ collect($avaluo->predio->terrenosComun)->sum('superficie_proporcional') }}  Metros cuadrados</p>

                    @else

                        Superficie proporcional de terreno: <strong>0  Metros cuadrados</strong>

                    @endif

                </td>
                <td style="width: 50%;">

                    @if(isset($avaluo->predio->terrenosComun))

                        Superficie proporcional de construccion: <strong>{{ collect($avaluo->predio->construccionesComun)->sum('superficie_proporcional') }}  Metros cuadrados</strong>

                    @else

                        Superficie proporcional de construccion: <strong>0  Metros cuadrados</strong>

                    @endif

                </td>
            </tr>
        </tbody>

    </table>

@endif

<p class="parrafo">
    Valor catastral: <strong>${{ number_format($avaluo->predio->valor_catastral, 2) }}</strong>
</p>