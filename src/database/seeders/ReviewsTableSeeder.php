<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Reservation;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reservation::all()->each(function ($reservation) {
            Review::factory()->create([
                'user_id' => $reservation->user_id,
                'shop_id' => $reservation->shop_id,
                'reservation_id' => $reservation->id,
            ]);
        });
    }
}
