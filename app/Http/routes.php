<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PostController@run');
// Authentication routes...


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
//Post API Routes
Route::group(array('prefix' => 'api/v1'), function()
{
    Route::post('posts', 'PostController@index');
    Route::post('post/get/{id}', 'PostController@getById');
    Route::post('post/add', 'PostController@add');
    Route::post('post/update/{id}', 'PostController@update');
    Route::post('post/delete/{id}', 'PostController@delete');
});