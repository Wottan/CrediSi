<?php

use Illuminate\Support\Facades\Route;

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

Route::view("/home", "home")
    ->middleware("auth")
    ->name("home");

Route::view("/login", "login")
    ->name("login");

Route::post(
    "/login",
    [App\Http\Controllers\LoginController::class, "authenticate"]
)->name("login-post");

Route::post(
    "/logout",
    [App\Http\Controllers\LoginController::class, "logout"]
)->name("logout");

Route::get(
    "/auth/redirect",
    [App\Http\Controllers\SocialiteLoginController::class, "redirectToLogin"]
)->name("socialite-login");

Route::get(
    "/auth/callback",
    [App\Http\Controllers\SocialiteLoginController::class, "redirectToHome"]
)->name("socialite-callback");
