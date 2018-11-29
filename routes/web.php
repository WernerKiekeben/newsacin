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

Route::get('/', 'NewsController@getHome');

Route::get('/news', 'NewsController@getNews')->name('news');

Route::get('/news/{id}/edit', 'NewsController@editNews');

Route::put('/update/{id}', 'NewsController@updateNews');

Route::delete('/destroy/{id}', 'NewsController@destroy');

Route::delete('/delete/{id}', 'NewsController@deleteUser');

Route::get('/create', 'NewsController@getCreate');

Route::post('/', 'NewsController@storeNews');

Route::get('/new/{id}', 'NewsController@showNews');

Route::post('/postajax', 'NewsController@searchNews');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
