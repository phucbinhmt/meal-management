<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Dish;
use App\Models\DishType;
use App\Http\Requests\StoreDishRequest;

class DishesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dishes = Dish::query();
        if ($request->dish_type_id != null) {
            $dishes->where('dish_type_id', $request->dish_type_id);
        }
        if ($request->status != null) {
            $dishes->where('status', $request->status);
        }
        if ($request->keyword != null) {
            $dishes->where(function($query) use ($request) {
                $query->where('dish_id', 'like', '%' . $request->keyword . '%')
                    ->orWhere('dish_name', 'like', '%' . $request->keyword  . '%');
            });
        }
        $dishes = $dishes->orderBy('dish_name');
        $dishes = $dishes->paginate(10);

        $dish_types = DishType::all();

        return view('dishes.index')->with([
            'title' => 'Danh sách món ăn',
            'dish_types' => $dish_types,
            'dishes' => $dishes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dish_types = DishType::all();

        return view('dishes.create')->with([
            'title' => 'Thêm món ăn',
            'dish_types' => $dish_types,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDishRequest $request)
    {

        $dish = Dish::create($request->except('image'));

        if ($request->hasFile('image_upload')) {
            $image_name = $dish->dish_id . '.' . $request->image_upload->extension();
            $request->image_upload->move(public_path('images/dishes'), $image_name);
        }

        $dish->update([
            'image' => $image_name,
        ]);

        return redirect()->route('dishes.index')->with([
            'success' => 'Thêm món ăn thành công',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dish = Dish::find($id);
        if (!$dish) {
            return redirect()->route('dishes.index')->with([
                'failed' => 'Món ăn không tồn tại',
            ]);
        }
        return view('dishes.show')->with([
            'title' => 'Chi tiết món ăn',
            'dish' => $dish,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dish_types = DishType::all();
        $dish = Dish::find($id);

        if (!$dish) {
            return redirect()->route('dishes.index')->with([
                'failed' => 'Món ăn không tồn tại',
            ]);
        }

        return view('dishes.edit')->with([
            'title' => 'Cập nhật món ăn',
            'dish_types' => $dish_types,
            'dish' => $dish,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDishRequest $request, $id)
    {
        $dish = Dish::find($id);

        if (!$dish) {
            return redirect()->route('dishes.index')->with([
                'failed' => 'Món ăn không tồn tại',
            ]);
        }

        if ($request->hasFile('image_upload')) {
            $image_name = $dish->dish_id . '.' . $request->image_upload->extension();
            $request->image_upload->move(public_path('images/dishes'), $image_name);
            $request->merge([
                'image' => $image_name,
            ]);
        }

        $dish->update($request->all());

        $back_url = route('dishes.index');
        $show_url = route('dishes.show', $dish->dish_id);

        if ($show_url == strtok(session()->get('previous_url'), '?')) {
            $back_url = $show_url;
        } elseif ($back_url == strtok(session()->get('previous_url'), '?')) {
            $back_url = session()->get('previous_url');
        }
        
        return redirect()->to($back_url)->with([
            'success' => 'Cập nhật món ăn thành công',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dish = Dish::find($id);

        if (!$dish) {
            return redirect()->route('dishes.index')->with([
                'failed' => 'Món ăn không tồn tại',
            ]);
        }

        $dish->delete();

        $back_url = route('dishes.index');

        if ($back_url == strtok(url()->previous(), '?')) {
            $back_url = url()->previous();
        } elseif ($back_url == strtok(session()->get('previous_url'), '?')) {
            $back_url = session()->get('previous_url');
        }
        
        return redirect()->to($back_url)->with([
            'success' => 'Xóa món ăn thành công',
        ]);
    }
}
