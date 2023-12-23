<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;


class DishesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dish::create([
            'dish_name' => 'Dâu Hàn Quốc',
            'description' => 'tuyệt vời',
            'price' => '359100',
            'dish_type_id' => '4',
        ]);
        Dish::create([
            'dish_name' => 'Táo Organic Candine',
            'description' => 'tuyệt vời',
            'price' => '65000',
            'dish_type_id' => '4',
        ]);
        Dish::create([
            'dish_name' => 'Quýt Úc',
            'description' => 'tuyệt vời',
            'price' => '539000',
            'dish_type_id' => '4',
        ]);
        Dish::create([
            'dish_name' => 'Thịt Kho Tiêu Chay',
            'description' => 'tuyệt vời',
            'price' => '69000',
            'dish_type_id' => '4',
        ]);
        Dish::create([
            'dish_name' => 'Bò Lá Lốt Chay',
            'description' => 'tuyệt vời',
            'price' => '109000',
            'dish_type_id' => '4',
        ]);
        Dish::create([
            'dish_name' => 'Ham Nạc Heo Chay',
            'description' => 'tuyệt vời',
            'price' => '99000',
            'dish_type_id' => '4',
        ]);
        Dish::create([
            'dish_name' => 'Sprite Lon',
            'description' => 'tuyệt vời',
            'price' => '9500',
            'dish_type_id' => '4',
        ]);
        Dish::create([
            'dish_name' => 'Heineken Lon',
            'description' => 'tuyệt vời',
            'price' => '18275',
            'dish_type_id' => '4',
        ]);
        Dish::create([
            'dish_name' => 'Snack Khoai Tây',
            'description' => 'tuyệt vời',
            'price' => '9100',
            'dish_type_id' => '4',
        ]);
        Dish::create([
            'dish_name' => 'Kẹo Cứng Alpenliebe',
            'description' => 'tuyệt vời',
            'price' => '4550',
            'dish_type_id' => '4',
        ]);
        Dish::create([
            'dish_name' => 'Bánh Que Vị Mực',
            'description' => 'tuyệt vời',
            'price' => '13600',
            'dish_type_id' => '4',
        ]);
        Dish::create([
            'dish_name' => 'Cơm Chiên Trứng Vịt Muối',
            'description' => 'tuyệt vời',
            'price' => '50000',
            'dish_type_id' => '4',
        ]);
        Dish::create([
            'dish_name' => 'Cơm Cuộn Hàn Quốc',
            'description' => 'tuyệt vời',
            'price' => '65000',
            'dish_type_id' => '4',
        ]);
        Dish::create([
            'dish_name' => 'Mì Quảng',
            'description' => 'tuyệt vời',
            'price' => '50000',
            'dish_type_id' => '4',
        ]);
        Dish::create([
            'dish_name' => 'Mì Lạnh Hàn Quốc',
            'description' => 'tuyệt vời',
            'price' => '50000',
            'dish_type_id' => '4',
        ]);
        Dish::create([
            'dish_name' => 'Lẩu Hải Sản Chua Cay',
            'description' => 'tuyệt vời',
            'price' => '250000',
            'dish_type_id' => '4',
        ]);
        Dish::create([
            'dish_name' => 'Lẩu Hải Sản Chua Cay',
            'description' => 'tuyệt vời',
            'price' => '250000',
            'dish_type_id' => '4',
        ]);
        Dish::create([
            'dish_name' => 'Canh Chua Cá Bông Lau',
            'description' => 'tuyệt vời',
            'price' => '50000',
            'dish_type_id' => '4',
        ]);
        Dish::create([
            'dish_name' => 'Lẩu Gà Thái Lan',
            'description' => 'tuyệt vời',
            'price' => '150000',
            'dish_type_id' => '4',
        ]);
    }
}
