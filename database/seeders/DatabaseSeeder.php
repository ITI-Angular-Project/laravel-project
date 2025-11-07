<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Company;
use App\Models\Job;
use App\Models\JobView;
use App\Models\SavedJob;
use App\Models\Technology;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory(200)->create();
        User::factory()->create([
            'name' => 'Ahmed Taha',
            'email' => 'Ahmed185taha@gmail.com',
            'password' => '123456789',
            'email_verified_at' => now(),
            'role' => 'admin',
            'phone' => '01063675209',
            'linkedin_url' => 'https://www.linkedin.com/in/ahmedtaha09/',
        ]);


        Category::factory(10)->create();


        Technology::factory(20)->create();


        Company::factory(10)->create();


        Job::factory(200)->create();


        Application::factory(500)->create();


        Comment::factory(300)->create();


        JobView::factory(200)->create();


        SavedJob::factory(20)->create();

        $jobs = Job::all();
        $technologies = Technology::all();
        foreach ($jobs as $job) {
            $job->technologies()->attach($technologies->random(rand(1, 3)));
        }
    }
}
