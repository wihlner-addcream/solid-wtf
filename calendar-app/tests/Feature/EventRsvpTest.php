<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventRsvpTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function event_store_returns_created_status(): void
    {
        $payload = [
            'title' => 'Test Event',
            'description' => 'Example',
            'start_time' => '2024-01-01 10:00:00',
            'end_time' => '2024-01-01 11:00:00',
        ];

        $response = $this->postJson('/api/events', $payload);

        $response->assertStatus(201)
                 ->assertJsonFragment(['title' => 'Test Event']);
    }

    /** @test */
    public function rsvp_store_returns_created_status(): void
    {
        $event = Event::create([
            'title' => 'Another Event',
            'start_time' => '2024-01-02 10:00:00',
            'end_time' => '2024-01-02 11:00:00',
        ]);

        $payload = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'status' => 'confirmed',
        ];

        $response = $this->postJson("/api/events/{$event->id}/rsvp", $payload);

        $response->assertStatus(201)
                 ->assertJsonFragment(['email' => 'john@example.com']);
    }
}
