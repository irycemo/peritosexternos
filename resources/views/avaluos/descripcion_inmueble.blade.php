<p class="separador">Superficies y valor catastral</p>

<p class="parrafo">

    <strong>Superficie de terreno total:</strong>  {{ $predio->superficie_total_terreno }} Metros cuadrados

    @if ($predio->superficie_construccion)

        <strong>Superficie de construcción total:</strong> {{ $predio->superficie_total_construccion }} Metros cuadrados

    @endif

    @if ($predio->superficie_judicial)
        <strong>superficie judicial:</strong>  {{ $predio->superficie_judicial }};
    @endif

    @if ($predio->superficie_notarial)
        <strong>superficie notarial:</strong> {{ $predio->superficie_notarial }};
    @endif

</p>

<p>

    @if ($predio->valor_total_terreno)
        <strong>valor total de terreno:</strong> ${{ number_format($predio->valor_total_terreno, 2) }};
    @endif

    @if ($predio->valor_total_construccion)
        <strong>valor total de construcción:</strong> ${{ number_format($predio->valor_total_construccion, 2) }};
    @endif

    @if($predio->ubicacion_en_manzana == 'ESQUINA')

        <strong>Ubicación en esquina:</strong> ${{ number_format(($predio->valor_total_terreno + $predio->valor_total_construccion) * 0.15, 2) }}

    @endif

</p>

<p class="parrafo">
    <strong>Valor catastral: </strong>${{ number_format($predio->valor_catastral, 2) }}
</p>
