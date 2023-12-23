<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::create([
            'position_name' => 'Quản lý',
            'permission' => 1,
        ]);
        Position::create([
            'position_name' => 'Nhân viên',
            'permission' => 2,
        ]);
        Position::create([
            'position_name' => 'Phục vụ',
            'permission' => 3,
        ]);
        Position::create([
            'position_name' => 'Đầu bếp',
            'permission' => 4,
        ]);
    }
}
