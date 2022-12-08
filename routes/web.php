<?php

use App\Http\Controllers\All\AddsOnController;
use App\Http\Controllers\All\AddsOnElementController;
use App\Http\Controllers\All\BannerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\All\TypeController;
use App\Http\Controllers\All\RestaurantController;
use App\Http\Controllers\All\MealCategoryController;
use App\Http\Controllers\All\MealController;
use App\Http\Controllers\All\RestaurantReportController;
use App\Http\Controllers\All\GeneralManagementController;
use App\Http\Controllers\All\OrderController;
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

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//starting with Localization group
Route::group([
    'prefix' => LaravelLocalization::setlocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    // this for middleware so you can swap between lang and force to be a lang if it deleted will be back.
], function () {
    Auth::routes();

    Route::group([ 'middleware' => ['auth', ] ], function () {
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
        Route::get('meals-category/{id}', [MealCategoryController::class,'index'])->name('meal.category.index');
        Route::post('meals-category-store/{id}', [MealCategoryController::class,'store'])->name('meal.category.store');
        Route::post('meals-category-update/{id}', [MealCategoryController::class,'update'])->name('meal.category.update');
        Route::get('meals-category-delete/{id}', [MealCategoryController::class,'destroy'])->name('meal.category.delete');
        // meals pages
        Route::get('meals/{id}', [MealController::class,'index'])->name('meal.index');
        Route::get('add-meal/{id}',[MealController::class,'create'])->name('meal.create');
        Route::post('store-meal',[MealController::class,'store'])->name('meal.store');
        Route::get('edit-meal/{id}',[MealController::class,'edit'])->name('meal.edit');
        Route::post('update-meal/{id}',[MealController::class,'update'])->name('meal.update');
        Route::get('delete-meal/{id}',[MealController::class,'destroy'])->name('meal.delete');
        //adds on category
        Route::get('adds_ons_category/{id}', [AddsOnController::class,'index'])->name('addsOn.index');
        Route::post('store-adds_on_category/{id}',[AddsOnController::class,'store'])->name('addsOn.store');
        Route::post('update-adds_on_category/{id}',[AddsOnController::class,'update'])->name('addsOn.update');
        Route::get('delete-adds_on_category/{id}',[AddsOnController::class,'destroy'])->name('addsOn.delete');
        //adds on
        Route::get('adds_ons/{id}', [AddsOnElementController::class,'index'])->name('addsOn_element.index');
        Route::post('store-adds_on/{id}',[AddsOnElementController::class,'store'])->name('addsOn_element.store');
        Route::post('update-adds_on/{id}',[AddsOnElementController::class,'update'])->name('addsOn_element.update');
        Route::get('delete-adds_on/{id}',[AddsOnElementController::class,'destroy'])->name('addsOn_element.delete');
        // restaurant reports
        Route::get('restaurant_reports/{id}', [RestaurantReportController::class,'index'])->name('report.index');
        Route::post('show_report/{id}', [RestaurantReportController::class,'show'])->name('report.show');
        //general management pages
        Route::get('/home', [GeneralManagementController::class,'index'])->name('home');
        Route::post('store-management', [GeneralManagementController::class,'store'])->name('general.store');
        // orders
        Route::get('Restaurants.Order', [OrderController::class,'index'])->name('restaurant.order');
        Route::post('Restaurants.Order.Show', [OrderController::class,'show'])->name('order.show');
        //change status of the order
        Route::post('Restaurants.Order.prepare/{id}', [OrderController::class,'prepare'])->name('prepare_order');
        Route::post('Restaurants.Order.on_way/{id}', [OrderController::class,'on_way'])->name('on_way_order');
        Route::post('Restaurants.Order.delivered/{id}', [OrderController::class,'delivered'])->name('delivered_order');
        //banners
        Route::get('banners', [BannerController::class,'index'])->name('banner.index');
        Route::post('banner-store', [BannerController::class,'store'])->name('banner.store');
        Route::post('banner-update/{id}', [BannerController::class,'update'])->name('banner.update');
        Route::get('banner-delete/{id}', [BannerController::class,'destroy'])->name('banner.delete');
    });
});

