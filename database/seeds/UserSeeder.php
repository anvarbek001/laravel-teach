<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::updateOrCreate(
            ['email' => 'jhon@gmail.com'], // Unikal shart
            [
                'name' => 'jhonDoe',
                'password' => Hash::make('secret'),
            ]
        );

        $user->roles()->attach([1,3]);


        $user2 = User::updateOrCreate(
            ['email' => 'umar@gmail.com'], // Unikal shart
            [
                'name' => 'umarDoe',
                'password' => Hash::make('secret'),
            ]
        );

        $user2->roles()->attach([2]);

        // $users = factory(App\User::class, 10)->create();
    }
}
