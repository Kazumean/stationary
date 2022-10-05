<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';


//文房具一覧を表示する
Route::get('/stationaries', 'App\Http\Controllers\StationaryController@index')->name('stationaries.index');

//文房具を新規登録する
Route::get('/stationaries/create', 'App\Http\Controllers\StationaryController@create')->name('stationary.create')->middleware('auth');
Route::post('/stationaries/store', 'App\Http\Controllers\StationaryController@store')->name('stationary.store')->middleware('auth');

//文房具情報を編集する
Route::get('/stationaries/edit/{stationary}', 'App\Http\Controllers\StationaryController@edit')->name('stationary.edit')->middleware('auth');
Route::put('/stationaries/edit/{stationary}', 'App\Http\Controllers\StationaryController@update')->name('stationary.update')->middleware('auth');

//文房具情報の詳細を表示する
Route::get('/stationaries/show/{stationary}', 'App\Http\Controllers\StationaryController@show')->name('stationary.show');

//文房具を削除する
Route::delete('/stationaries/{stationary}', 'App\Http\Controllers\StationaryController@destroy')->name('stationary.destroy')->middleware('auth');


//受注一覧画面を表示する
Route::get('/orders', 'App\Http\Controllers\OrderController@index')->name('orders.index');

//受注情報を新規登録する
Route::get('/orders/create', 'App\Http\Controllers\OrderController@create')->name('order.create')->middleware('auth');
Route::post('/orders/store', 'App\Http\Controllers\OrderController@store')->name('order.store')->middleware('auth');

//受注情報を編集する
Route::get('/orders/edit/{order}', 'App\Http\Controllers\OrderController@edit')->name('order.edit')->middleware('auth');
Route::put('/orders/edit/{order}', 'App\Http\Controllers\OrderController@update')->name('order.update')->middleware('auth');

//受注情報の詳細を表示する
Route::get('orders/show/{order}', 'App\Http\Controllers\OrderController@show')->name('order.show');

//受注情報を削除する
Route::delete('/orders/{order}', 'App\Http\Controllers\OrderController@destroy')->name('order.destroy')->middleware('auth');