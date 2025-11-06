<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::all()->random()->id,
            'category_id' => Category::all()->random()->id,
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraphs(3, true),
            'responsibilities' => fake()->optional()->paragraph(),
            'qualifications' => fake()->optional()->paragraph(),
            'benefits' => fake()->optional()->paragraph(),
            'salary_min' => fake()->optional()->numberBetween(30000, 60000),
            'salary_max' => fake()->optional()->numberBetween(60000, 120000),
            'work_type' => fake()->randomElement(['remote', 'on_site', 'hybrid']),
            'technologies_txt' => fake()->optional()->words(3, true),
            'deadline' => fake()->optional()->date(),
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
