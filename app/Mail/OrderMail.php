<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = $this->data;
        $companyEmail = env('MAIL_FROM_ADDRESS');
        $emailSubject = 'Order Confirmation Email from '.env('APP_NAME');
        return $this->from($companyEmail)
            ->view('mail.order_mail', compact('order'))
            ->subject($emailSubject);
    }
}
