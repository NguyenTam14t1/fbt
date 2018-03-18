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
    
    Route::resource('tour.booking', 'Client\BookingController', [
        'as' => 'client',
    ]);

    Route::post('/payment', [
        'uses' => 'Client\BookingController@payment',
        'as' => 'payment',
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

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('/tour', 'Admin\TourController', [
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
});
