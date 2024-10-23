<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Favorite;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::where('id', '>=', 7)->each(function ($user) {
            Favorite::factory(5)->create(['user_id' => $user->id]);
        });
    }
}
