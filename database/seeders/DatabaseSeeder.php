<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Faker\Factory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\ObatSeeder;
use Database\Seeders\TransactionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $faker = Factory::create();
        for ($i=1; $i <= 3; $i++) { 
            User::create([
                'name' => $faker->name(),
                'username' => $faker->name(),
                'alamat' => $faker->address(),
                'image' => $faker->imageUrl(),
                'password' => bcrypt('password'),
            ]);
        }
        
        User::create([
            'name' => 'jamal',
            'username' => 'jamal',
            'alamat' => 'Bandung',
            'image' => $faker->imageUrl(),
            'password' => bcrypt('password'),
        ]);

        $this->call([
            ObatSeeder::class,
            TransactionSeeder::class,
        ]);
    }
}
