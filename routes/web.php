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
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

// Main app
Route::get('todo', function() {
	return view('mainapp');
});

// Retrieve tasks from json storage
Route::get('todo/tasks', 'JsonController@getTaskData');

// Write tasks to json storage
Route::post('todo/save', 'JsonController@writeTaskData');

// Retrieve timestamp from json storage
Route::get('todo/gettime', 'JsonController@getTimestamp');

// Write timestamp
Route::post('todo/settime', 'JsonController@setTimestamp');

// Handles improper GET calls
Route::get('todo/save', function() {
	return response('Invalid method!', 405);
});
Route::get('todo/settime', function() {
	return response('Invalid method!', 405);
});