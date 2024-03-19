<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $departments = [
            [
                'name' => ['ar' => 'الجولات', 'en' => 'Tours', 'ur'=>'Tours'],
                'description' => ['ar' => 'الجولات رائعة جداً', 'en' => 'Tours is so great.', 'ur'=>'Tours is so great.'],
                'image_path' => "flag1.jpg",
            ],
            [
                'name' => ['ar' => 'تذاكر', 'en' => 'Tickets', 'ur'=>'Tickets'],
                'description' => ['ar' => 'التذاكر رائعة جداً', 'en' => 'Tickets is so great.', 'ur'=>'Tickets is so great.'],
                'image_path' => "flag1.jpg",
            ],
            [
                'name' => ['ar' => 'مشاهدة من الجو', 'en' => 'Aerial Sightseeing', 'ur'=>'Aerial Sightseeing'],
                'description' => ['ar' => 'المشاهدة من الجو رائعة جداً', 'en' => 'Aerial Sightseeing is so great.', 'ur'=>'Aerial Sightseeing is so great.'],
                'image_path' => "flag1.jpg",
            ],
            [
                'name' => ['ar' => 'رحلات بحرية', 'en' => 'Cruises', 'ur'=>'Cruises'],
                'description' => ['ar' => 'الرحلات البحرية رائعة جداً', 'en' => 'Cruises is so great.', 'ur'=>'Cruises is so great.'],
                'image_path' => "flag1.jpg",
            ],
            [
                'name' => ['ar' => 'الاتصالات', 'en' => 'Connectivity', 'ur'=>'Connectivity'],
                'description' => ['ar' => 'الاتصالات رائعة جداً', 'en' => 'Connectivity is so great.', 'ur'=>'Connectivity is so great.'],
                'image_path' => "flag1.jpg",
            ],
            [
                'name' => ['ar' => 'مغامرة', 'en' => 'Adventure', 'ur'=>'Adventure'],
                'description' => ['ar' => 'المغامرة رائعة جداً', 'en' => 'Adventure is so great.', 'ur'=>'Adventure is so great.'],
                'image_path' => "flag1.jpg",
            ],
            [
                'name' => ['ar' => 'الأنشطة المائية', 'en' => 'Water Activities', 'ur'=>'Water Activities'],
                'description' => ['ar' => 'الأنشطة المائية رائعة جداً', 'en' => 'Water Activities is so great.', 'ur'=>'Water Activities is so great.'],
                'image_path' => "flag1.jpg",
            ],
            [
                'name' => ['ar' => 'الطبيعة والحياة البرية', 'en' => 'Nature & Wildlife', 'ur'=>'Nature & Wildlife'],
                'description' => ['ar' => 'الطبيعة والحياة البرية رائعة جداً', 'en' => 'Nature & Wildlife is so great.', 'ur'=>'Nature & Wildlife is so great.'],
                'image_path' => "flag1.jpg",
            ],
            [
                'name' => ['ar' => 'العافية', 'en' => 'Wellness', 'ur'=>'Wellness'],
                'description' => ['ar' => 'العافية رائعة جداً', 'en' => 'Wellness is so great.', 'ur'=>'Wellness is so great.'],
                'image_path' => "flag1.jpg",
            ],
            [
                'name' => ['ar' => 'الطعام والمشروبات', 'en' => 'Food & Drinks', 'ur'=>'Food & Drinks'],
                'description' => ['ar' => 'الطعام والمشروبات رائعة جداً', 'en' => 'Food & Drinks is so great.', 'ur'=>'Food & Drinks is so great.'],
                'image_path' => "flag1.jpg",
            ],
            [
                'name' => ['ar' => 'المواصلات', 'en' => 'Transportation', 'ur'=>'Transportation'],
                'description' => ['ar' => 'المواصلات رائعة جداً', 'en' => 'Transportation is so great.', 'ur'=>'Transportation is so great.'],
                'image_path' => "flag1.jpg",
            ],
        ];

        foreach ($departments as $departmentData) {
            Department::create($departmentData);
        }

    }
}
