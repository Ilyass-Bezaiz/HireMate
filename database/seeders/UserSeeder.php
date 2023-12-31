<?php

namespace Database\Seeders;

use App\DataProviders\UserDataProvider;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert(UserDataProvider::data());
    }
}
