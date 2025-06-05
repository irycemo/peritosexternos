@if(isset($predio->avaluo->folio))

    <div class="space-y-2 mb-5 bg-white rounded-lg p-2 text-right shadow-xl">

        <span class="bg-blue-400 text-white text-sm rounded-full px-2 py-1">Avalúo: {{ $predio->avaluo->año }}-{{ $predio->avaluo->folio }}-{{ $predio->avaluo->usuario }} / Predio: {{ $predio->cuentaPredial() }}</span>

    </div>

@endif