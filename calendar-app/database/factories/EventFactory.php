<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(),
            'start_time' => $this->faker->dateTimeBetween('+1 hour', '+2 hours'),
            'end_time' => $this->faker->dateTimeBetween('+3 hours', '+4 hours'),
        ];
    }
}
