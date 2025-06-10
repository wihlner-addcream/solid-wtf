<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Rsvp;
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
        $event = Event::factory()->create();

        $payload = Rsvp::factory()->make(['email' => 'john@example.com'])->only(['name', 'email', 'status']);

        $response = $this->postJson("/api/events/{$event->id}/rsvp", $payload);

        $response->assertStatus(201)
                 ->assertJsonFragment(['email' => 'john@example.com']);
    }

    /** @test */
    public function can_retrieve_events_with_related_rsvps(): void
    {
        $event = Event::factory()->create();

        Rsvp::factory()->create(['event_id' => $event->id, 'email' => 'alice@example.com']);

        $response = $this->getJson('/api/events');

        $response->assertStatus(200)
                 ->assertJsonFragment(['email' => 'alice@example.com']);
    }
}
