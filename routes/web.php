<?php

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');

Route::get('organization/new', [
    'uses' => 'OrganizationController@create',
    'as' => 'createOrganization',
]);
Route::get('organization/invite', [
    'uses' => 'OrganizationController@getInvite',
]);
Route::post('organization/invite', [
    'uses' => 'OrganizationController@inviteUser',
]);
Route::post('organization', [
    'uses' => 'OrganizationController@store',
    'as' => 'storeOrganization',
]);
Route::post('organization/remove-invite', [
    'uses' => 'OrganizationController@removeInvite',
]);

Route::get('/users/search/{text}', 'UserController@getUser');