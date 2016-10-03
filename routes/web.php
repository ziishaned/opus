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

Route::get('wikis', ['uses' => 'WikiController@index', ]);
Route::get('wikis/{id}', ['uses' => 'WikiController@show', ]);
Route::post('wikis', ['uses' => 'WikiController@store', ]);
Route::patch('wikis/{id}', ['uses' => 'WikiController@update', ]);
Route::delete('wikis/{id}', ['uses' => 'WikiController@destroy', ]);
