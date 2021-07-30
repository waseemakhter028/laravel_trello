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

Route::post('login', 'UserController@login')->name('login');
Route::post('register', 'UserController@register');

//api authentication checking using passport
 Route::group(['middleware' => 'auth:api'], function(){
 
//creating resource controller  routes   
Route::apiResource('/boards', 'BoardController');    
Route::apiResource('/tasks', 'TaskController');
Route::post('/tasks/changestatus', 'TaskController@changeTaskStatus');

Route::post('details', 'UserController@details');
});
