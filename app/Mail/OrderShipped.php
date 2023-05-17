<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
// вставка ниже:
// use Illuminate\Mail\Mailables\Attachment;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Order Confirmed',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.shipped',
            with: [
                'ID' => $this->order->id,
                'name' => $this->order->user->name,
                // 'persons' => $this->order->user->count,
            ],
        );
    }

    //ВМЕСТО ВЕРХНЕГО АБЗАЦА ВСТАВЛЯЕМ НИЖНИЙ:
    /**
     * Get the attachments for the message.
     *
     * @return array
     */

    //  /**
    //  * Get the attachments for the message.
    //  *
    //  * @return \Illuminate\Mail\Mailables\Attachment[]
    //  */

    public function attachments()
    {
        return [];

        // return [
        //     Attachment::fromData(fn () => $this->pdf, 'Hotel.pdf')
        //         ->withMime('application/pdf'),
        // ];

        // return [
        //     Attachment::fromStorage('/path/to/file')
        //         ->as('hotel.pdf')
        //         ->withMime('application/pdf'),
        // ];
    }
}