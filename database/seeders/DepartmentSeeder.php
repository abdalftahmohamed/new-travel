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
                'name' => 'Tours',
                'description' => 'Tours is so great.',
                'image_path' => "flag1.jpg",
            ],
            [
                'name' => 'Tickets',
                'description' => 'Tickets is so great.',
                'image_path' => "flag1.jpg",
            ],
            [
                'name' => 'Aerial Sightseeing',
                'description' => 'Aerial Sightseeing is so great.',
                'image_path' => "flag1.jpg",
            ],
            [
                'name' => 'Cruises',
                'description' => 'Cruises is so great.',
                'image_path' => "flag1.jpg",
            ],
            [
                'name' => 'Connectivity',
                'description' => 'Connectivity is so great.',
                'image_path' => "flag1.jpg",
            ],
            [
                'name' => 'Adventure',
                'description' => 'Adventure is so great.',
                'image_path' => "flag1.jpg",
            ],
            [
                'name' => 'Water Activities',
                'description' => 'Water Activities is so great.',
                'image_path' => "flag1.jpg",
            ],
            [
                'name' => 'Nature & Wildlife',
                'description' => 'Nature & Wildlife is so great.',
                'image_path' => "flag1.jpg",
            ],
            [
                'name' => 'Wellness',
                'description' => 'Wellness is so great.',
                'image_path' => "flag1.jpg",
            ],
            [
                'name' => 'Food & Drinks',
                'description' => 'Food & Drinks is so great.',
                'image_path' => "flag1.jpg",
            ],
            [
                'name' => 'Transportation',
                'description' => 'Transportation is so great.',
                'image_path' => "flag1.jpg",
            ],
        ];

        foreach ($departments as $departmentData) {
            Department::create($departmentData);
        }

    }
}
