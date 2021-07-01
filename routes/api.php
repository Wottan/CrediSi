<?php



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\TimeOffController;

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
