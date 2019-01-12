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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::group(['middleware' => ['web', 'auth']], function() {
	Route::group(['prefix' => 'prepaid-balance', 'as' => 'balance.'], function() {
		Route::get('/', 'BalanceController@index')->name('index');
		Route::post('/', 'BalanceController@store')->name('store');
		Route::put('/{id}/cancel', 'BalanceController@cancel')->name('cancel');
		Route::delete('/{id}/delete', 'BalanceController@destroy')->name('delete');
	});

	Route::group(['prefix' => 'product', 'as' => 'product.'], function() {
		Route::get('/', 'ProductController@index')->name('index');
		Route::post('/', 'ProductController@store')->name('store');
		Route::put('/{id}/cancel', 'ProductController@cancel')->name('cancel');
		Route::delete('/{id}/delete', 'ProductController@destroy')->name('delete');
	});

	Route::group(['prefix' => 'payment', 'as' => 'payment.'], function() {
		Route::get('/', 'PaymentController@index')->name('index');
		Route::post('/', 'PaymentController@pay')->name('pay');
		Route::get('/{transaction_code}', 'PaymentController@detail')->name('detail');
	});

	Route::group(['prefix' => 'order', 'as' => 'order.'], function() {
		Route::get('/', 'OrderController@index')->name('index');
		Route::post('/search', 'OrderController@search')->name('search');
	});
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
