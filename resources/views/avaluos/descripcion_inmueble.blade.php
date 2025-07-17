<p class="separador">Superficies y valor catastral</p>

<p class="parrafo">

    <strong>Superficie de terreno total:</strong>  {{ $predio->superficie_terreno + $predio->area_comun_terreno}}

    @if ($predio->superficie_construccion)

        <strong>Superficie de construcción total:</strong> {{ $predio->superficie_construccion + $predio->area_comun_construccion }} Metros cuadrados

    @endif

    @if ($predio->superficie_judicial)
        <strong>superficie judicial:</strong>  {{ $predio->superficie_judicial }};
    @endif

    @if ($predio->superficie_notarial)
        <strong>superficie notarial:</strong> {{ $predio->superficie_notarial }};
    @endif

    @if ($predio->valor_total_terreno)
        <strong>valor total de terreno:</strong> {{ number_format($predio->valor_total_terreno + $predio->valor_terreno_comun, 2) }};
    @endif

    @if ($predio->valor_total_construccion)
        <strong>valor total de construcción:</strong> {{ number_format($predio->valor_total_construccion + $predio->valor_construccion_comun, 2) }};
    @endif

</p>

<p class="parrafo">
    <strong>Valor catastral: </strong>${{ number_format($predio->valor_catastral, 2) }}
</p>
