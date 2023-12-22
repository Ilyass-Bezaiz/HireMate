<?php

namespace Database\Seeders;

use App\DataProviders\JobOfferDataProvider;
use App\Models\JobOfferPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobOfferPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobOfferPost::insertOrIgnore(JobOfferDataProvider::data());
    }
}
