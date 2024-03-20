<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $clients = [
            [
                'name' => ['ar' => 'كود كلاينت', 'en' => 'codegyept', 'ur' => 'codegyept2'],
                'email' => 'codegyept@gmail.com',
                'password' => bcrypt('12345678'),
                'address' => ['ar' => 'عنوان1', 'en' => 'address1', 'ur' => 'address2'],
                'phone' => "010000000000",
                'image_path' => "flag1.jpg",
            ],
            [
                'name' => ['ar' => '2الكلاينت', 'en' => 'abdalftah', 'ur' => 'Admin'],
                'email' => 'abdalftah@gmail.com',
                'password' => bcrypt('12345678'),
                'address' => ['ar' => 'عنوان1', 'en' => 'address1', 'ur' => 'address2'],
                'phone' => "0100000000000",
                'image_path' => "flag1.jpg",
            ]
        ];
        foreach ($clients as $clientData) {
            Client::create($clientData);
        }
    }
}
