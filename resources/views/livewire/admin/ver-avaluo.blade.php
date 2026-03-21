<div>

    @push('styles')

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @endpush

    <x-header>Avaluo</x-header>

    @include('admin.comun.datos_generales_avaluo')

    @include('admin.comun.datos_generales_predio')

    @include('admin.comun.ubicacion')

    @include('admin.comun.colindancias')

    @include('admin.comun.terrenos')

    @include('admin.comun.construcciones')

    @include('admin.comun.terrenos_comun')

    @include('admin.comun.construcciones_comun')

    @include('admin.comun.caracteristicas_avaluo')

    @include('admin.comun.propietarios')

    @include('admin.comun.imagenes_avaluo')

    @push('scripts')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @endpush

</div>