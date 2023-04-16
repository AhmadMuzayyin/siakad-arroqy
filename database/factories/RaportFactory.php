<?php

namespace Database\Factories;

use App\Models\Raport;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RaportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Raport::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'principal_signature' => $this->faker->text(255),
            'signature' => $this->faker->text(255),
            'status' => 'already_printed',
            'score_id' => \App\Models\Score::factory(),
        ];
    }
}
