<x-h4>Imágenes</x-h4>

<div class="bg-white p-4 rounded-lg w-full shadow-lg mb-5 text-sm">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Fachada</strong>

            <a href="{{ $avaluo->fachada() }}" data-lightbox="imagen" data-title="Fachada">
                <img class="h-20 w-20 mx-auto my-3" src="{{ $avaluo->fachada() }}" alt="Fachada">
            </a>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Foto</strong>

            <a href="{{ $avaluo->foto2() }}" data-lightbox="imagen" data-title="Foto 2">
                <img class="h-20 w-20 mx-auto my-3" src="{{ $avaluo->foto2() }}" alt="Foto 2">
            </a>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Foto</strong>

            <a href="{{ $avaluo->foto3() }}" data-lightbox="imagen" data-title="Foto 3">
                <img class="h-20 w-20 mx-auto my-3" src="{{ $avaluo->foto3() }}" alt="Foto 3">
            </a>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Foto</strong>

            <a href="{{ $avaluo->foto4() }}" data-lightbox="imagen" data-title="Foto 4">
                <img class="h-20 w-20 mx-auto my-3" src="{{ $avaluo->foto4() }}" alt="Foto 4">
            </a>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Macrolocalización</strong>

            <a href="{{ $avaluo->macrolocalizacion() }}" data-lightbox="imagen" data-title="Macrolocalización">
                <img class="h-20 w-20 mx-auto my-3" src="{{ $avaluo->macrolocalizacion() }}" alt="Macrolocalización">
            </a>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Microlocalización</strong>

            <a href="{{ $avaluo->microlocalizacion() }}" data-lightbox="imagen" data-title="Microlocalización">
                <img class="h-20 w-20 mx-auto my-3" src="{{ $avaluo->microlocalizacion() }}" alt="Microlocalización">
            </a>

        </div>

        <div class="rounded-lg bg-gray-100 py-1 px-2">

            <strong>Imágen del poligono</strong>

            <a href="{{ $avaluo->poligonoImagen() }}" data-lightbox="imagen" data-title="Imágen del poligono">
                <img class="h-20 w-20 mx-auto my-3" src="{{ $avaluo->poligonoImagen() }}" alt="Imágen del poligono">
            </a>

        </div>


    </div>

</div>