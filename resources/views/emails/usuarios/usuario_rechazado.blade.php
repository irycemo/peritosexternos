<x-mail::message>

<p>{{ $user->name }}</p>

<p>Se le informa que ha sido rechazada(o) en el Sistema de Peritos Externos.</p>
<p>Motivo:</p>
<p> {{ $observaciones }}</p>

<x-mail::button :url="$url">
Ir al Sistema de Peritos Externos
</x-mail::button>

Favor de no contestar a este correo<br>
{{ config('app.name') }}<br>
Instituto Registral y Catastral de Michoacán de Ocampo<br>
Gobierno del Estado de Michoacán
</x-mail::message>