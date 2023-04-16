<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(255),
            'gender' => \Arr::random(['male', 'female', 'other']),
            'date_birth' => $this->faker->date(),
            'address_birth' => $this->faker->text(255),
            'address' => $this->faker->text(),
            'phone' => $this->faker->text(255),
            'student_class_id' => \App\Models\StudentClass::factory(),
        ];
    }
}
