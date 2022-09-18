<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        $user = User::create([
            'name' => 'Alkhair',
            'email' => 'super_admin@app.com',
            'password' => bcrypt('12341234'),

        ]);
    }
}
