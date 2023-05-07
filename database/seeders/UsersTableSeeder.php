<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'root@root.es',
            'password' => ''
        ]);
        
        $faker = Faker::create('es_ES');
        for ($i=0; $i < 10; $i++) { 
            User::create([
                'name' => $faker->name($gender = null),
                'email' => $faker->email(),
                'password' => ''
            ]);
        }
    }
}
