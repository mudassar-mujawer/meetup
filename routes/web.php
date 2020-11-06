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

Route::get('/participant/create', 'ParticipantsController@create');
Route::get('/participant/list', 'ParticipantsController@index');
Route::post('/participant/store', 'ParticipantsController@store');   
Route::get('/participant/{id}','ParticipantsController@show');
Route::get('/edit/participant/{id}','ParticipantsController@edit');
Route::post('/edit/participant/{id}','ParticipantsController@update');
Route::get('/delete/participant/{id}','ParticipantsController@destroy');


Route::get('/accommodations/list', 'AccommodationsController@index');

Route::get('/transport/list', 'TransportController@index');
