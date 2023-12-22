<?php

namespace Database\Seeders;

use App\DataProviders\EmployerDataProvider;
use App\Models\Employer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employer::insertOrIgnore(EmployerDataProvider::data());
    }
}
