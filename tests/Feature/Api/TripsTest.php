<?php

namespace Tests\Feature\Api;

use App\Modules\Cars\Models\Car;
use App\Modules\Trips\Models\Trip;
use Tests\ApiTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TripsTest extends ApiTestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_indexes_trips()
    {
        // Arrange
        $this->login();
        $car = Car::factory()->create();
        [$tripOne, $tripTwo, $tripThree] = Trip::factory()->times(3)
            ->sequence(
                ['date' => now()->subDays(3), 'car_id' => $car->id],
                ['date' => now()->subDays(2), 'car_id' => $car->id],
                ['date' => now()->subDay(), 'car_id' => $car->id],
            )
            ->create();

        // Act
        $response = $this->get('/api/trips');

        // Assert
        $response->assertStatus(200);

        $response->assertJson([
            'data' => [
                [
                    'id' => $tripOne->id,
                    'date' => $tripOne->date->format('m/d/Y'),
                    'miles' => $tripOne->miles,
                    'total' => $tripOne->miles,
                    'car' => $tripOne->car->only('id', 'make', 'model', 'year'),
                ],
                [
                    'id' => $tripTwo->id,
                    'date' => $tripTwo->date->format('m/d/Y'),
                    'miles' => $tripTwo->miles,
                    'total' => round($tripTwo->miles + $tripOne->miles, 2),
                    'car' => $tripTwo->car->only('id', 'make', 'model', 'year'),
                ],
                [
                    'id' => $tripThree->id,
                    'date' => $tripThree->date->format('m/d/Y'),
                    'miles' => $tripThree->miles,
                    'total' => round($tripThree->miles + $tripTwo->miles + $tripOne->miles, 2),
                    'car' => $tripThree->car->only('id', 'make', 'model', 'year'),
                ],
            ]
        ]);
    }

    /**
     * @test
     */
    public function it_stores_new_trip()
    {
        // Arrange
        $this->login();
        $car = Car::factory()->create();
        $tripAttributes = Trip::factory()->make(['car_id' => $car->id])->toArray();

        // Sanity check
        $this->assertDatabaseMissing('trips', $tripAttributes);

        // Act
        $response = $this->post('/api/trips', $tripAttributes);

        // Assert
        $response->assertStatus(201);
        $this->assertDatabaseHas('trips', $tripAttributes);
    }
}
