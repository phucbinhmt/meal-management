<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UtilitiesController extends Controller
{
    public function mode(Request $request)
    {
        Session::put('mode', $request->mode);
        return response()->json(['mode' => $request->mode]);
    }
}
