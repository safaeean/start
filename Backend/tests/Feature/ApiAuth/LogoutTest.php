<?php

namespace Tests\Feature\ApiAuth;

use App\Models\User;
use Laravel\Sanctum\Sanctum;

class LogoutTest extends ApiAuthTestCase
{
    /** @test */
    public function userCanLogout()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $this->assertAuthenticatedAs($user);
        $response = $this->postJson($this->logoutRoute);
        $response->assertStatus(204);
    }
}
