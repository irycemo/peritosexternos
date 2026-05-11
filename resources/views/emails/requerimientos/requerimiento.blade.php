<x-mail::message>
<p><strong>Requerimiento</strong></p>

<p>Se ha hecho un requerimiento sobre el avalúo: {{ $avaluo->año }}-{{ $avaluo->folio }}-{{ $avaluo->usuario }}</p>

<p>{{ $descripcion }}</p>

Favor de no contestar a este correo<br>
{{ config('app.name') }}<br>
Instituto Registral y Catastral de Michoacán de Ocampo<br>
Gobierno del Estado de Michoacán
</x-mail::message>
