<?php

use App\Http\Controllers\ApiControllers\shared_controller\login_controller\LoginController;
use App\Http\Controllers\ApiControllers\shared_controller\shared_controller\CitiesController;
use App\Http\Controllers\ApiControllers\shared_controller\signup_controller\SignupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [LoginController::class ,'userLogin']);
Route::post('register', [SignupController::class ,'signUp']);
Route::get('cities', [CitiesController::class, 'getAllCities']); // used in sign up

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
