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

        User::factory(10)->create();


        Category::factory(5)->create();


        Technology::factory(10)->create();


        Company::factory(5)->create();


        Job::factory(20)->create();


        Application::factory(50)->create();


        Comment::factory(30)->create();


        JobView::factory(100)->create();


        SavedJob::factory(20)->create();

        $jobs = Job::all();
        $technologies = Technology::all();
        foreach ($jobs as $job) {
            $job->technologies()->attach($technologies->random(rand(1, 3)));
        }
    }
}
