<?php

namespace Database\Factories;

use App\Models\TimeTable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimeTableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TimeTable::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'day' => $this->faker->text(255),
            'clock_in' => $this->faker->time(),
            'clock_out' => $this->faker->time(),
            'student_class_id' => \App\Models\StudentClass::factory(),
            'lesson_id' => \App\Models\Lesson::factory(),
            'teacher_id' => \App\Models\Teacher::factory(),
            'semester_id' => \App\Models\Semester::factory(),
        ];
    }
}
