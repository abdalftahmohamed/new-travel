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
                'name' => 'United Arab Emirates',
                'description' => 'United Arab Emirates is so great.',
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
