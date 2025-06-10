<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventFilterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function filter_events_by_title(): void
    {
        Event::factory()->create(['title' => 'Company Meeting']);
        Event::factory()->create(['title' => 'Team Lunch']);

        $response = $this->getJson('/api/events?title=Meeting');

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'Company Meeting'])
                 ->assertJsonMissing(['title' => 'Team Lunch']);
    }

    /** @test */
    public function filter_events_by_date_range(): void
    {
        Event::factory()->create([
            'start_time' => '2024-01-10 10:00:00',
            'end_time' => '2024-01-10 11:00:00',
        ]);
        Event::factory()->create([
            'start_time' => '2024-02-10 10:00:00',
            'end_time' => '2024-02-10 11:00:00',
        ]);

        $response = $this->getJson('/api/events?start=2024-01-01&end=2024-01-31');

        $response->assertStatus(200)
                 ->assertJsonCount(1);
    }
}
