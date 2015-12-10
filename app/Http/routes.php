<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PagesController@index');

/*
Route::get('articles','ArticlesController@index');
Route::get('articles/create','ArticlesController@create');
Route::post('articles', 'ArticlesController@store');
Route::get('articles/{id}','ArticlesController@show');
Route::get('articles/{id}/edit', 'ArticlesController@edit');
*/

Route::resource('articles', 'ArticlesController');
Route::resource('articles.comments', 'CommentsController');

Route::get('about','PagesController@about');
Route::get('phpinfo', 'PagesController@appInfo');


Route::controllers(
    ['auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController']
);
