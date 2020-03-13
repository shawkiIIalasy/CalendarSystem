<?php

use Illuminate\Support\Facades\Route;

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
Route::post('/submit', 'EventController@submit');
Route::get('/event', 'EventController@getEventDate');
Route::get('/event/{id}', 'EventController@view');
Route::get('/usersClient', 'UsersController@index');
Route::get('/no', 'GuestController@push');
Route::get('/getNotificationsCount','NotificationController@getNotificationsCount');
Route::get('/makeAsRead','NotificationController@makeAsRead');

