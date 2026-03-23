<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, X-Auth-Token, Origin, Authorization');


Route::get('/products/all', [ProductController::class, 'all']);

Route::resource('products', ProductController::class);
Route::resource('productCategories', ProductCategoryController::class);
Route::resource('blog', BlogController::class);
Route::resource('pages', PageController::class);
Route::resource('fb', FeedbackController::class);
Route::resource('mn', MenuController::class);
Route::resource('settings', SettingController::class);