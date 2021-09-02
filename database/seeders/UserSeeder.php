<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'Juan Carlos',
                'lastname' => 'Rosales Yucra',
                'email' => 'tacticacbba@icloud.com',
                'password' => bcrypt('password')
            ],
        );
    }
}
