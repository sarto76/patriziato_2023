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

    Route::get('/documents', 'DocumentsController@index')->name('documents.index');
    Route::get('/documents/create', 'DocumentsController@create')->name('documents.create');
    Route::post('/documents', 'DocumentsController@store')->name('documents.store');
    Route::delete('/documents/{documents}', 'DocumentsController@destroy')->name('documents.destroy');

    Route::get('/properties', 'PropertiesController@index')->name('properties.index');
    Route::get('/properties/create', 'PropertiesController@create')->name('properties.create');
    Route::post('/properties', 'PropertiesController@store')->name('properties.store');
    Route::delete('/properties/{properties}', 'PropertiesController@destroy')->name('properties.destroy');

    Route::get('/link', 'LinkController@index')->name('link.index');
    Route::get('/link/create', 'LinkController@create')->name('link.create');
    Route::post('/link', 'LinkController@store')->name('link.store');
    Route::get('/link/{link}/edit', 'LinkController@edit')->name('link.edit');
    Route::delete('/link/{link}', 'LinkController@destroy')->name('link.destroy');
    Route::put('link/{id}','LinkController@update')->name('link.update');

    Route::get('/patrizi', 'PatriziController@index')->name('patrizi.index');
    Route::get('/patrizi/create', 'PatriziController@create')->name('patrizi.create');
    Route::post('/patrizi', 'PatriziController@store')->name('patrizi.store');
    Route::get('/patrizi/{patrizi}/edit', 'PatriziController@edit')->name('patrizi.edit');
    Route::delete('/patrizi/{patrizi}', 'PatriziController@destroy')->name('patrizi.destroy');
    Route::put('patrizi/{id}','PatriziController@update')->name('patrizi.update');




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
