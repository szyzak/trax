<?php

namespace Tests\Feature\Api;

use App\Modules\Cars\Models\Car;
use Tests\ApiTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CarsTest extends ApiTestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_indexes_cars()
    {
        // Arrange
        $this->login();
        $cars = Car::factory()->times(3)->create();

        // Act
        $response = $this->get('/api/cars');

        // Assert
        $response->assertStatus(200);
        $response->assertJson([
            'data' => $cars->map->only(['id', 'make', 'model', 'year'])->toArray()
        ]);
    }

    /**
     * @test
     */
    public function it_shows_car()
    {
        // Arrange
        $this->login();
        $car = Car::factory()->create();

        // Act
        $response = $this->get("/api/cars/$car->id");

        // Assert
        $response->assertStatus(200);
        $response->assertJson([
            'data' => $car->only(['id', 'make', 'model', 'year'])
        ]);
    }

    /**
     * @test
     */
    public function it_stores_new_car()
    {
        // Arrange
        $carAttributes = Car::factory()->make()->toArray();
        $this->login();

        // Sanity check
        $this->assertDatabaseMissing('cars', $carAttributes);

        // Act
        $response = $this->post('/api/cars', $carAttributes);

        // Assert
        $response->assertStatus(201);
        $this->assertDatabaseHas('cars', $carAttributes);
    }

    /**
     * @test
     */
    public function it_removes_car()
    {
        // Arrange
        $this->login();
        $carId = Car::factory()->create()->id;

        // Act
        $this->delete("api/cars/$carId");

        // Assert
        $this->assertDatabaseMissing('cars', ['id' => $carId]);
    }
}
