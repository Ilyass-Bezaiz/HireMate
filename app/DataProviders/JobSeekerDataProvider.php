<?php

namespace App\DataProviders;

abstract class JobSeekerDataProvider
{
    public static function data(): array
    {
        return array(
            array('id' => '1','title' => 'Software Developer','description' => 'Experienced software developer seeking new opportunities','user_id' => '1','expected_salary' => '80000.00','flexibility' => 'Hybrid','requestedContract' => 'Full-time','country_id' => '1','city_id' => '1','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '2','title' => 'Marketing Specialist','description' => 'Marketing professional with 5 years of experience','user_id' => '3','expected_salary' => '60000.00','flexibility' => 'Remote','requestedContract' => 'Part-time','country_id' => '2','city_id' => '2','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '3','title' => 'Data Scientist','description' => 'Passionate data scientist looking for challenging projects','user_id' => '5','expected_salary' => '90000.00','flexibility' => 'On site','requestedContract' => 'Full-time','country_id' => '3','city_id' => '3','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '4','title' => 'Graphic Designer','description' => 'Creative graphic designer with a keen eye for detail','user_id' => '7','expected_salary' => '70000.00','flexibility' => 'Remote','requestedContract' => 'Freelance','country_id' => '4','city_id' => '4','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '5','title' => 'Project Manager','description' => 'Experienced project manager with a track record of successful delivery','user_id' => '9','expected_salary' => '100000.00','flexibility' => 'Hybrid','requestedContract' => 'Full-time','country_id' => '5','city_id' => '5','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '6','title' => 'UX/UI Designer','description' => 'Passionate about creating user-centric designs','user_id' => '11','expected_salary' => '85000.00','flexibility' => 'Remote','requestedContract' => 'Full-time','country_id' => '1','city_id' => '1','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '7','title' => 'Financial Analyst','description' => 'Detail-oriented financial analyst with expertise in forecasting','user_id' => '13','expected_salary' => '95000.00','flexibility' => 'On site','requestedContract' => 'Full-time','country_id' => '2','city_id' => '2','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '8','title' => 'Customer Support Specialist','description' => 'Dedicated customer support professional with excellent communication skills','user_id' => '15','expected_salary' => '55000.00','flexibility' => 'Remote','requestedContract' => 'Part-time','country_id' => '3','city_id' => '3','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '9','title' => 'Sales Representative','description' => 'Results-driven sales representative with a proven track record','user_id' => '17','expected_salary' => '75000.00','flexibility' => 'Hybrid','requestedContract' => 'Full-time','country_id' => '4','city_id' => '4','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '10','title' => 'Human Resources Specialist','description' => 'Experienced HR professional specializing in recruitment','user_id' => '19','expected_salary' => '80000.00','flexibility' => 'Remote','requestedContract' => 'Full-time','country_id' => '5','city_id' => '5','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43')
        );
    }
}
