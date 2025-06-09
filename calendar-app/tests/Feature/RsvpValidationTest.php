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
        $event = Event::create([
            'title' => 'Test Event',
            'description' => 'desc',
            'start_time' => now(),
            'end_time' => now()->addHour(),
        ]);

        $response = $this->postJson("/api/events/{$event->id}/rsvp", [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'status' => 'invalid',
        ]);

        $response->assertStatus(422);
    }
}
