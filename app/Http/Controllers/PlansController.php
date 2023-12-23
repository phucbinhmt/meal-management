<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use App\Models\Plan;
use App\Models\Menu;
use App\Models\Dish;
use App\Models\DishType;
use Illuminate\Support\Facades\Auth;

class PlansController extends Controller
{
    public function show($date, $session)
    {
        try {
            $date_parse = Carbon::createFromFormat('Y-m-d', $date);
        } catch (\Carbon\Exceptions\InvalidFormatException $e) {
            return redirect()->route('plans.show', [Carbon::now()->format('Y-m-d'), 1]);
        }

        $plan = Plan::where('user_id', Auth::user()->user_id)
            ->whereDate('date', $date_parse)
            ->where('session', $session)
            ->first();

        return view('plans.show')->with([
            'title' => 'Suất ăn',
            'plan' => $plan,
            'date' => $date,
            'session' => $session,
            'date_parse' => $date_parse,
        ]);
    }

    public function edit($date, $session)
    {
        try {
            $date_parse = Carbon::createFromFormat('Y-m-d', $date);
        } catch (\Carbon\Exceptions\InvalidFormatException $e) {
            return redirect()->route('plans.show', [Carbon::now()->format('Y-m-d'), 1]);
        }

        if ($date_parse->lessThan(now())) {
            return redirect()->route('plans.show', [$date, $session])->with([
                'failed' => 'Cập nhật suất ăn phải trước 24h',
            ]);
        }

        $menu = Menu::whereDate('date', $date_parse)->first();

        $plan = Plan::where('user_id', Auth::user()->user_id)
            ->whereDate('date', $date_parse)
            ->where('session', $session)
            ->first();

        $dish_types = DishType::all();

        return view('plans.edit')->with([
            'title' => 'Cập nhật suất ăn',
            'dish_types' => $dish_types,
            'date' => $date,
            'session' => $session,
            'menu' => $menu,
            'plan' => $plan,
        ]);
    }

    public function update(Request $request, $date, $session)
    {
        try {
            $date_parse = Carbon::createFromFormat('Y-m-d', $date);
        } catch (\Carbon\Exceptions\InvalidFormatException $e) {
            return redirect()->route('plans.show', [Carbon::now()->format('Y-m-d'), 1]);
        }


        $plan = Plan::where('user_id', Auth::user()->user_id)
            ->whereDate('date', $date_parse)
            ->where('session', $session)
            ->first();
        if (!$plan) {
            Plan::create([
                'date' => $date_parse,
                'session' => $session,
                'user_id' => Auth::user()->user_id,
            ]);
            $plan = Plan::where('user_id', Auth::user()->user_id)
            ->whereDate('date', $date_parse)
            ->where('session', $session)
            ->first();
        }

        $data = json_decode($request->input('dishes'), true);
        $plan->dishes()->sync($data);

        if ($plan->dishes->count() == 0) {
            $plan->delete();
        }

        return redirect()->route('plans.show', [$date, $session])->with([
            'success' => 'Cập nhật suất ăn thành công',
        ]);
    }

    public function search(Request $request, $date, $session)
    {
        try {
            $date_parse = Carbon::createFromFormat('Y-m-d', $date);
        } catch (\Carbon\Exceptions\InvalidFormatException $e) {
            return redirect()->route('search', [Carbon::now()->format('Y-m-d'), 1]);
        }

        $plans = Plan::query();
        if ($request->keyword != null) {
            $plans->where('user_id', 'like', '%' . $request->keyword . '%');
        }
        $plans->whereDate('date', $date_parse)->where('session', $session);
        $plans = $plans->get();

        return view('plans.search')->with([
            'title' => 'Phát suất ăn',
            'date' => $date,
            'session' => $session,
            'date_parse' => $date_parse,
            'plans' => $plans,
        ]);
    }

    public function cooking($date, $session)
    {
        try {
            $date_parse = Carbon::createFromFormat('Y-m-d', $date);
        } catch (\Carbon\Exceptions\InvalidFormatException $e) {
            return redirect()->route('cooking', [Carbon::now()->format('Y-m-d'), 1]);
        }

        $plans = Plan::whereDate('date', $date_parse)->where('session', $session)->get();

        $listDishes = [];
        foreach ($plans as $plan) {
            foreach ($plan->dishes as $dish) {
                if (isset($listDishes[$dish->dish_id])) {
                    $listDishes[$dish->dish_id]['total'] += $dish->pivot->quantity;
                } else {
                    $listDishes[$dish->dish_id] = [
                        'dish' => $dish,
                        'total' => $dish->pivot->quantity,
                        'status' => $plan->status,
                    ];
                }
            }
        }

        return view('plans.cooking')->with([
            'title' => 'Chuẩn bị món ăn',
            'date' => $date,
            'session' => $session,
            'date_parse' => $date_parse,
            'list_dishes' => $listDishes,
        ]);
    }

    public function status(Request $request)
    {
        
        $status = '';
        $message = '';

        if ($request->plan_id) {
            $plan = Plan::find($request->plan_id);
            if ($plan->status == config('constants.READY_PLAN')) {
                $plan->update([
                    'status' => config('constants.SERVED_PLAN'),
                ]);
                $status = 'success';
                $message = 'Phát suất ăn thành công';
            } else {
                $status = 'failed';
                $message = 'Suất ăn chưa hoàn thành hoặc đã phát';
            }
        } else {
            $plans = Plan::whereDate('date', $request->date)->where('session', $request->session)->get();
            foreach ($plans as $plan) {
                if ($plan->status == config('constants.WAITING_PLAN')) {
                    $plan->update([
                        'status' => config('constants.READY_PLAN'),
                    ]);
                    $status = 'success';
                    $message = 'Chuẩn bị món ăn thành công';
                } else {
                    $status = 'failed';
                    $message = 'Tất cả món ăn đã hoàn thành';
                }
            }
        }

        if ($status) {
            return redirect()->back()->with([
                $status => $message,
            ]);
        }

        return redirect()->back();
    }
}
