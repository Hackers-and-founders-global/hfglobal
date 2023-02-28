<?php

namespace Tests\Feature;

use App\Models\{User, Occupation};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Features;
use Tests\TestCase;

class DeleteAccountTest extends TestCase
{
    use RefreshDatabase;

    // public function test_user_accounts_can_be_deleted(): void
    // {
    //     if (! Features::hasAccountDeletionFeatures()) {
    //         $this->markTestSkipped('Account deletion is not enabled.');

    //         return;
    //     }

    //     $occupation = Occupation::factory()->create(['name' => 'Programación']);
    //     $this->actingAs($user = User::factory()->create(['occupation_id' => $occupation->id]));

    //     $response = $this->delete('/user', [
    //         'password' => 'password',
    //     ]);

    //     $this->assertNull($user->fresh());
    // }

    // public function test_correct_password_must_be_provided_before_account_can_be_deleted(): void
    // {
    //     if (! Features::hasAccountDeletionFeatures()) {
    //         $this->markTestSkipped('Account deletion is not enabled.');

    //         return;
    //     }

    //     $occupation = Occupation::factory()->create(['name' => 'Programación']);
    //     $this->actingAs($user = User::factory()->create(['occupation_id' => $occupation->id]));

    //     $response = $this->delete('/user', [
    //         'password' => 'wrong-password',
    //     ]);

    //     $this->assertNotNull($user->fresh());
    // }
}
