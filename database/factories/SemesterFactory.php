<?php

namespace Database\Factories;

use App\Models\Semester;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SemesterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Semester::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'start' => $this->faker->date(),
            'end' => $this->faker->date(),
            'academic_year' => $this->faker->year(),
            'status' => 'Aktif',
        ];
    }
}
