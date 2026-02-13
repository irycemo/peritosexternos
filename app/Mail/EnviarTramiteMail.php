<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnviarTramiteMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public string $titulo, public array $tramite)
    {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->titulo,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        $data = [
            'tramite' => $this->tramite['data']['año'] . '-'. $this->tramite['data']['folio'] . '-' . $this->tramite['data']['usuario'],
            'servicio' => $this->tramite['data']['servicio'],
            'solicitante' => $this->tramite['data']['solicitante'],
            'nombre_solicitante' => $this->tramite['data']['nombre_solicitante'],
            'fecha_vencimiento' => $this->tramite['data']['fecha_vencimiento'],
            'linea_de_captura' => $this->tramite['data']['linea_de_captura'],
            'monto' => $this->tramite['data']['monto'],
            'created_at' => $this->tramite['data']['created_at'],
            'cantidad' => $this->tramite['data']['cantidad'],
        ];

        return new Content(
            markdown: 'emails.tramites.orden',
            with: [
                'data' => $data
            ]
        );

    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {

        $pdf = base64_decode($this->tramite['pdf']);

        return [
            Attachment::fromData(fn () => $pdf, 'order_de_pago.pdf')->withMime('application/pdf'),
        ];

    }
}
