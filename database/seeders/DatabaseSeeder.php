<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create();
        auth()->login($user);
        $this->call(CarsTableSeeder::class);
        $this->call(TripsTableSeeder::class);
    }
}
