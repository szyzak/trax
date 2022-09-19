<?php

namespace Tests;

use App\User;

abstract class ApiTestCase extends TestCase
{
    public function login(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        return $user;
    }
}
