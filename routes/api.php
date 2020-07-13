<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');

// Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', 'UserController@getAuthenticatedUser');

    //	full calendar api's, if they can be even called API
    Route::post('/ajaxUpdate', 'HomeController@ajaxUpdate');
	Route::post('/fetchEvent/{date}', 'HomeController@fetchEvent');
	Route::post('/deleteEvent/{date}', 'HomeController@deleteEvent');
// 	});