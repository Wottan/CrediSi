<?php

use App\Http\Controllers\LabelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SocialiteLoginController;
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

Route::post('/api/login', [LoginController::class, 'authenticate']);
Route::post('/api/logout', [LoginController::class, 'logout']);

Route::resources([
    '/api/users' => UserController::class,
    '/api/labels' => LabelController::class,
    '/api/shifts' => ShiftController::class,
]);

Route::get('/api/shifts/active', [ShiftController::class,'active'])->name("active-shifts");

Route::get(
    "/auth/redirect",
    [SocialiteLoginController::class, "redirectToLogin"]
)->name("socialite-login");

Route::get(
    "/auth/callback",
    [SocialiteLoginController::class, "redirectToHome"]
)->name("socialite-callback");
