<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{

    public function index()
    {
        return redirect()->route('login');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('user_id', 'password');

        if (!$credentials['user_id']) {
            return back()->withErrors(['failed' => 'Chưa nhập mã nhân viên']);
        }
        if (!$credentials['password']) {
            return back()->withErrors(['failed' => 'Chưa nhập mật khẩu'])->withInput($request->except('password'));
        }

        $user = User::find($credentials['user_id']);

        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Authentication passed
            Auth::login($user);

            $mode = $request->mode;
            Session::put('mode', $mode);

            return redirect()->intended('/dashboard'); // Redirect to intended page after login
        } else {
            // Authentication failed
            return back()->withErrors(['failed' => 'Sai tên đăng nhập hoặc mật khẩu'])->withInput($request->except('password'));
        }
    }

    public function logout()
    {
        Auth::logout();
        // Thực hiện hành động sau khi đăng xuất, ví dụ: chuyển hướng đến trang đăng nhập
        return redirect()->route('login');
    }
}
