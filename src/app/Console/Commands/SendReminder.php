<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\ReminderMail;

class SendReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:send';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Send reservation reminders for the day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today();
        $reservations = Reservation::whereDate('date', $today)->get();

        foreach ($reservations as $reservation) {

            $user = $reservation->user;
            $shop = $reservation->shop;
            $email = $user->email;

            Mail::to($email)->send(new ReminderMail($reservation, $user, $shop));
        }
    }
}
