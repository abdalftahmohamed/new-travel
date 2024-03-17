<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Profession;
use App\Models\User;
use Carbon\Carbon;
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
        User::create([
            'name' => 'admin',
            'email' =>'admin@admin.com',
            'password' =>bcrypt('12345678'),
            'role' => 'admin',
        ]);
    }
}
