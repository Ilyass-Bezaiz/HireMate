<?php

namespace App\DataProviders;

abstract class SkillsDataProvider
{
    public static function data(): array
    {
        return 
            array(   
                ["id" => 1, "title" => "JavaScript", "created_at" => "2023-01-01T12:00:00Z", "updated_at" => "2023-01-05T09:30:00Z"],
                ["id" => 2, "title" => "Python", "created_at" => "2023-01-02T14:45:00Z", "updated_at" => "2023-01-06T11:15:00Z"],
                ["id" => 3, "title" => "Financial Modeling", "created_at" => "2023-01-03T10:30:00Z", "updated_at" => "2023-01-07T08:00:00Z"],
                ["id" => 4, "title" => "Data Analysis", "created_at" => "2023-01-04T16:20:00Z", "updated_at" => "2023-01-08T14:00:00Z"],
                ["id" => 5, "title" => "UI/UX Design", "created_at" => "2023-01-05T09:00:00Z", "updated_at" => "2023-01-09T06:45:00Z"],
                ["id" => 6, "title" => "Java", "created_at" => "2023-01-06T13:15:00Z", "updated_at" => "2023-01-10T10:30:00Z"],
                ["id" => 7, "title" => "Financial Analysis", "created_at" => "2023-01-07T11:45:00Z", "updated_at" => "2023-01-11T09:15:00Z"],
                ["id" => 8, "title" => "Machine Learning", "created_at" => "2023-01-08T17:30:00Z", "updated_at" => "2023-01-12T15:00:00Z"],
                ["id" => 9, "title" => "Accounting", "created_at" => "2023-01-09T08:45:00Z", "updated_at" => "2023-01-13T07:00:00Z"],
                ["id" => 10, "title" => "SQL", "created_at" => "2023-01-10T14:00:00Z", "updated_at" => "2023-01-14T11:30:00Z"],
                ["id" => 11, "title" => "Graphic Design", "created_at" => "2023-01-11T10:15:00Z", "updated_at" => "2023-01-15T08:00:00Z"],
                ["id" => 12, "title" => "Ruby on Rails", "created_at" => "2023-01-12T16:30:00Z", "updated_at" => "2023-01-16T14:15:00Z"],
                ["id" => 13, "title" => "Economics", "created_at" => "2023-01-13T09:00:00Z", "updated_at" => "2023-01-17T06:45:00Z"],
                ["id" => 14, "title" => "Data Science", "created_at" => "2023-01-14T12:15:00Z", "updated_at" => "2023-01-18T09:30:00Z"],
                ["id" => 15, "title" => "C++", "created_at" => "2023-01-15T07:30:00Z", "updated_at" => "2023-01-19T05:15:00Z"],
                ["id" => 16, "title" => "Investment Banking", "created_at" => "2023-01-16T15:45:00Z", "updated_at" => "2023-01-20T13:30:00Z"],
                ["id" => 17, "title" => "React.js", "created_at" => "2023-01-17T11:00:00Z", "updated_at" => "2023-01-21T08:45:00Z"],
                ["id" => 18, "title" => "Financial Planning", "created_at" => "2023-01-18T17:15:00Z", "updated_at" => "2023-01-22T15:00:00Z"],
                ["id" => 19, "title" => "Artificial Intelligence", "created_at" => "2023-01-19T08:30:00Z", "updated_at" => "2023-01-23T06:15:00Z"],
                ["id" => 20, "title" => "Marketing Strategy", "created_at" => "2023-01-20T14:45:00Z", "updated_at" => "2023-01-24T11:30:00Z"],
            );
    }
}
