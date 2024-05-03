<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminContactSuccess extends Mailable
{
    use Queueable, SerializesModels;

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
     *    {

     * @return $this
     */
    public function build() {
        return $this->from('no-reply@sudospaces.com') 
            ->subject('Toshiko - Thông báo có yêu cầu tư vấn mới !')
            ->view('Default::mail.contact', [
                'data' => $this->data,
            ]);
    }
}
