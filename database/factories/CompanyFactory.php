<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employer_id' => User::all()->where('role', 'employer')->random()->id,
            'name' => fake()->company(),
            'website' => fake()->optional()->url(),
            'location' => fake()->city(),
            'logo_path' => fake()->optional()->imageUrl(),
            'about' => fake()->optional()->paragraph(),
        ];
    }
}
