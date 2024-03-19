<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countrys = [
            [
                'name' => ['ar' => 'الامارات العربية المتحدة', 'en' => 'United Arab Emirates', 'ur' => 'United Arab Emirates'],
                'description' => ['ar' => 'الامارات دولة جميلة تمتاز بالاعمال الاستثماريه', 'en' => 'United Arab Emirates is so great.', 'ur' => 'United Arab Emirates is so great.'],
                'image_path' => "flag1.jpg",
            ],
//            [
//                'name' => 'Egypt',
//                'description' => 'Egypt is so great.',
//                'image_path' => "flag2.jpg",
//            ],
        ];

        foreach ($countrys as $countryData) {
            Country::create($countryData);
        }

    }
}
