<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\AuthController;

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

Route::middleware(['auth:sanctum'])->group(function () {
    // Route::get('logout', [AuthController::class, 'logout'])->name('logout');


    Route::middleware('policy')->group(function () {
        Route::prefix('panel')->group(function () {
            Route::namespace('Panel')->group(function () {
                Route::resource('users', 'UserController');
                Route::resource('article-categories', 'ArticleCategoryController');
                Route::resource('articles', 'ArticleController');
                Route::resource('product-categories', 'ProductCategoryController');
                Route::resource('products', 'ProductController');
                Route::resource('banks', 'BankController');
                Route::resource('brands', 'BrandController');
                Route::resource('transactions', 'TransactionController');
                Route::resource('orders', 'OrderController');
                Route::resource('wallets', 'WalletController');
                Route::resource('carts', 'CartController');
                Route::resource('permissions', 'PermissionController');
            });
        });
        Route::prefix('profile')->group(function () {
            Route::namespace('Profile')->group(function () {
                Route::get('/', 'ProfileController@index');
                Route::patch('/', 'ProfileController@update');
                Route::patch('change-password', 'ProfileController@changePassword');
                Route::get('cart', 'CartController@index');
                Route::post('cart/add', 'CartController@addToCart');
                Route::delete('cart/remove', 'CartController@removeFromCart');
            });
        });
    });
});
/*
 * Authentication Routes.
 */
Route::namespace('Auth')->group(function () {
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('register', 'AuthController@register')->name('register');
});

