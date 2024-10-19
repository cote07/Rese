<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'create shop']);
        Permission::create(['name' => 'view reservation']);
        Permission::create(['name' => 'create owner']);
        Permission::create(['name' => 'view content']);

        $adminRole = Role::create(['name' => 'admin']);
        $ownerRole = Role::create(['name' => 'owner']);
        $userRole = Role::create(['name' => 'user']);

        $adminRole->givePermissionTo('create owner');
        $ownerRole->givePermissionTo(['create shop', 'view reservation']);
        $userRole->givePermissionTo('view content');

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password')
        ]);
        $admin->assignRole('admin');

        $owner = User::create([
            'name' => ' owner1',
            'email' => 'owner1@example.com',
            'password' => bcrypt('password')
        ]);
        $owner->assignRole('owner');

        $owner = User::create([
            'name' => ' owner2',
            'email' => 'owner2@example.com',
            'password' => bcrypt('password')
        ]);
        $owner->assignRole('owner');

        $owner = User::create([
            'name' => ' owner3',
            'email' => 'owner3@example.com',
            'password' => bcrypt('password')
        ]);
        $owner->assignRole('owner');

        $owner = User::create([
            'name' => ' owner4',
            'email' => 'owner4@example.com',
            'password' => bcrypt('password')
        ]);
        $owner->assignRole('owner');

        $owner = User::create([
            'name' => ' owner5',
            'email' => 'owner5@example.com',
            'password' => bcrypt('password')
        ]);
        $owner->assignRole('owner');

        $user = User::create([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => bcrypt('password')
        ]);
        $user->assignRole('user');
    }
}
