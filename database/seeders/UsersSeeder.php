<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'user_id' => 'NV20235544',
            'last_name' => 'Từ',
            'first_name' => 'Tùy Lan',
            'gender' => 2,
            'birth_date' => '1995-06-22',
            'phone' => '06508411298',
            'email' => 'tulan95@gmail.com',
            'password' => Hash::make('default'),
            'address_id' => 32,
            'position_id' => 2,
        ]);

        User::create([
            'user_id' => 'NV20232674',
            'last_name' => 'Lâm',
            'first_name' => 'Bích Tiên',
            'gender' => 2,
            'birth_date' => '1981-11-20',
            'phone' => '0379497714',
            'email' => 'cam.dieu@boranora.com',
            'password' => Hash::make('default'),
            'address_id' => 32,
            'position_id' => 2,
        ]);

        User::create([
            'user_id' => 'NV20230937',
            'last_name' => 'Trác',
            'first_name' => 'Đại Hiển',
            'gender' => 1,
            'birth_date' => '1995-06-27',
            'phone' => '01264484150',
            'email' => 'cai.dinh@islandshomecareagency.com',
            'password' => Hash::make('default'),
            'address_id' => 32,
            'position_id' => 2,
        ]);

        User::create([
            'user_id' => 'NV20234509',
            'last_name' => 'Tông',
            'first_name' => 'Huệ Phong',
            'gender' => 2,
            'birth_date' => '2003-04-17',
            'phone' => '01643795624',
            'email' => 'thanh54@jwpemail.xyz',
            'password' => Hash::make('default'),
            'address_id' => 32,
            'position_id' => 2,
        ]);
        User::create([
            'user_id' => 'NV20239834',
            'last_name' => 'Phùng',
            'first_name' => 'Lập Thúc',
            'gender' => 1,
            'birth_date' => '1992-03-26',
            'phone' => '0758672160',
            'email' => 'do.nguyen@cd2in.com',
            'password' => Hash::make('default'),
            'address_id' => 32,
            'position_id' => 2,
        ]);
        User::create([
            'user_id' => 'NV20223757',
            'last_name' => 'Phạm',
            'first_name' => 'Thuần',
            'gender' => 2,
            'birth_date' => '1971-10-29',
            'phone' => '0584390415',
            'email' => 'kinh91@kccprocess.com',
            'password' => Hash::make('default'),
            'address_id' => 32,
            'position_id' => 2,
        ]);
        User::create([
            'user_id' => 'NV20213483',
            'last_name' => 'Quách',
            'first_name' => 'Quế',
            'gender' => 2,
            'birth_date' => '1978-08-08',
            'phone' => '0972431782',
            'email' => 'trinh.chi@getabccleaning.com',
            'password' => Hash::make('default'),
            'address_id' => 32,
            'position_id' => 2,
        ]);

    }
}
