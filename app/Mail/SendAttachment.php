<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendAttachment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $pdf;

    public function __construct($pdf)
    {
        //
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.test')
            ->attach(public_path('images/marketplace/proposal/pdf/'.$this->pdf), [
                'as' => 'test.pdf',
                'mime' => 'application/pdf',
        ]);
    }
}
