<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RsvpValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_status_must_be_valid(): void
    {
        $event = Event::factory()->create();

        $response = $this->postJson("/api/events/{$event->id}/rsvp", [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'status' => 'invalid',
        ]);

        $response->assertStatus(422);
    }
}
