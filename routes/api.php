<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Panel\UserController;

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

// Route::middleware('policy')->group(function () {
    Route::prefix('panel')->group(function () {
        Route::namespace('Panel')->group(function () {
            Route::resource('users', 'UserController')->names([
                'index' => 'user-index'
            ]);
            Route::resource('article-categories', 'ArticleCategoryController')->names([
                'index' => 'article-category-index'
            ]);
            Route::resource('articles', 'ArticleController')->names([
                'index' => 'article-index'
            ]);
            Route::resource('product-categories', 'ProductCategoryController')->names([
                'index' => 'product-category-index'
            ]);
            Route::resource('products', 'ProductController')->names([
                'index' => 'product-index'
            ]);
            Route::resource('banks', 'BankController')->names([
                'index' => 'bank-index'
            ]);
            Route::resource('brands', 'BrandController')->names([
                'index' => 'brand-index'
            ]);
            Route::resource('transactions', 'TransactionController')->names([
                'index' => 'transaction-index'
            ]);
        });
    });
// });
/*
 * Authentication Routes.
 */
Route::namespace('Auth')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

