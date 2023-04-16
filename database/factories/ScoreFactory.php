<?php

namespace Database\Factories;

use App\Models\Score;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Score::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'attendance' => $this->faker->randomNumber(0),
            'test' => $this->faker->randomNumber(0),
            'lesson_id' => \App\Models\Lesson::factory(),
            'student_id' => \App\Models\Student::factory(),
            'semester_id' => \App\Models\Semester::factory(),
        ];
    }
}
