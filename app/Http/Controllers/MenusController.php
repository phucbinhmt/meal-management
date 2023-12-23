<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use App\Models\Menu;
use App\Models\Dish;
use App\Models\DishType;

class MenusController extends Controller
{
    public function show($date)
    {
        try {
            $date_parse = Carbon::createFromFormat('Y-m-d', $date);
        } catch (\Carbon\Exceptions\InvalidFormatException $e) {
            return redirect()->route('menus.show', Carbon::now()->format('Y-m-d'));
        }

        $menu = Menu::whereDate('date', $date_parse)->first();
        return view('menus.show')->with([
            'title' => 'Thực đơn',
            'menu' => $menu,
            'date' => $date,
            'date_parse' => $date_parse,
        ]);
    }

    public function edit($date)
    {
        try {
            $date_parse = Carbon::createFromFormat('Y-m-d', $date);
        } catch (\Carbon\Exceptions\InvalidFormatException $e) {
            return redirect()->route('menus.show', Carbon::now()->format('Y-m-d'));
        }

        $menu = Menu::whereDate('date', $date_parse)->first();
        $dish_types = DishType::all();

        return view('menus.edit')->with([
            'title' => 'Cập nhật thực đơn',
            'dish_types' => $dish_types,
            'date' => $date,
            'menu' => $menu,
        ]);
    }

    protected function arrayValues($array)
    {
        $onlyValues = [];        
        foreach ($array as $item) {
            $onlyValues[] = $item['dish_id'];
        }
        return $onlyValues;
    }

    protected function checkDuplicate($menu, $data)
    {
        if ($menu) {
            $count = 0;
            $onlyValues = $this->arrayValues($data);
            
            foreach ($menu->dishes as $dish) {
                if (in_array($dish->dish_id, $onlyValues)) {
                    $count += 1;
                }
            }
        
            if ($count > count($onlyValues) * 0.5) {
                return true;
            }
        }
        return false;
    }

    public function update(Request $request, $date)
    {
        try {
            $date_parse = Carbon::createFromFormat('Y-m-d', $date);
        } catch (\Carbon\Exceptions\InvalidFormatException $e) {
            return redirect()->route('menus.show', Carbon::now()->format('Y-m-d'));
        }

        $menu = Menu::whereDate('date', $date_parse)->first();
        if (!$menu) {
            Menu::create([
                'date' => $date_parse,
            ]);
            $menu = Menu::whereDate('date', $date_parse)->first();
        }

        $data = json_decode($request->input('dishes'), true);
        
        $menu_previous = Menu::whereDate('date', $date_parse->copy()->subDay())->first();
        if ($this->checkDuplicate($menu_previous, $data)) {
            return redirect()->back()->withInput()->with([
                'failed' => 'Thực đơn trùng quá nửa hôm qua',
            ]);
        }

        $menu_next = Menu::whereDate('date', $date_parse->copy()->addDay())->first();
        if ($this->checkDuplicate($menu_next, $data)) {
            return redirect()->back()->withInput()->with([
                'failed' => 'Thực đơn trùng quá nửa hôm sau',
            ]);
        }

        $menu->dishes()->sync($data);

        if ($menu->dishes->count() == 0) {
            $menu->delete();
        }

        return redirect()->route('menus.show', $date)->with([
            'success' => 'Cập nhật thực đơn thành công',
        ]);
    }
}
