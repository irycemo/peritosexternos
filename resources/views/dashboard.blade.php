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
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>

<script >

window.RTCPeerConnection = window.RTCPeerConnection ||
                             window.mozRTCPeerConnection ||
                             window.webkitRTCPeerConnection;

  function getMyIP () {
    // Calls the cb function with the local host IP address found
    // using RTC functions. We cannot just return the IP address
    // because the RTC functions are asynchronous.

    var pc = new RTCPeerConnection ({iceServers: []}),
        noop = () => {};

    pc.onicecandidate = ice =>
      console.log(ice.candidate.candidate)
    pc.createDataChannel ("");
    pc.createOffer (pc.setLocalDescription.bind (pc), noop);
  };

  getMyIP ();

</script>


@endpush