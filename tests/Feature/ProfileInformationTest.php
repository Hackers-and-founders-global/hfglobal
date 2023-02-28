<?php

namespace Tests\Feature;

use App\Models\{User, Occupation};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_information_can_be_updated(): void
    {
        $occupation = Occupation::factory()->create(['name' => 'Programación']);
        $this->actingAs($user = User::factory()->create(['occupation_id' => $occupation->id]));

        $response = $this->put('/user/profile-information', [
            'firstname' => 'Test',
            'lastname' => 'Name',
            'email' => 'test@example.com',
        ]);

        $this->assertEquals('Test', $user->fresh()->firstname);
        $this->assertEquals('Name', $user->fresh()->lastname);
        $this->assertEquals('test@example.com', $user->fresh()->email);
    }
}
