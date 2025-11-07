<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_id' => Job::all()->random()->id,
            'candidate_id' => User::all()->where('role', 'candidate')->random()->id,
            'applicant_name' => fake()->name(),
            'applicant_email' => fake()->unique()->safeEmail(),
            'applicant_phone' => fake()->optional()->phoneNumber(),
            'linkedin_url' => fake()->optional()->url(),
            'resume_path' => fake()->filePath(),
            'cover_letter' => fake()->optional()->paragraph(),
            'status' => fake()->randomElement(['submitted', 'accepted', 'rejected']),
        ];
    }
}
