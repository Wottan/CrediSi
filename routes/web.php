<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SocialiteLoginController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShiftController;


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

Route::get('{any?}', function () {
    return view('app');
});

Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::get('/login/check', [LoginController::class, 'check']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get(
    "/auth/redirect",
    [SocialiteLoginController::class, "redirectToLogin"]
)->name("socialite-login");

Route::get(
    "/auth/callback",
    [SocialiteLoginController::class, "redirectToHome"]
)->name("socialite-callback");

Route::prefix('api')->middleware('auth')->group(function () {
    //Users
    Route::put('users/{user}/sync', [UserController::class, 'syncLabels']);

    //Labels
    Route::post('labels/upsert', [LabelController::class, 'upsert']);
    Route::put('labels/bulk', [LabelController::class, 'bulkUpdate']);

    //Shifts
    Route::put('shifts/{shift}/sync', [ShiftController::class, 'syncLabels']);
    Route::get('shifts/active', [ShiftController::class, 'active'])->name("active-shifts");
    Route::get('shifts/today', [ShiftController::class, 'today']);

    Route::resources([
        'users' => UserController::class,
        'labels' => LabelController::class,
        'shifts' => ShiftController::class,
        'timeoff' => TimeOffController::class,
    ]);
});

