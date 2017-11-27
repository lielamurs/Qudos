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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('admin')->group(function(){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
});

Route::post('/news', 'Post\NewsController@submitNews')->name('news.submit');
Route::get('/news', 'Post\NewsController@index')->name('news');
Route::get('/suggestions', 'Post\PostController@suggestions')->name('suggestions');
Route::post('/suggestions', 'Post\PostController@submitSuggestion')->name('suggestion.submit');
Route::get('/feedback', 'Post\PostController@feedback')->name('feedback');
Route::post('/feedback', 'Post\PostController@submitFeedback')->name('feedback.submit');
Route::get('/about', 'Post\NewsController@index')->name('about');