<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'password' => Hash::make('root')
        ]);
        
        $faker = Faker::create('es_ES');
        for ($i=0; $i < 10; $i++) {
            $email = $faker->email();
            User::create([
                'name' => $faker->name($gender = null),
                'email' => $email ,
                'password' => Hash::make($email)
            ]);
        }
    }
}
