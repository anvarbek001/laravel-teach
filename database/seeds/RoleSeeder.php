<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
        ]);
        Role::create([
            'name' => 'editon',
        ]);
        Role::create([
            'name' => 'blogger',
        ]);
        Role::create([
            'name' => 'seller',
        ]);
    }
}
