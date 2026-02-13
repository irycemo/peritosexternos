<x-mail::message>

<p><strong>Ha solicitado un nuevo trámite catastral</strong></p>

Folio del trámite: {{ $data['tramite'] }}<br>
Servicio: {{ $data['servicio'] }}<br>
Cantidad: {{ $data['cantidad'] }}<br>
Solicitante: {{ $data['solicitante'] }}, {{ $data['nombre_solicitante'] }}<br>
Fecha de vencimiento: {{ $data['fecha_vencimiento'] }}<br>
Línea de captura: {{ $data['linea_de_captura'] }}<br>
Monto: ${{ number_format($data['monto'], 2) }}<br>
Fecha de creación: {{ $data['created_at'] }}<br>

<p>La orden de pago de este trámite se ha adjuntado a este correo.</p>

Favor de no contestar a este correo<br>
{{ config('app.name') }}<br>
Instituto Registral y Catastral de Michoacán de Ocampo<br>
Gobierno del Estado de Michoacán
</x-mail::message>
