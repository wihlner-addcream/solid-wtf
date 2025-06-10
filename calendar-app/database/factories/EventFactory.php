<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('now', '+1 week');

        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(),
            'start_time' => $start,
            'end_time' => (clone $start)->modify('+1 hour'),
        ];
    }
}
