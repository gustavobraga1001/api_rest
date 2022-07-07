<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PostsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use app\Models\User;

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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/teste', function(){
    echo "teste";
});



Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::apiResource('posts', \App\Http\Controllers\PostsController::class);
    Route::apiResource('dates', \App\Http\Controllers\EventController::class);
    route::post('/logout', [AuthController::class, 'logout']);
});
