<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DishesController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\UtilitiesController;
use App\Http\Controllers\ErrorsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/mode', [UtilitiesController::class, 'mode']);

Route::get('/403', [ErrorsController::class, 'code403'])->name('403');

Route::middleware('permission')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/commingsoon', function () {
        return view('commingsoon');
    })->name('commingsoon');

    Route::prefix('plans')->group(function () {
        Route::post('/status', [PlansController::class, 'status'])->name('plans.status');
    });
});

Route::middleware('permission:' . config('constants.ADMIN_PERMISSION'))->group(function () {
    Route::resource('users', UsersController::class);
    Route::resource('dishes', DishesController::class);

    Route::prefix('menus')->group(function () {
        Route::get('/{date}', [MenusController::class, 'show'])->name('menus.show');
        Route::put('/{date}', [MenusController::class, 'update'])->name('menus.update');
        Route::get('/{date}/edit', [MenusController::class, 'edit'])->name('menus.edit');
    });
});



Route::middleware('permission:' . config('constants.SERVER_PERMISSION'))->group(function () {
    Route::get('/search/{date}/{session}', [PlansController::class, 'search'])->name('search');
});

Route::middleware('permission:' . config('constants.COOK_PERMISSION'))->group(function () {
    Route::get('/cooking/{date}/{session}', [PlansController::class, 'cooking'])->name('cooking');
});

Route::middleware('permission:' . config('constants.EMPLOYEE_PERMISSION'))->group(function () {
    Route::prefix('plans')->group(function () {
        Route::get('/{date}/{session}', [PlansController::class, 'show'])->name('plans.show');
        Route::put('/{date}/{session}', [PlansController::class, 'update'])->name('plans.update');
        Route::get('/{date}/{session}/edit', [PlansController::class, 'edit'])->name('plans.edit');
    });
});
