<?php

namespace App\DataProviders;

abstract class EmployerDataProvider
{
    public static function data(): array
    {
        return array(
            array('id' => '1','user_id' => '31','companyName' => 'Tesla','city' => 'Palo Alto','zip' => '94304','country' => 'United States','industry' => 'Automotive','employeeCount' => '50000', 'coverPicture' => '/path/to/tesla_cover.jpg','bio' => 'Leading electric car manufacturer...','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '2','user_id' => '33','companyName' => 'Apple Inc.','city' => 'Cupertino','zip' => '95014','country' => 'United States','industry' => 'Technology','employeeCount' => '147000', 'coverPicture' => '/path/to/apple_cover.jpg','bio' => 'Innovative technology company...','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '3','user_id' => '35','companyName' => 'Microsoft Corporation','city' => 'Redmond','zip' => '98052','country' => 'United States','industry' => 'Technology','employeeCount' => '181000', 'coverPicture' => '/path/to/microsoft_cover.jpg','bio' => 'Empowering every person and organization...','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '4','user_id' => '37','companyName' => 'Intel Inc.','city' => 'Mountain View','zip' => '94043','country' => 'United States','industry' => 'Technology','employeeCount' => '139000', 'coverPicture' => '/path/to/alphabet_cover.jpg','bio' => 'A collection of companies...','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '5','user_id' => '39','companyName' => 'Cisco','city' => 'Menlo Park','zip' => '94025','country' => 'United States','industry' => 'Technology','employeeCount' => '78000', 'coverPicture' => '/path/to/meta_cover.jpg','bio' => 'Connecting people and communities...','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '6','user_id' => '41','companyName' => 'Amazon Inc.','city' => 'Seattle','zip' => '98109','country' => 'United States','industry' => 'E-Commerce','employeeCount' => '1538000', 'coverPicture' => '/path/to/amazon_cover.jpg','bio' => 'Earth’s most customer-centric company...','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '7','user_id' => '43','companyName' => 'Google','city' => 'Redmond','zip' => '98052','country' => 'United States','industry' => 'Technology','employeeCount' => '181000', 'coverPicture' => '/path/to/microsoft_cover.jpg','bio' => 'Empowering every person and organization...','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '8','user_id' => '45','companyName' => 'Facebook','city' => 'Menlo Park','zip' => '94025','country' => 'United States','industry' => 'Technology','employeeCount' => '10000', 'coverPicture' => '/path/to/facebook_cover.jpg','bio' => 'Bringing the world closer together...','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '9','user_id' => '47','companyName' => 'IBM','city' => 'Armonk','zip' => '10504','country' => 'United States','industry' => 'Technology','employeeCount' => '345900', 'coverPicture' => '/path/to/ibm_cover.jpg','bio' => 'Innovating for a better future...','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43'),
            array('id' => '10','user_id' => '49','companyName' => 'Oracle Corporation','city' => 'Redwood City','zip' => '94065','country' => 'United States','industry' => 'Technology','employeeCount' => '135000', 'coverPicture' => '/path/to/oracle_cover.jpg','bio' => 'Enabling businesses to succeed...','created_at' => '2023-12-22 14:40:43','updated_at' => '2023-12-22 14:40:43')
        );
    }
}
