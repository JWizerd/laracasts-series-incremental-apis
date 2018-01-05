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

Route::group(['prefix' => 'api/v1'], function(){
  Route::resource('lessons', 'LessonsController');
  Route::get('/lessons/{lesson}/title', 'LessonsController@title');
  Route::get('/lessons/{lesson}/body', 'LessonsController@body');
});