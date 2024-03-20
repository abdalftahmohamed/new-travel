<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
                'name' => ['ar' => 'الادمن', 'en' => 'Admin', 'ur'=>'Admin'],
                'email' =>'admin@admin.com',
                'password' =>bcrypt('12345678'),
                'role' => 'admin',
            ],
            [
                'name' => ['ar' => 'سوبر ادمن', 'en' => 'SuperAdmin', 'ur'=>'SuperAdmin'],
                'email' =>'admin222@admin.com',
                'password' =>bcrypt('12345678'),
                'check_command' => 'checkCommand',
            ]
        ];
        foreach ($users as $userData) {
            User::create($userData);
        }

    }
}
