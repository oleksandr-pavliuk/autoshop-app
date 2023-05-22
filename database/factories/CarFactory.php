<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "model" => fake()->lastName(),
            "year" => \random_int(2000,2024),
            "type" => \array_rand(\array_flip(["sedan", "station wagon", "crossover", "hatchback", "SUV"])),
            "equipment" => \array_rand(\array_flip(["basic", "medium", "premium", "S", "SE", "titanium"])),
            "price" => \random_int(30000, 100000),
            "engine" => \array_rand(\array_flip(["petrol", "gas", "diesel", "electro"])),
        ];
    }
}
