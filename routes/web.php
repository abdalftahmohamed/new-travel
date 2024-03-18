<?php

use App\Http\Controllers\ClientController;
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

Route::get('/',[\App\Http\Controllers\HomeController::class,'home'])->name('home');
Route::get('/blog',[\App\Http\Controllers\HomeController::class,'blog'])->name('blog');
Route::get('/showTravelCity/{city_id}',[\App\Http\Controllers\HomeController::class,'showTravelCity'])->name('showTravelCity');
Route::get('/showTravelDepartment/{department_id}',[\App\Http\Controllers\HomeController::class,'showTravelDepartment'])->name('showTravelDepartment');
Route::get('/aboutUs',[\App\Http\Controllers\HomeController::class,'aboutUs'])->name('aboutUs');
Route::get('/privacyPolicy',[\App\Http\Controllers\HomeController::class,'privacyPolicy'])->name('privacyPolicy');
Route::get('/terms',[\App\Http\Controllers\HomeController::class,'terms'])->name('terms');
Route::get('/shop',[\App\Http\Controllers\HomeController::class,'shop'])->name('shop');
Route::get('/cart',[\App\Http\Controllers\HomeController::class,'cart'])->name('cart')->middleware(['auth:client']);
Route::get('/checkCoupon',[\App\Http\Controllers\HomeController::class,'checkCoupon'])->name('checkCoupon')->middleware(['auth:client']);
Route::get('/newCheckCoupon',[\App\Http\Controllers\HomeController::class,'newCheckCoupon'])->name('newCheckCoupon');

Route::post('/checkout',[\App\Http\Controllers\HomeController::class,'checkout'])->name('checkout')->middleware(['auth:client']);

Route::get('/trip/book/{trip}',[\App\Http\Controllers\HomeController::class,'bookNow'])->name('trip.book');
Route::post('/trip/storeCart',[\App\Http\Controllers\HomeController::class,'storeCart'])->name('trip.storeCart');
Route::post('/trip/cancelCart',[\App\Http\Controllers\HomeController::class,'cancelCart'])->name('trip.cancelCart');
Route::get('/trip/showCheckout/{checkout}',[\App\Http\Controllers\HomeController::class,'showCheckout'])->name('trip.showCheckout');
Route::post('/checkoutNow',[\App\Http\Controllers\HomeController::class,'checkoutNow'])->name('checkoutNow')->middleware(['auth:client']);

Route::get('/trip/show/{trip}',[\App\Http\Controllers\HomeController::class,'show'])->name('trip.show');


#stripe
Route::post('/session', 'App\Http\Controllers\StripePaymentController@session')->name('session');
Route::get('/success/{checkout_id}', 'App\Http\Controllers\StripePaymentController@success')->name('checkout.success');



//https://jsonplaceholder.typicode.com/posts?_start=$startIndex&_limit=$limi






