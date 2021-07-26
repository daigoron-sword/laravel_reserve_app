<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\MyClasses\Type\TypeView;

class ConfirmMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $reservation_dt;
    protected $number_of_user_dt;
    public function __construct($reservation_dt, $number_of_user_dt)
    {
        $this->reservation_dt = $reservation_dt;
        $this->number_of_user_dt = $number_of_user_dt;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $i = new TypeView();
        $type_dt = $i->price_mail_form($this->reservation_dt, $this->number_of_user_dt);
        return $this->subject('ご予約ありがとうございます（テスト）')
            ->from('dsr.daichi@gmail.com')
            ->text('mail/confirm')
            ->with(['reservation_dt' => $this->reservation_dt,
                    'number_of_user_dt' => $this->number_of_user_dt,
                    'type_dt' => $type_dt
            ]);
    }
}
