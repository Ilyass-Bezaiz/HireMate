<?php

namespace Database\Seeders;

use App\DataProviders\SkillsDataProvider;
use App\Models\Skills;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Skills::insertOrIgnore(SkillsDataProvider::data());
    }
}
