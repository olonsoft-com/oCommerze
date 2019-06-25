<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
        	'name' => 'Admin',
        	'email' => 'admin@gmail.com',
        	'password' => Hash::make('123456789'),
        	'status' => 1
        ]);
        $role = Role::where('name', 'super_admin')->first();
        $user->assignRole($role);

        // create 1000 users with just one line by Factory Model
        factory(User::class, 1000)->create()->each( function( $u ) {
            $u->assignRole('customer');
        });
    }
}
