<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class notificationOrderAdmin extends Mailable
{
    use Queueable, SerializesModels;

    private $order;
    private $data_insert;
    private $user;
    private $user_address;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $data_insert, $user)
    {
        $this->order = $order;
        $this->data_insert = $data_insert;
        $this->user = $user;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('[Chú ý] - Đơn hàng mới từ '.env('APP_NAME', 'Toshiko'))->view('Default::mail.notification_order_admin',[
            'order'=>$this->order, 'data_insert'=>$this->data_insert, 'user'=>$this->user
        ]);
    }
}

