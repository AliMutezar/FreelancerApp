<?php

namespace Database\Seeders;

use App\Models\DetailUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $detail_user = [
            [
                'user_id'   =>  1,
                'photo'     =>  '',
                'role'      =>  'Fullstack Developer',
                'contact_number' => '+62 878 8386 4673',
                'biography'  => 'Nama saya Ali',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'user_id'   =>  2,
                'photo'     =>  '',
                'role'      =>  'Keuangan',
                'contact_number' => '+62 878 8386 4673',
                'biography'  => 'Nama saya Sahira',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DetailUser::insert($detail_user);
    }
}
