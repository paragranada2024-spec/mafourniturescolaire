<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Find the first user in the database.
        // This is a common way to quickly set up a test admin account.
        $user = User::find(1);

        // Find the 'admin' role.
        $adminRole = Role::where('name', 'admin')->first();

        // If both the user and the role exist, attach the role to the user.
        if ($user && $adminRole) {
            $user->roles()->syncWithoutDetaching([$adminRole->id]);
        }
    }
}
