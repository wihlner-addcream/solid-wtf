<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Rsvp;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventRsvpTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_an_event(): void
    {
        $payload = [
            'title' => 'Test Event',
            'description' => 'An event for testing',
            'start_time' => now()->addHour()->toDateTimeString(),
            'end_time' => now()->addHours(2)->toDateTimeString(),
        ];

        $response = $this->postJson('/api/events', $payload);

        $response->assertStatus(201)
                 ->assertJsonFragment(['title' => 'Test Event']);

        $this->assertDatabaseHas('events', ['title' => 'Test Event']);
    }

    public function test_creating_an_rsvp(): void
    {
        $event = Event::factory()->create();

        $payload = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'status' => 'confirmed',
        ];

        $response = $this->postJson("/api/events/{$event->id}/rsvp", $payload);

        $response->assertStatus(201)
                 ->assertJsonFragment(['email' => 'john@example.com']);

        $this->assertDatabaseHas('rsvps', [
            'event_id' => $event->id,
            'email' => 'john@example.com',
        ]);
    }

    public function test_retrieving_events_with_rsvps(): void
    {
        $event = Event::factory()->has(Rsvp::factory()->count(2))->create();

        $response = $this->getJson('/api/events');

        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $event->id])
                 ->assertJsonStructure([
                     '*' => ['id', 'title', 'description', 'start_time', 'end_time', 'rsvps'],
                 ]);

        $this->assertCount(2, $response->json()[0]['rsvps']);
    }
}
