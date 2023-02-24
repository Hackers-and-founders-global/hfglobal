<?php

namespace Tests\Feature;

use App\Models\{User, Occupation};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrowserSessionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_other_browser_sessions_can_be_logged_out(): void
    {
        $occupation = Occupation::factory()->create(['name' => 'Programación']);

        $this->actingAs($user = User::factory()->create(['occupation_id' => $occupation->id]));

        $response = $this->delete('/user/other-browser-sessions', [
            'password' => 'password',
        ]);

        $response->assertSessionHasNoErrors();
    }
}
