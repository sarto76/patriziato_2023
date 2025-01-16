<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

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
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::get('/info', 'InfoController@index')->name('info.index');
    Route::get('/info/{id}', 'InfoController@update')->name('info.update');


    Route::get('/news', 'NewsController@index')->name('news.index');
    Route::get('/news/create', 'NewsController@create')->name('news.create');
    Route::post('/news', 'NewsController@store')->name('news.store');
    Route::get('/news/{news}/edit', 'NewsController@edit')->name('news.edit');
    Route::delete('/news/{news}', 'NewsController@destroy')->name('news.destroy');
    Route::put('news/{id}','NewsController@update')->name('news.update');

    Route::put('info/{id}','InfoController@update')->name('info.update');

   /* Route::resource('news', NewsController::class);*/




    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
      /*  Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');*/

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});
