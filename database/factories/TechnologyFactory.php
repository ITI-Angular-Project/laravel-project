<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Technology>
 */
class TechnologyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->randomElement(['PHP', 'JavaScript', 'Python', 'Java', 'C#', 'Ruby', 'Go', 'Rust', 'Laravel', 'React', 'Vue', 'Angular', 'Node.js', 'TypeScript', 'Swift', 'Kotlin', 'Dart', 'Scala', 'Perl', 'Haskell']);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
