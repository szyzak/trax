<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local')) {
            $user = User::factory()->create([
                'email' => 'test@example.com',
                'password' => 'qwerty'
            ]);
            auth()->login($user);

            $this->call(CarsTableSeeder::class);
            $this->call(TripsTableSeeder::class);
        }
    }
}
