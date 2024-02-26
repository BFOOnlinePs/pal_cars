<?php

use App\Http\Controllers\ApiControllers\shared_controller\login_controller\LoginController;
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

Route::post('user_login', [LoginController::class ,'userLogin']);
Route::post('sign_up', [SignupController::class ,'signUp']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