Route::middleware(['auth:web', 'verified'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');


    //country Routes
    Route::controller(\App\Http\Controllers\CountryController::class)->prefix('country')->as('country.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{country}', 'edit')->name('edit');
        Route::get('/show/{country}', 'show')->name('show');
        Route::put('/update', 'update')->name('update');
        Route::delete('/delete', 'destroy')->name('destroy');
    });

    //city Routes
    Route::controller(\App\Http\Controllers\CityController::class)->prefix('city')->as('city.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{city}', 'edit')->name('edit');
        Route::get('/show/{city}', 'show')->name('show');
        Route::put('/update', 'update')->name('update');
        Route::delete('/delete', 'destroy')->name('destroy');
    });

    //company Routes
    Route::controller(\App\Http\Controllers\CompanyController::class)->prefix('company')->as('company.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{company}', 'edit')->name('edit');
        Route::get('/show/{company}', 'show')->name('show');
        Route::get('/get-cities/{countryId}', 'getCities')->name('get-cities');
        Route::put('/update', 'update')->name('update');
        Route::delete('/delete', 'destroy')->name('destroy');
    });

    //trip Routes
    Route::controller(\App\Http\Controllers\TripController::class)->prefix('trip')->as('trip.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{trip}', 'edit')->name('edit');
        Route::get('/show/{trip}', 'show')->name('show');
        Route::put('/update', 'update')->name('update');
        Route::delete('/delete', 'destroy')->name('destroy');
    });

    //offer Routes
    Route::controller(\App\Http\Controllers\OfferController::class)->prefix('offer')->as('offer.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{offer}', 'edit')->name('edit');
        Route::get('/show/{offer}', 'show')->name('show');
        Route::put('/update', 'update')->name('update');
        Route::delete('/delete', 'destroy')->name('destroy');
    });

    //ourPartner Routes
    Route::controller(\App\Http\Controllers\OurPartnerController::class)->prefix('ourPartner')->as('ourPartner.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{ourPartner}', 'edit')->name('edit');
        Route::get('/show/{ourPartner}', 'show')->name('show');
        Route::put('/update', 'update')->name('update');
        Route::delete('/delete', 'destroy')->name('destroy');
    });

    //department Routes
    Route::controller(\App\Http\Controllers\DepartmentController::class)->prefix('department')->as('department.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{department}', 'edit')->name('edit');
        Route::get('/show/{department}', 'show')->name('show');
        Route::get('/get-cities/{countryId}', 'getCities')->name('get-cities');
        Route::put('/update', 'update')->name('update');
        Route::delete('/delete', 'destroy')->name('destroy');
    });
    //blog Routes
    Route::controller(\App\Http\Controllers\BlogController::class)->prefix('blog')->as('blog.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{blog}', 'edit')->name('edit');
        Route::get('/show/{blog}', 'show')->name('show');
        Route::put('/update', 'update')->name('update');
        Route::delete('/delete', 'destroy')->name('destroy');
    });

    //client Routes
    Route::controller(\App\Http\Controllers\ClientController::class)->prefix('client')->as('client.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{client}', 'edit')->name('edit');
        Route::get('/show/{client}', 'show')->name('show');
        Route::put('/update', 'update')->name('update');
        Route::delete('/delete', 'destroy')->name('destroy');
    });

    //review Routes
    Route::controller(\App\Http\Controllers\ReviewController::class)->prefix('review')->as('review.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{review}', 'edit')->name('edit');
        Route::get('/show/{review}', 'show')->name('show');
        Route::put('/update', 'update')->name('update');
        Route::delete('/delete', 'destroy')->name('destroy');
    });

    //coupon Routes
    Route::controller(\App\Http\Controllers\CouponController::class)->prefix('coupon')->as('coupon.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{coupon}', 'edit')->name('edit');
        Route::get('/show/{coupon}', 'show')->name('show');
        Route::put('/update', 'update')->name('update');
        Route::delete('/delete', 'destroy')->name('destroy');
    });

});




Route::get('client/login',[ClientController::class,'createLogin'])->withoutMiddleware('auth:client')->name('login.client');
Route::post('client/login',[ClientController::class,'storeLogin'])->withoutMiddleware('auth:client')->name('login.store');

#client
Route::middleware(['auth:client'])->prefix('client')->as('client.')->group(function () {
    Route::get('dashboard',[ClientController::class,'dashboard'])->name('dashboard');
    Route::post('logout', [ClientController::class, 'logout'])->name('logout');

    //trip Routes
    Route::controller(\App\Http\Controllers\Client\TripController::class)->prefix('trip')->as('trip.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/cartOlder', 'cartOlder')->name('cartOlder');
        Route::get('/cartYounger', 'cartYounger')->name('cartYounger');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{trip}', 'edit')->name('edit');
        Route::get('/show/{trip}', 'show')->name('show');
        Route::put('/update', 'update')->name('update');
        Route::delete('/delete', 'destroy')->name('destroy');
    });
});















require __DIR__.'/auth.php';
