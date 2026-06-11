<p class="separador">Superficies y valor catastral</p>

<table style="width: 100%">
    <tbody  >
        <tr style="text-align: left;">
            <td style="width: 50%;">

                superficie notarial: <strong>{{ $predio->superficie_notarial ?? 0 }} @if(isset($predio->tipo_predio) && $predio->tipo_predio == 2) Hectareas @else Metros cuadrados @endif</strong>

            </td>
            <td style="width: 50%;">

                superficie judicial: <strong>{{ $predio->superficie_judicial ?? 0 }} @if(isset($predio->tipo_predio) && $predio->tipo_predio == 2) Hectareas @else Metros cuadrados @endif</strong>

            </td>
        </tr>
    </tbody>

</table>

<table style="width: 100%">

    <tbody>
        <tr style="text-align: left;">
            <td style="width: 50%;">

                Superficie total de terreno: <strong>{{ $predio->superficie_total_terreno ?? 0 }} @if(isset($predio->tipo_predio) && $predio->tipo_predio == 2) Hectareas @else Metros cuadrados @endif</strong>

            </td>
            <td style="width: 50%;">

                Superficie total de construcción: <strong>{{ $predio->superficie_total_construccion ?? 0 }} Metros cuadrados</strong>

            </td>
        </tr>
    </tbody>

</table>

@if(isset($predio->terrenosComun) && count($predio->terrenosComun) || isset($predio->construccionesComun) && count($predio->construccionesComun))

    <table style="width: 100%">

        <tbody>
            <tr style="text-align: left;">
                <td style="width: 50%;">

                    @if(isset($predio->terrenosComun))

                        Superficie privativa de terreno: <strong>{{ collect($predio->terrenos)->sum('superficie') }}  Metros cuadrados</strong>

                    @else

                        Superficie privativa de terreno: <strong>0  Metros cuadrados</strong>

                    @endif

                </td>
                <td style="width: 50%;">

                    @if(isset($predio->terrenosComun))

                        Superficie privativa de construccion: <strong>{{ collect($predio->construcciones)->sum('superficie') }}  Metros cuadrados</strong>

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

                    @if(isset($predio->terrenosComun))

                        Superficie proporcional de terreno: <strong>{{ collect($predio->terrenosComun)->sum('superficie_proporcional') }}  Metros cuadrados</p>

                    @else

                        Superficie proporcional de terreno: <strong>0  Metros cuadrados</strong>

                    @endif

                </td>
                <td style="width: 50%;">

                    @if(isset($predio->terrenosComun))

                        Superficie proporcional de construccion: <strong>{{ collect($predio->construccionesComun)->sum('superficie_proporcional') }}  Metros cuadrados</strong>

                    @else

                        Superficie proporcional de construccion: <strong>0  Metros cuadrados</strong>

                    @endif

                </td>
            </tr>
        </tbody>

    </table>

@endif

<p class="parrafo">
    Valor catastral: <strong>${{ number_format($predio->valor_catastral, 2) }}</strong>
</p>
