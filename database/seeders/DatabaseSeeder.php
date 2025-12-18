<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '082232313626',
            'role' => 'admin',
            'verify' => '1',
            'password' => bcrypt('password')
        ]);

        User::create([
            'name' => 'Petugas1',
            'email' => 'petugas1@gmail.com',
            'phone' => '087655456783',
            'role' => 'petugas',
            'verify' => '1',
            'password' => bcrypt('petugas1')
        ]);



        
    }
}
