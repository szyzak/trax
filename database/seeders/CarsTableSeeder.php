<?php

namespace Database\Seeders;

use App\Modules\Cars\Models\Car;
use Illuminate\Database\Seeder;

class CarsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Car::truncate();

        Car::factory()->create([
            'make' => 'Land Rover',
            'model' => 'Range Rover Sport',
            'year' => 2017,
        ]);

        Car::factory()->create([
            'make' => 'Ford',
            'model' => 'F150',
            'year' => '2017',
        ]);

        Car::factory()->create([
            'make' => 'Land Rover',
            'model' => 'Range Rover Sport',
            'year' => 2014,
        ]);

        Car::factory()->create([
            'make' => 'Chevy',
            'model' => 'Tahoe',
            'year' => 2015,
        ]);

        Car::factory()->create([
            'make' => 'Aston Martin',
            'model' => 'Vanquish',
            'year' => 2018,
        ]);

        Car::factory()->times(3)->create();
    }
}
