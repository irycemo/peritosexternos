<p class="separador">Superficies y valor catastral</p>

<p class="parrafo">

    <strong>Superficie de terreno total:</strong>  {{ $avaluo->predio->superficie_total_terreno }} @if($avaluo->predio->tipo_predio == 1) Metros cuadrados; @else Hectáreas; @endif

    @if ($avaluo->predio->superficie_construccion)

        <strong>Superficie de construcción total:</strong> {{ $avaluo->predio->superficie_total_construccion }} @if($avaluo->predio->tipo_predio == 1) Metros cuadrados; @else Hectáreas; @endif

    @endif

    @if ($avaluo->predio->superficie_judicial)
        <strong>superficie judicial:</strong>  {{ $avaluo->predio->superficie_judicial }};
    @endif

    @if ($avaluo->predio->superficie_notarial)
        <strong>superficie notarial:</strong> {{ $avaluo->predio->superficie_notarial }};
    @endif

</p>

<p>

    @if ($avaluo->predio->valor_total_terreno)
        <strong>valor total de terreno:</strong> ${{ number_format($avaluo->predio->valor_total_terreno, 2) }};
    @endif

    @if ($avaluo->predio->valor_total_construccion)
        <strong>valor total de construcción:</strong> ${{ number_format($avaluo->predio->valor_total_construccion, 2) }};
    @endif

    @if($avaluo->predio->ubicacion_en_manzana == 'ESQUINA')

        <strong>Ubicación en esquina:</strong> ${{ number_format(($avaluo->predio->valor_total_terreno + $avaluo->predio->valor_total_construccion) * 0.15, 2) }}

    @endif

</p>

<p class="parrafo">
    <strong>Valor catastral: </strong>${{ number_format($avaluo->predio->valor_catastral, 2) }}
</p>
