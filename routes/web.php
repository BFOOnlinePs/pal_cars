<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('web_app_home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'dashboard','middleware'=>'auth'],function (){
    Route::get('index',[App\Http\Controllers\dashboard\HomeController::class , 'index'])->name('dashboard.index');
    Route::group(['prefix'=>'users'],function (){
        Route::get('index',[App\Http\Controllers\dashboard\admin\users\UserController::class , 'index'])->name('dashboard.users.index');
        Route::get('add_form',[App\Http\Controllers\dashboard\admin\users\UserController::class, 'add_form'])->name('dashboard.users.add_form');
        Route::post('create',[App\Http\Controllers\dashboard\admin\users\UserController::class, 'create'])->name('dashboard.users.create');
    });
    Route::group(['prefix'=>'settings'],function (){
        Route::get('index',[App\Http\Controllers\dashboard\admin\settings\SettingsController::class , 'index'])->name('dashboard.settings.index');
        Route::group(['prefix'=>'cities'],function (){
            Route::get('index',[App\Http\Controllers\dashboard\admin\settings\CitiesController::class , 'index'])->name('dashboard.settings.cities.index');
            Route::post('create',[App\Http\Controllers\dashboard\admin\settings\CitiesController::class , 'create'])->name('dashboard.settings.cities.create');
            Route::post('get',[App\Http\Controllers\dashboard\admin\settings\CitiesController::class , 'get'])->name('dashboard.settings.cities.get');
            Route::post('update',[App\Http\Controllers\dashboard\admin\settings\CitiesController::class , 'update'])->name('dashboard.settings.cities.update');
        });
        Route::group(['prefix'=>'cars_type'],function (){
            Route::get('index',[App\Http\Controllers\dashboard\admin\settings\CarsTypeController::class , 'index'])->name('dashboard.settings.cars_type.index');
            Route::post('create',[App\Http\Controllers\dashboard\admin\settings\CarsTypeController::class , 'create'])->name('dashboard.settings.cars_type.create');
            Route::post('delete',[App\Http\Controllers\dashboard\admin\settings\CarsTypeController::class , 'delete'])->name('dashboard.settings.cars_type.delete');
            Route::post('update',[App\Http\Controllers\dashboard\admin\settings\CarsTypeController::class , 'update'])->name('dashboard.settings.cars_type.update');
            Route::get('car_models/{id}',[App\Http\Controllers\dashboard\admin\settings\CarsTypeController::class , 'car_models'])->name('dashboard.settings.cars_type.car_models');
            Route::post('createCarModel',[App\Http\Controllers\dashboard\admin\settings\CarsTypeController::class , 'createCarModel'])->name('dashboard.settings.cars_type.createCarModel');
            Route::post('deleteCarModel',[App\Http\Controllers\dashboard\admin\settings\CarsTypeController::class , 'deleteCarModel'])->name('dashboard.settings.cars_type.deleteCarModel');
            Route::post('updateCarModel',[App\Http\Controllers\dashboard\admin\settings\CarsTypeController::class , 'updateCarModel'])->name('dashboard.settings.cars_type.updateCarModel');
        });
    });
});
