<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
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

Route::post('/authenticate', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=> 'admin'],function(){
  Route::post('login', [AuthController::class, 'login']);
  Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
    $user = $request->user()->currentAccessToken()->delete();
    $user->tokens()->delete();
    // logout of the SPA
    Auth::guard('web')->logout();
    return ['status' => 'OK'];
});

Route::get('categories', [CategoryController::class, 'index']);
Route::post('add/category',[CategoryController::class, 'store']);
Route::delete('delete/category/{id}', [CategoryController::class, 'destroy']);
Route::post('update/category/{id}', [CategoryController::class, 'update']);
Route::post('add/product', [ProductController::class, 'store']);
Route::get('products', [ProductController::class, 'index']);
Route::delete('delete/product/{id}', [ProductController::class, 'destroy']);

Route::post('update/product/{id}', [ProductController::class, 'update']);

Route::get('latestProducts', [ProductController::class, 'latestProducts']);
// Route::get('{any?}', function(){
//   return view('welcome');
// })->where('any', '.*');