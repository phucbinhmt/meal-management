<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Position;
use App\Models\Address;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Utilities\PasswordHelper;
use App\Utilities\StringHelper;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::query();

        if ($request->position_id != null) {
            $users->where('position_id', $request->position_id);
        }
        if ($request->status != null) {
            $users->where('status', $request->status);
        }
        if ($request->keyword != null) {
            $users->where(function($query) use ($request) {
                $query->where('user_id', 'like', '%' . $request->keyword . '%')
                    ->orWhereRaw("CONCAT(last_name, ' ', first_name) like '%$request->keyword%'");
            });
        }
        
        $users = $users->orderByRaw("SUBSTRING_INDEX(first_name, ' ', -1) ASC");

        $users = $users->paginate(10);
        
        $positions = Position::where('permission', '!=', config('constants.ADMIN_PERMISSION'))->get();

        return view('users.index')->with([
            'title' => 'Danh sách nhân viên',
            'positions' => $positions,
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = Position::where('permission', '!=', config('constants.ADMIN_PERMISSION'))->get();
        $addresses = Address::all();

        return view('users.create')->with([
            'title' => 'Thêm nhân viên',
            'positions' => $positions,
            'addresses' => $addresses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    { 
        if ($request->hasFile('image_upload')) {
            $image_name = $request->user_id . '.' . $request->image_upload->extension();
            $request->image_upload->move(public_path('images/users'), $image_name);
            $request->merge([
                'image' => $image_name,
            ]);
        }

        $request->merge([
            // 'password' => Hash::make(PasswordHelper::generateStrongPassword()), // encrypt password and save, after then, send mail
            'password' => Hash::make('default'), // encrypt password and save, after then, send mail
        ]);

        User::create($request->all());

        return redirect()->route('users.index')->with([
            'success' => 'Thêm nhân viên thành công',
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
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.index')->with([
                'failed' => 'Nhân viên không tồn tại',
            ]);
        }
        return view('users.show')->with([
            'title' => 'Chi tiết nhân viên',
            'user' => $user,
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
        $positions = Position::where('permission', '!=', config('constants.ADMIN_PERMISSION'))->get();
        $addresses = Address::all();

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')->with([
                'failed' => 'Nhân viên không tồn tại',
            ]);
        }

        return view('users.edit')->with([
            'title' => 'Cập nhật nhân viên',
            'positions' => $positions,
            'addresses' => $addresses,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')->with([
                'failed' => 'Nhân viên không tồn tại',
            ]);
        }

        if ($request->hasFile('image_upload')) {
            $image_name = $user->user_id . '.' . $request->image_upload->extension();
            $request->image_upload->move(public_path('images/users'), $image_name);
            $request->merge([
                'image' => $image_name,
            ]);
        }

        $user->update($request->except('user_id'));

        $back_url = route('users.index');
        $show_url = route('users.show', $user->user_id);

        if ($show_url == strtok(session()->get('previous_url'), '?')) {
            $back_url = $show_url;
        } elseif ($back_url == strtok(session()->get('previous_url'), '?')) {
            $back_url = session()->get('previous_url');
        }
        
        return redirect()->to($back_url)->with([
            'success' => 'Cập nhật nhân viên thành công',
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
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')->with([
                'failed' => 'Nhân viên không tồn tại',
            ]);
        }

        $user->delete();

        $back_url = route('users.index');

        if ($back_url == strtok(url()->previous(), '?')) {
            $back_url = url()->previous();
        } elseif ($back_url == strtok(session()->get('previous_url'), '?')) {
            $back_url = session()->get('previous_url');
        }
        
        return redirect()->to($back_url)->with([
            'success' => 'Xóa nhân viên thành công',
        ]);
    }
}
