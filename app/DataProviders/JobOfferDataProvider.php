<?php

namespace App\DataProviders;

abstract class JobOfferDataProvider
{
    public static function data(): array
    {
        return array(
            array('id' => '1','user_id' => '31','title' => 'Software Engineer','description' => 'Join our dynamic software engineering team...','salary' => '100000.00','country_id' => '1','city_id' => '1','flexibility' => 'On site','requestedContract' => 'Full-time','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '2','user_id' => '33','title' => 'Data Scientist','description' => 'Exciting opportunity for a skilled data scientist...','salary' => '120000.00','country_id' => '1','city_id' => '2','flexibility' => 'Hybrid','requestedContract' => 'Full-time','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '3','user_id' => '35','title' => 'UX/UI Designer','description' => 'Design the future with our innovative team...','salary' => '90000.00','country_id' => '1','city_id' => '3','flexibility' => 'Remote','requestedContract' => 'Contract','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '4','user_id' => '37','title' => 'Marketing Specialist','description' => 'Join our marketing team and drive success...','salary' => '80000.00','country_id' => '1','city_id' => '4','flexibility' => 'Hybrid','requestedContract' => 'Part-time','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '5','user_id' => '39','title' => 'Software Developer','description' => 'Exciting projects for talented developers...','salary' => '110000.00','country_id' => '1','city_id' => '5','flexibility' => 'Hybrid','requestedContract' => 'Full-time','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '6','user_id' => '41','title' => 'AI Research Scientist','description' => 'Advance the field of artificial intelligence...','salary' => '130000.00','country_id' => '1','city_id' => '6','flexibility' => 'Remote','requestedContract' => 'Full-time','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '7','user_id' => '43','title' => 'Product Manager','description' => 'Shape the future of our product line...','salary' => '95000.00','country_id' => '1','city_id' => '7','flexibility' => 'On site','requestedContract' => 'Full-time','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '8','user_id' => '45','title' => 'Software Engineer','description' => 'Contribute to cutting-edge software solutions...','salary' => '105000.00','country_id' => '1','city_id' => '8','flexibility' => 'Hybrid','requestedContract' => 'Full-time','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '9','user_id' => '47','title' => 'Data Analyst','description' => 'Analytical role with a focus on data-driven insights...','salary' => '85000.00','country_id' => '1','city_id' => '9','flexibility' => 'Hybrid','requestedContract' => 'Contract','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '10','user_id' => '49','title' => 'UX/UI Designer','description' => 'Design innovative user experiences for our products...','salary' => '95000.00','country_id' => '1','city_id' => '10','flexibility' => 'On site','requestedContract' => 'Full-time','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43')
        );
    }
}
