<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AppoTestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvailableController;
use App\Http\Controllers\BarberController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ServiceController;
use App\Models\Appointment;
use App\Models\Service;
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

Route::apiResource('/posts', \App\Http\Controllers\PostsController::class);

route::post('/barbers', [BarberController::class, 'store']);
route::delete('/barbers/{id}', [BarberController::class, 'destroy']);
route::get('/barbers', [BarberController::class, 'index']);
route::get('/barbersAll/{id}', [BarberController::class, 'show']);
route::post('/available', [AvailableController::class, 'store']);
route::delete('/available/{id}', [AvailableController::class, 'destroy']);
Route::post('/appotest', [AppoTestController::class, 'store']);


Route::post('/service', [ServiceController::class, 'store']);
route::delete('/appointments/delete/{id}', [AppointmentController::class, 'destroy']);


Route::post('/admin', [AdminController::class, 'store']);
Route::delete('/admin', [AdminController::class, 'delete']);





// auth

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/appo', [AppointmentController::class, 'store']);
    Route::put('/appo/{id}', [AppointmentController::class, 'update']);
    //Route::apiResource('/agendamentos', \App\Http\Controllers\AppointmentController::class);
    Route::apiResource('/dates', \App\Http\Controllers\EventController::class);
    route::post('/logout', [AuthController::class, 'logout']);
    route::get('/appointments', [AppointmentController::class, 'one']);
    route::get('/available', [AvailableController::class, 'index']);
});
