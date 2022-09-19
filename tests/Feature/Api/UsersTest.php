<?php

namespace Tests\Feature\Api;

use Tests\ApiTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends ApiTestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_returns_authenticated_user()
    {
        // Arrange
        $user = $this->login();

        // Act
        $response = $this->get('/api/user');

        // Assert
        $response->assertStatus(200);
        $response->assertSee($user->toArray());
    }
}
