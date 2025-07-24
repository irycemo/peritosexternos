@extends('layouts.admin')

@section('content')

    <x-header>Valuación</x-header>

    <div class="tab-wrapper" x-data="{ activeTab:  0 }">

        <div class="flex py-4 space-x-4 items-center border-b-2 border-gray-500 mb-6 flex-wrap justify-center">

            <label
                @click="activeTab = 0"
                class="px-6 py-1 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-3 cursor-pointer bg-white"
                :class="{'active  bg-gray-200 rounded-full px-3 py-1 text-gray-500 no-underline': activeTab === 0 }"
            >Datos de identificación del inmueble
            </label>

            <label
                @click="activeTab = 5"
                class="px-6 py-1 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-3 cursor-pointer bg-white"
                :class="{'active  bg-gray-200 rounded-full px-3 py-1 text-gray-500 no-underline': activeTab === 5 }"
            >Propietarios
            </label>

            <label
                @click="activeTab = 1"
                class="px-6 py-1 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-3 cursor-pointer bg-white"
                :class="{'active  bg-gray-200 rounded-full px-3 py-1 text-gray-500 no-underline': activeTab === 1 }"
            >Colindancias
            </label>

            <label
                @click="activeTab = 2"
                class="px-6 py-1 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-3 cursor-pointer bg-white"
                :class="{'active  bg-gray-200 rounded-full px-3 py-1 text-gray-500 no-underline': activeTab === 2 }"
            >Características
            </label>

            <label
                @click="activeTab = 3"
                class="px-6 py-1 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-3 cursor-pointer bg-white"
                :class="{'active  bg-gray-200 rounded-full px-3 py-1 text-gray-500 no-underline': activeTab === 3 }"
            >Determinación de valor catastral
            </label>

            <label
                @click="activeTab = 4"
                class="px-6 py-1 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-3 cursor-pointer bg-white"
                :class="{'active  bg-gray-200 rounded-full px-3 py-1 text-gray-500 no-underline': activeTab === 4 }"
            >Imágenes y observaciones
            </label>

        </div>

        <div class="tab-panel" :class="{ 'active': activeTab === 0 }" x-show.transition.in.opacity.duration.800="activeTab === 0">

            @livewire('valuacion.valuacion', ['avaluo_id' => $id])

        </div>

        <div class="tab-panel" :class="{ 'active': activeTab === 5 }" x-show.transition.in.opacity.duration.800="activeTab === 5">

            @livewire('valuacion.propietarios', ['avaluo_id' => $id])

        </div>

        <div class="tab-panel" :class="{ 'active': activeTab === 1 }" x-show.transition.in.opacity.duration.800="activeTab === 1" x-cloak>

            @livewire('valuacion.colindancias', ['avaluo_id' => $id])

        </div>

        <div class="tab-panel" :class="{ 'active': activeTab === 2 }" x-show.transition.in.opacity.duration.800="activeTab === 2" x-cloak>

            @livewire('valuacion.caracteristicas', ['avaluo_id' => $id])

        </div>

        <div class="tab-panel" :class="{ 'active': activeTab === 3 }" x-show.transition.in.opacity.duration.800="activeTab === 3" x-cloak>

            @livewire('valuacion.valor', ['avaluo_id' => $id])

        </div>

        <div class="tab-panel" :class="{ 'active': activeTab === 4 }" x-show.transition.in.opacity.duration.800="activeTab === 4" x-cloak>

            @livewire('valuacion.imagenes', ['avaluo_id' => $id])

        </div>

    </div>

@endsection