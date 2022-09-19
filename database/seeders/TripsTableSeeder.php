<?php

namespace Database\Seeders;

use App\Modules\Trips\Models\Trip;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TripsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Trip::truncate();

        Trip::factory()->create([
            'user_id' => 1,
            'car_id' => 1,
            'date' => Carbon::now(),
            'miles' => 11.3,
        ]);

        Trip::factory()->create([
            'user_id' => 1,
            'car_id' => 2,
            'date' => Carbon::now()->subDay()->subHour(),
            'miles' => 12.0,
        ]);
    }
}
