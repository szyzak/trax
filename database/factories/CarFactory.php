<?php

namespace Database\Factories;

use App\Modules\Cars\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class CarFactory extends Factory
{
    protected $model = Car::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'year' => $this->faker->year(),
            'make' => $this->faker->word,
            'model' => $this->faker->word,
        ];
    }
}
