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
Route::get('/about', 'Post\NewsController@index')->name('about');
Route::prefix('admin')->group(function(){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
});

Route::prefix('news')->group(function(){
    Route::post('/', 'Post\NewsController@submitNews')->name('news.submit');
    Route::get('/', 'Post\NewsController@index')->name('news');
    Route::post('/', 'Post\NewsController@submitNewsComment')->name('news.comment');
});
Route::prefix('suggestions')->group(function(){
    Route::get('/', 'Post\PostController@suggestions')->name('suggestions');
    Route::post('/new', 'Post\PostController@submitSuggestion')->name('suggestion.submit');
    Route::get('/new', 'Post\PostController@suggestionsNew')->name('suggestions.new');
    Route::post('/', 'Post\PostController@submitSuggestionComment')->name('suggestion.comment');
});
Route::prefix('feedback')->group(function(){
    Route::get('/', 'Post\PostController@feedback')->name('feedback');
    Route::post('/new', 'Post\PostController@submitFeedback')->name('feedback.submit');
    Route::get('/new', 'Post\PostController@feedbackNew')->name('feedback.new');
    Route::post('/', 'Post\PostController@submitFeedbackComment')->name('feedback.comment');
});