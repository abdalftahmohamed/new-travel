<?php

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

Route::group([
    'middleware' => 'auth:adminApi',
    'prefix' => 'v1/admin'
], function ($router) {
    Route::post('/login', [\App\Http\Controllers\Api\Admin\AuthController::class, 'login'])->withoutMiddleware('auth:adminApi');
    Route::post('/register', [\App\Http\Controllers\Api\Admin\AuthController::class, 'register']);
    Route::post('/logout', [\App\Http\Controllers\Api\Admin\AuthController::class, 'logout']);
    Route::post('/refresh', [\App\Http\Controllers\Api\Admin\AuthController::class, 'refresh']);
    Route::get('/user-profile', [\App\Http\Controllers\Api\Admin\AuthController::class, 'userProfile']);



    //country Routes
    Route::controller(\App\Http\Controllers\Api\Admin\CountryController::class)->prefix('country')->as('country.')->group(function () {
        Route::get('/', 'index');
        Route::post('/store', 'store');
        Route::get('/show/{id}', 'show');
        Route::post('/update/{id}', 'update');
        Route::delete('/destroy/{id}', 'destroy');
    });

    //city Routes
    Route::controller(\App\Http\Controllers\Api\Admin\CityController::class)->prefix('city')->as('city.')->group(function () {
        Route::get('/', 'index');
        Route::post('/store', 'store');
        Route::get('/show/{id}', 'show');
        Route::post('/update/{id}', 'update');
        Route::delete('/destroy/{id}', 'destroy');
    });

    //department Routes
    Route::controller(\App\Http\Controllers\Api\Admin\DepartmentController::class)->prefix('department')->as('department.')->group(function () {
        Route::get('/', 'index');
        Route::post('/store', 'store');
        Route::get('/show/{id}', 'show');
        Route::post('/update/{id}', 'update');
        Route::delete('/destroy/{id}', 'destroy');
    });
});

Route::group([
    'middleware' => 'auth:clientApi',
    'prefix' => 'v1/client'
], function ($router) {
    #Auth
    Route::controller(\App\Http\Controllers\Api\Client\AuthClientController::class)->group(function () {
        Route::post('/login', 'login')->withoutMiddleware('auth:clientApi');
        Route::post('/register', 'register')->withoutMiddleware('auth:clientApi');
        Route::post('/logout', 'logout');
        Route::post('/refresh', 'refresh');
        Route::get('/user-profile', 'userProfile');
    });

    #password
    Route::controller(\App\Http\Controllers\Api\Client\PasswordClientController::class)->group(function () {
        Route::post('forgetPassword', 'forgetPassword')->withoutMiddleware('auth:clientApi');
        Route::post('password/reset', 'reset')->withoutMiddleware('auth:clientApi');
        Route::post('password/confirm', 'confirm');
        Route::post('updatePassword', 'updatePassword');
    });

    #favorite
    Route::controller(\App\Http\Controllers\Api\Client\ClientController::class)->group(function () {
        Route::post('/favoriteTrip', 'favoriteTrip');
        Route::post('/unFavoriteTrip', 'unFavoriteTrip');
        Route::get('/myFavoriteTrip', 'myFavoriteTrip');
    });




});

Route::group([
    'prefix' => 'v1/home'
], function ($router) {

    //country Routes
    Route::controller(\App\Http\Controllers\Api\Client\HomeController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/trips', 'trip');
        Route::get('/blogs', 'blog');
        Route::get('/offers', 'offer');
        Route::post('/store', 'store');
        Route::get('/show/{id}', 'show');
        Route::post('/update/{id}', 'update');
        Route::delete('/destroy/{id}', 'destroy');
        Route::get('/searchTrip', 'searchTrip');
        Route::get('/searchBlog', 'searchBlog');
    });

});
