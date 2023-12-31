<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\DataProviders\CandidateDataProvider;
use App\DataProviders\EmployerDataProvider;
use App\DataProviders\JobOfferDataProvider;
use App\DataProviders\JobRequestDataProvider;
use App\DataProviders\JobSeekerDataProvider;
use App\DataProviders\UserDataProvider;
use App\Models\Candidate;
use App\Models\Employer;
use App\Models\JobOfferPost;
use App\Models\JobSeekerPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        $this->call([
            UserSeeder::class,
            CandidateSeeder::class,
            EmployerSeeder::class,
            JobOfferPostSeeder::class,
            JobSeekerPostSeeder::class,
            WorldSeeder::class,
            Category::class,
            SkillsSeeder::class
        ]);

    }
}
