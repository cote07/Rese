<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Shop;

class ReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $user;
    public $shop;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reservation $reservation, User $user, Shop $shop)
    {
        $this->reservation = $reservation;
        $this->user = $user;
        $this->shop = $shop;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('reminder')
            ->subject('Reservation Reminder')
            ->with([
                'reservation' => $this->reservation,
                'user' => $this->user,
                'shop' => $this->shop
            ]);
    }
}