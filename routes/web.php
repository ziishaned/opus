<?php

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');

Route::get('organizations/new', [
    'uses' => 'OrganizationController@create',
    'as' => 'createOrganization',
]);
Route::get('organizations/invite', [
    'uses' => 'OrganizationController@getInvite',
]);
Route::post('organizations/invite', [
    'uses' => 'OrganizationController@inviteUser',
]);
Route::post('organizations', [
    'uses' => 'OrganizationController@store',
    'as' => 'storeOrganization',
]);
Route::post('organizations/remove-invite', [
    'uses' => 'OrganizationController@removeInvite',
]);
Route::get('organizations/{id}', [
    'uses' => 'OrganizationController@show',
]);
Route::get('organizations/{id}/members', [
    'uses' => 'OrganizationController@getMembers',
    'as'   => 'getOrganizationMembers'
]);

Route::get('/users/search/{text}', 'UserController@getUser');