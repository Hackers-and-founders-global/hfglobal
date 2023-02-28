<?php

namespace Tests\Feature;

use App\Models\{User, Occupation};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Features;
use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    public function test_confirm_password_screen_can_be_rendered(): void
    {
        $occupation = Occupation::factory()->create(['name' => 'Programación']);
        $user = User::factory()->withPersonalTeam()->create(['occupation_id' => $occupation->id]);

        $response = $this->actingAs($user)->get('/user/confirm-password');

        $response->assertStatus(200);
    }

    public function test_password_can_be_confirmed(): void
    {
        $occupation = Occupation::factory()->create(['name' => 'Programación']);
        $user = User::factory()->create(['occupation_id' => $occupation->id]);

        $response = $this->actingAs($user)->post('/user/confirm-password', [
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function test_password_is_not_confirmed_with_invalid_password(): void
    {
        $occupation = Occupation::factory()->create(['name' => 'Programación']);
        $user = User::factory()->create(['occupation_id' => $occupation->id]);

        $response = $this->actingAs($user)->post('/user/confirm-password', [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
    }
}
