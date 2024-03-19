<?php

namespace Database\Seeders;

use App\Models\City;
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
        $cities = [
            [
                'country_id' => 1,
                'name' => ['ar' => 'دبي', 'en' => 'Dhabi', 'ur'=>'Dhabi'],
                'description' => ['ar' => 'دبي مدينة جميلة تمتاز بالأعمال الاستثمارية', 'en' => 'Dubai is so great.', 'ur'=>'Dubai is so great.'],
                'image_path' => "flag1.jpg",
            ],
            [
                'country_id' => 1,
                'name' => ['ar' => 'أبو ظبي', 'en' => 'Abu Dhabi', 'ur'=>'Abu Dhabi'],
                'description' => ['ar' => 'أبو ظبي مدينة جميلة جداً', 'en' => 'Abu Dhabi is so great.', 'ur'=>'Abu Dhabi is so great.'],
                'image_path' => "flag1.jpg",
            ],
            [
                'country_id' => 1,
                'name' => ['ar' => 'العين', 'en' => 'Al Ain', 'ur'=>'Al Ain'],
                'description' => ['ar' => 'العين مدينة جميلة جداً', 'en' => 'Al Ain is so great.', 'ur'=>'Al Ain is so great.'],
                'image_path' => "flag1.jpg",
            ],
            [
                'country_id' => 1,
                'name' => ['ar' => 'الفجيرة', 'en' => 'Fujairah', 'ur'=>'Fujairah'],
                'description' => ['ar' => 'الفجيرة مدينة جميلة جداً', 'en' => 'Fujairah is so great.', 'ur'=>'Fujairah is so great.'],
                'image_path' => "flag1.jpg",
            ],
            [
                'country_id' => 1,
                'name' => ['ar' => 'الشارقة', 'en' => 'Sharjah', 'ur'=>'Sharjah'],
                'description' => ['ar' => 'الشارقة مدينة جميلة جداً', 'en' => 'Sharjah is so great.', 'ur'=>'Sharjah is so great.'],
                'image_path' => "flag1.jpg",
            ],
            [
                'country_id' => 1,
                'name' => ['ar' => 'عجمان', 'en' => 'Ajman', 'ur'=>'Ajman'],
                'description' => ['ar' => 'عجمان مدينة جميلة جداً', 'en' => 'Ajman is so great.', 'ur'=>'Ajman is so great.'],
                'image_path' => "flag1.jpg",
            ],
            [
                'country_id' => 1,
                'name' => ['ar' => 'رأس الخيمة', 'en' => 'Ras Al Khaimah', 'ur'=>'Ras Al Khaimah'],
                'description' => ['ar' => 'رأس الخيمة مدينة جميلة جداً', 'en' => 'Ras Al Khaimah is so great.', 'ur'=>'Ras Al Khaimah is so great.'],
                'image_path' => "flag1.jpg",
            ],
            [
                'country_id' => 1,
                'name' => ['ar' => 'أم القيوين', 'en' => 'Umm al-Quwain', 'ur'=>'Umm al-Quwain'],
                'description' => ['ar' => 'أم القيوين مدينة جميلة جداً', 'en' => 'Umm al-Quwain is so great.', 'ur'=>'Umm al-Quwain is so great.'],
                'image_path' => "flag1.jpg",
            ],
        ];

        foreach ($cities as $cityData) {
            City::create($cityData);
        }
    }
}
