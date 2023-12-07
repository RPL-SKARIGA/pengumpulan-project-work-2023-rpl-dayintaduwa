<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
Route::group(['namespace' => 'App\Http\Controllers'], function()
{  
    Route::group(['middleware' => 'prevent-back-button'],function(){
        Route::get('/login', [AuthController::class, 'index'])->name('login');
    });

    Route::group(['middleware' => ['guest']], function() {
        Route::get('/login', [AuthController::class, 'index'])->name('login');
        Route::post('/login', 'AuthController@login')->name('auth.doLogin');
    });
    
    Route::group(['middleware' => ['auth']], function() {
        Route::get('/logout', 'AuthController@logout')->name('logout');

        Route::get('/', 'IndexController@index')->name('index');

        //stock
        Route::get('/stock', 'StockController@index')->name('stock.index');
        Route::get('/stock/create', 'StockController@create')->name('stock.create');
        Route::post('/stock', 'StockController@store')->name('stock.store');
        Route::get('/stock/update', 'StockController@update')->name('stock.update');
        Route::get('/stock/detail', 'StockController@detail')->name('stock.detail');
        Route::delete('/stock/{id}', 'StockController@destroy')->name('stock.destroy');
        Route::get('/stock/{id}/edit', 'StockController@edit')->name('stock.edit');
        Route::put('/stock/{id}', 'StockController@update')->name('stock.update');
        Route::get('/stock/{id}/view', 'StockController@show')->name('stock.show'); 

        //user
        Route::get('/user', 'UserController@index')->name('user.index');
        Route::get('/user/create', 'UserController@create')->name('user.create');
        Route::post('/user', 'UserController@store')->name('user.store');
        Route::get('/user/{id}/edit', 'UserController@edit')->name('user.edit');
        Route::put('/user/{id}', 'UserController@update')->name('user.update');
        Route::get('/user/detail', 'UserController@detail')->name('user.detail');
        Route::delete('/user/{id}', 'UserController@destroy')->name('user.destroy');
        Route::get('/user/{id}/view', 'UserController@show')->name('user.show'); 
        
        //transaction
        Route::get('/transaction', 'TransactionController@index')->name('transaction.index');
        Route::get('/transaction/create', 'TransactionController@create')->name('transaction.create');
        Route::post('/transaction', 'TransactionController@store')->name('transaction.store');
        Route::get('/transaction/{id}/edit', 'TransactionController@edit')->name('transaction.edit');
        Route::put('/transaction/{id}', 'TransactionController@update')->name('transaction.update');
        Route::delete('/transaction/{id}', 'TransactionController@destroy')->name('transaction.destroy');
        Route::get('/transaction/detail', 'TransactionController@detail')->name('transaction.detail');
        Route::get('/transaction/{id}/view', 'TransactionController@show')->name('transaction.show'); 


        Route::get('/about', 'PagesController@about')->name('pages.about');

        
        // Product
        Route::get('/product', 'ProductController@index')->name('product.index');
        Route::get('/product/create', 'ProductController@create')->name('product.create');
        Route::post('/product', 'ProductController@store')->name('product.store');
        Route::get('/product/{id}/edit', 'ProductController@edit')->name('product.edit');
        Route::put('/product/{id}', 'ProductController@update')->name('product.update');
        Route::delete('/product/{id}', 'ProductController@destroy')->name('product.destroy');
        Route::get('/product/{id}/view', 'ProductController@show')->name('product.show'); 
    });
});