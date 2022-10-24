<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    Route::get('logout', [Auth\AuthController::class, 'logout'])->name('logout');
    return $request->user();
});

Route::middleware('policy')->namespace('Panel')->group(function () {
    Route::prefix('panel')->group(function () {
        Route::get('users', [UserController::class, 'index'])->name('user-index');
    });
});
/*
 * Authentication Routes.
 */
Route::namespace('Auth')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

