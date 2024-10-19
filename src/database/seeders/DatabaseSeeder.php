<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(ShopsTableSeeder::class);
        $this->call(FavoritesTableSeeder::class);
        $this->call(ReservationsTableSeeder::class);
        $this->call(OwnersTableSeeder::class);
    }
}
