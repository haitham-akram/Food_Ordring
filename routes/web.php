<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\All\TypeController;
use App\Http\Controllers\All\RestaurantController;
use App\Http\Controllers\All\MealCategoryController;
use App\Http\Controllers\All\MealController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//starting with Localization group
Route::group([
    'prefix' => LaravelLocalization::setlocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    // this for middleware so you can swap between lang and force to be a lang if it deleted will be back.
], function () {
    Auth::routes();

    Route::group([ 'middleware' => ['auth', ] ], function () {
        Route::get('/home', function () {
//            return view('restaurant.index');
        })->name('Home');

        //restaurant category pages
        Route::get('restaurant-category', [TypeController::class,'index'])->name('category.restaurant.index');
        Route::post('store-restaurant-category',  [TypeController::class,'store'])->name('store.category.restaurant');
        Route::post('update-restaurant-category/{id}',  [TypeController::class,'update'])->name('update.category.restaurant');
        Route::get('delete-restaurant-category/{id}',  [TypeController::class,'destroy'])->name('delete.category.restaurant');
        //restaurants pages
        Route::get('restaurants', [RestaurantController::class,'index'])->name('restaurant.list');
        Route::get('add-restaurant',[RestaurantController::class,'create'])->name('restaurant.create');
        Route::post('store-restaurant', [RestaurantController::class,'store'])->name('restaurant.store');
        Route::get('edit-restaurant/{id}', [RestaurantController::class,'edit'])->name('restaurant.edit');
        Route::post('update-restaurant/{id}',[RestaurantController::class,'update'])->name('restaurant.update');
        Route::get('delete-restaurant/{id}', [RestaurantController::class,'destroy'])->name('restaurant.delete');
        //meals category
        Route::get('meals-category', [MealCategoryController::class,'index'])->name('meal.category.index');
        Route::post('meals-category-store', [MealCategoryController::class,'store'])->name('meal.category.store');
        Route::post('meals-category-update/{id}', [MealCategoryController::class,'update'])->name('meal.category.update');
        Route::get('meals-category-delete/{id}', [MealCategoryController::class,'destroy'])->name('meal.category.delete');
        // meals pages
        Route::get('meals', [MealController::class,'index'])->name('meal.index');
        Route::get('add-meal',[MealController::class,'create'])->name('meal.create');
        Route::post('store-meal',[MealController::class,'store'])->name('meal.store');
        Route::get('edit-meal/{id}',[MealController::class,'edit'])->name('meal.edit');
        Route::post('update-meal/{id}',[MealController::class,'update'])->name('meal.update');
        Route::get('delete-meal/{id}',[MealController::class,'destroy'])->name('meal.delete');

    });
});

