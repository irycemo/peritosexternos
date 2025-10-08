@extends('layouts.admin')

@section('content')

    <div class=" mb-10">

        <h2 class="text-2xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500  mb-6  bg-white">Estadísticas de avalúos</h2>

        @livewire('dashboard.estadisticas', ['lazy' => true])

    </div>

@endsection
