<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DishType;

class DishTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DishType::create([
            'dish_type_name' => 'Món Chính',
        ]);
        DishType::create([
            'dish_type_name' => 'Món Canh',
        ]);
        DishType::create([
            'dish_type_name' => 'Món Chay',
        ]);
        DishType::create([
            'dish_type_name' => 'Lẩu',
        ]);
        DishType::create([
            'dish_type_name' => 'Đồ uống',
        ]);
        DishType::create([
            'dish_type_name' => 'Trái cây',
        ]);
        DishType::create([
            'dish_type_name' => 'Ăn vặt',
        ]);
    }
}
