<?php

namespace Database\Seeders;

use App\DataProviders\JobSeekerDataProvider;
use App\Models\JobSeekerPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeekerPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobSeekerPost::insertOrIgnore(JobSeekerDataProvider::data());
    }
}
