<?php

namespace Database\Factories;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConcertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'artist_id' => Artist::factory()->create(),
            'description' => $this->faker->text(),
            'starts_at' => now()->format('Y-m-d'),
            'ends_at' => now()->addWeek()->format('Y-m-d'),
            'is_published' => $this->faker->boolean(),
        ];
    }
}
