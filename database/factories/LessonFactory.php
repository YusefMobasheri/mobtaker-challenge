<?php

namespace Database\Factories;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

class LessonFactory extends Factory
{
    use WithFaker;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'unit' => $this->faker->biasedNumberBetween(1,4),
            'school_id' => School::first()->id
        ];
    }
}
