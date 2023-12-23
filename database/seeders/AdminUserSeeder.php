<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->user_id = '12345678';
        $admin->last_name = 'Lê';
        $admin->first_name = 'Phúc Bình';
        $admin->gender = 1;
        $admin->birth_date = '1998-1-1';
        $admin->phone = '0978964219';
        $admin->email = 'admin@gmail.com';
        $admin->password = Hash::make('default');
        $admin->address_id = 1;
        $admin->position_id = 1;
        $admin->save();
    }
}
