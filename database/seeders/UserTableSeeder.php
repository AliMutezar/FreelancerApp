<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'      =>  'Ali Mutezar',
                'email'     =>  'aamutezar@gmail.com',
                'password'  =>  Hash::make('password'),
                'remember_token' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name'      =>  'Sahira Salsabila',
                'email'     =>  'sahira@gmail.com',
                'password'  =>  Hash::make('password'),
                'remember_token' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        User::insert($users);
    }
}
