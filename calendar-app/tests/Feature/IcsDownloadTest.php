<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IcsDownloadTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_download_ics(): void
    {
        $event = Event::factory()->create(['title' => 'Conference']);

        $response = $this->get("/api/events/{$event->id}/ics?email=john@example.com&name=John");

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/calendar; charset=utf-8');
        $response->assertSee('BEGIN:VCALENDAR');
        $response->assertSee('SUMMARY:Conference');
        $response->assertSee('METHOD:REQUEST');
        $response->assertSee('ORGANIZER');
        $response->assertSee('ATTENDEE');
    }
}
