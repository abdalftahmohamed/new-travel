<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $citys = [
            [
                'country_id' => 1,
                'name' => 'Dubai',
                'description' => 'Dubai is so great.',
                'image_path' => "flag1.jpg",
            ],
            [
                'country_id' => 1,
                'name' => 'Abu Dhabi',
                'description' => 'Abu Dhabi is so great.',
                'image_path' => "flag1.jpg",
            ],
            [
                'country_id' => 1,
                'name' => 'Al Ain',
                'description' => 'Al Ain is so great.',
                'image_path' => "flag1.jpg",
            ],
            [
                'country_id' => 1,
                'name' => 'Fujairah',
                'description' => 'Fujairah is so great.',
                'image_path' => "flag1.jpg",
            ],
            [
                'country_id' => 1,
                'name' => 'Sharjah',
                'description' => 'Sharjah is so great.',
                'image_path' => "flag1.jpg",
            ],
            [
                'country_id' => 1,
                'name' => 'Ajman',
                'description' => 'Ajman is so great.',
                'image_path' => "flag1.jpg",
            ],
            [
                'country_id' => 1,
                'name' => 'Ras Al Khaimah',
                'description' => 'Ras Al Khaimah is so great.',
                'image_path' => "flag1.jpg",
            ],
            [
                'country_id' => 1,
                'name' => 'Umm al-Quwain',
                'description' => 'Umm al-Quwain is so great.',
                'image_path' => "flag1.jpg",
            ],

//            [
//                'country_id' => 2,
//                'name' => 'Cairo',
//                'description' => 'Cairo is so great.',
//                'image_path' => "flag2.jpg",
//            ],
//            [
//                'country_id' => 2,
//                'name' => 'Nasr City',
//                'description' => 'Nasr City is so great.',
//                'image_path' => "flag2.jpg",
//            ],
//            [
//                'country_id' => 2,
//                'name' => 'ElMansoura City',
//                'description' => 'ElMansoura City is so great.',
//                'image_path' => "flag2.jpg",
//            ],
//            [
//                'country_id' => 2,
//                'name' => '6 October City',
//                'description' => '6 October City is so great.',
//                'image_path' => "flag2.jpg",
//            ],
        ];

        foreach ($citys as $cityData) {
            City::create($cityData);
        }

    }
}
