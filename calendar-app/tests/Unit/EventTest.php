<?php

namespace Tests\Unit;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_casts_start_and_end_times_to_carbon_instances(): void
    {
        $event = Event::factory()->create();

        $this->assertInstanceOf(Carbon::class, $event->start_time);
        $this->assertInstanceOf(Carbon::class, $event->end_time);
    }
}
