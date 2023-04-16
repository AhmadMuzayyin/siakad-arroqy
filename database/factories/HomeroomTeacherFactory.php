<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\HomeroomTeacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class HomeroomTeacherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HomeroomTeacher::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'teacher_id' => \App\Models\Teacher::factory(),
            'student_class_id' => \App\Models\StudentClass::factory(),
        ];
    }
}
