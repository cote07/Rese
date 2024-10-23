<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Reservation;


class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::where('id', '>=', 7)->each(function ($user) {
            Reservation::factory(2)->create(['user_id' => $user->id]);
        });
    }

    protected function generateTimes()
    {
        $times = [];
        $start = strtotime('09:00');
        $end = strtotime('21:00');

        while ($start <= $end) {
            $times[] = date('H:i', $start);
            $start = strtotime('+30 minutes', $start);
        }

        return $times;
    }
}
