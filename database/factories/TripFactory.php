<?php

namespace Database\Factories;

use App\Modules\Trips\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class TripFactory extends Factory
{
    protected $model = Trip::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'car_id' => 1,
            'date' => $this->faker->date(),
            'miles' => $this->faker->randomFloat(),
        ];
    }
}
