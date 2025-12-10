@extends('layouts.admin')

@section('content')

    <div class=" mb-10">

        <h2 class="text-2xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500  mb-6  bg-white">Estadísticas de avalúos</h2>

        @livewire('dashboard.estadisticas', ['lazy' => true])

    </div>

    <x-header class="mt-5">Nuevas preguntas frecuentes</x-header>

    <div class="bg-white shadow-xl rounded-lg p-4 mt-5" wire:loading.class.delaylongest="opacity-50">

        <div class="w-full lg:w-1/2 mx-auto ">

            <ul class="w-full space-y-3">

                @foreach ($preguntas as $item)

                    <li class="cursor-pointer hover:bg-gray-100 rounded-lg text-gray-700 border border-gray-300 flex justify-between">

                        <a href="{{ route('preguntas_frecuentes') . '?search=' . $item->titulo }}" class="w-full h-full p-3 flex justify-between items-center">

                            <span>{{ $item->titulo }}</span>

                        </a>

                    </li>

                @endforeach

                <li class="cursor-pointer bg-gray-200 rounded-lg text-gray-700 border border-gray-400 flex justify-between ">

                    <a href="{{ route('preguntas_frecuentes') }}" class="w-full h-full p-1 flex justify-center items-center text-gray-700">

                       Ver mas

                    </a>

                </li>

            </ul>

        </div>

    </div>

@endsection

@push('scripts')
<script >
    function obtenerIPLocal(callback) {
        let ips = new Set();

        // RTCPeerConnection cross-browser
        let pc = new RTCPeerConnection({
            iceServers: []
        });

        // Crea un canal vacío para iniciar el proceso ICE
        pc.createDataChannel("");

        pc.onicecandidate = (e) => {
            if (!e.candidate) {
                // No hay más candidatos
                callback([...ips]);
                return;
            }

            let candidate = e.candidate.candidate;
            let partes = candidate.split(" ");

            // La IP normalmente está en la posición 4
            let ip = partes[4];

            // Filtrar IPs válidas
            if (ip && ip !== "0.0.0.0") {
                ips.add(ip);
            }
        };

        pc.createOffer().then((oferta) => pc.setLocalDescription(oferta));
    }

    obtenerIPLocal(function(ips) {
        console.log("IPs detectadas:", ips);

        // Si quieres enviar la IP a Laravel vía AJAX:
        fetch("/registrar-ip", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ ips })
        });
    });


</script>


@endpush