<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class OwnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner1 = User::where('email', 'owner1@example.com')->first();
        $owner1->ownedShops()->attach([1, 2, 3, 4]);

        $owner2 = User::where('email', 'owner2@example.com')->first();
        $owner2->ownedShops()->attach([5, 6, 7, 8]);

        $owner3 = User::where('email', 'owner3@example.com')->first();
        $owner3->ownedShops()->attach([9, 10, 11, 12]);

        $owner4 = User::where('email', 'owner4@example.com')->first();
        $owner4->ownedShops()->attach([13, 14, 15, 16]);

        $owner5 = User::where('email', 'owner5@example.com')->first();
        $owner5->ownedShops()->attach([17, 18, 19, 20]);
    }
}
