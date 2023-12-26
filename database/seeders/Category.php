<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Category extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Software Development',
            'Web Development',
            'Mobile App Development',
            'Data Science',
            'UI/UX Design',
            'Digital Marketing',
            'Content Writing',
            'Graphic Design',
            'Finance and Accounting',
            'Human Resources',
            'Customer Service',
            'Healthcare',
            'Education and Training',
            'Sales and Marketing',
            'Project Management',
            'Business Analysis',
            'Quality Assurance',
            'Legal',
            'Engineering',
            'Architecture',
            'Construction',
            'Manufacturing',
            'Research and Development',
            'Social Media Management',
            'Public Relations',
            'Event Planning',
            'Photography',
            'Video Editing',
            'Animation',
            'Sports and Fitness',
            'Retail',
            'Hospitality',
            'Travel and Tourism',
            'Food Services',
            'Automotive',
            'Agriculture',
            'Environmental Services',
            'Non-Profit and Social Services',
            'Government',
            'Telecommunications',
            'Utilities',
            'Real Estate',
            'Fashion',
            'E-commerce',
            'Cryptocurrency and Blockchain',
            'Space Exploration',
            'Artificial Intelligence',
            'Cybersecurity',
            'Augmented Reality',
            'Virtual Reality',
            'Renewable Energy',
            'Biotechnology',
            'Pharmaceuticals',
        ];

        // Insert sample data into the 'your_table_name' table
        foreach ($categories as $index => $category) {
            DB::table('category')->insert([
                'id' => $index + 1,
                'name' => $category,
            ]);
        }
    }
}
