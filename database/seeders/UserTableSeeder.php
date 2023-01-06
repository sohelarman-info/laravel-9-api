<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'Rafi', 'email' => 'rafi@gmail.com',  'password' => '12345678'],
            ['name' => 'Rakib', 'email' => 'rakib@gmail.com',  'password' => '12345'],
            ['name' => 'Milon', 'email' => 'Milon@gmail.com',  'password' => '12Milon'],
            ['name' => 'Mizan', 'email' => 'Mizan@gmail.com',  'password' => '1Mizan678']
        ];
        User::insert($users);
    }
}
