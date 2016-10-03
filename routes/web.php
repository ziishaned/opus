<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');
Route::get('people', function() {
	return view('people.people');
});
Route::get('people/{id}', function() {
    return view('people.profile');
});

Route::get('wiki/{name}', function() {
    return view('wiki.wiki');
});

Route::get('wiki/{name}/page/{page_id}', function() {
    return "ok";
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------|
*/
Route::get('users', ['uses' => 'UserController@index', ]);
Route::get('users/{id}', ['uses' => 'UserController@show', ]);