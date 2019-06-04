<?php

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

Auth::routes();
// Route::group(['middleware' => 'auth.user'], function () {
Route::get('/', 'HomeController@index')->name('home');

    Route::resource('/tour', 'Client\ToursController', [
        'as' => 'client',
    ]);

    Route::post('/review', [
        'uses' => 'Client\ToursController@review',
        'as' => 'review',
    ]);

    Route::post('/review/paginate', [
        'uses' => 'Client\ToursController@reviewShow',
        'as' => 'reviewPaginate',
    ]);

    Route::group(['middleware' => 'auth'], function() {
        Route::post('/selectParticipant', [
            'uses' => 'Client\BookingController@selectParticipant',
            'as' => 'selectParticipant',
        ]);

        Route::get('/payment-success/{booking}/tour/{tour}', [
            'uses' => 'Client\BookingController@paymentSuccess',
            'as' => 'paymentSuccess',
        ]);

        Route::resource('tour.booking', 'Client\BookingController', [
            'as' => 'client',
        ]);

        Route::post('/payment', [
            'uses' => 'Client\BookingController@payment',
            'as' => 'payment',
        ]);

        Route::post('/pay-bills-online', [
            'uses' => 'Client\BookingController@paymentOnline',
            'as' => 'paymentOnline',
        ]);

        Route::resource('/user', 'Client\UserController', [
            'as' => 'client',
        ]);

        Route::resource('user.manager', 'Client\ManagerController', [
            'as' => 'client',
        ]);
    });

    Route::get('/booking/confirm/{code}', [
        'uses' => 'Client\BookingController@confirmRequest',
        'as' => 'confirm',
    ]);

    Route::post('/booking/paginate', [
        'uses' => 'Client\ManagerController@bookingShow',
        'as' => 'bookingPaginate',
    ]);
// });

//admin
Route::get('admin', [
    'uses' => 'Admin\LoginController@index',
    'as' => 'admin.login',
]);

Route::post('admin/login', [
    'uses' => 'Admin\LoginController@store',
    'as' => 'admin.auth.store',
]);

Route::group(['prefix' => 'admin', 'middleware' => ['auth.admin']], function () {
    Route::get('logout', 'Admin\LoginController@logout')->name('admin.auth.logout');
    Route::get('dashboard/chart-count-booking', 'Admin\DashboardController@getChartCountBooking')->name('admin.dashboard.getChartCountViewLesson');
    Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
    Route::resource('/tour', 'Admin\TourController', [
        'as' => 'admin',
    ]);

    Route::resource('/guide', 'Admin\GuideController', [
        'as' => 'admin',
    ]);

    Route::post('/tour/import', [
        'uses' => 'Admin\TourController@importTour',
        'as' => 'import',
    ]);


    Route::resource('/booking', 'Admin\BookingController', [
        'as' => 'admin',
    ]);

    Route::post('/booking/export', [
        'uses' => 'Admin\BookingController@exportBooking',
        'as' => 'export',
    ]);

    Route::resource('/hotel', 'Admin\HotelController', [
        'as' => 'admin',
    ]);
});

Route::resource('/category', 'Client\CategoryController', [
    'as' => 'client',
]);

Route::get('/search', [
    'uses' => 'HomeController@search',
    'as' => 'search',
]);

Route::get('/auth/{provider}', 'SocialAuthController@redirectToProvider')->name('authenticate');

Route::get('/auth/{provide}/callback', 'SocialAuthController@handleProviderCallback');

Route::get('/404', [
    'uses' => 'HomeController@error',
    'as' => '404',
]);
