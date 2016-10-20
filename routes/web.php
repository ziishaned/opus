<?php

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Auth::routes();

/*
|--------------------------------------------------------------------------
| Users Routes
|--------------------------------------------------------------------------
*/

Route::get('/users/search/{text}', [
    'uses'  =>  'UserController@filterUser',
]);
Route::get('/users/{id}', [
    'uses'  =>  'UserController@show',
    'as'    =>  'users.show',
]);
Route::get('/users/{id}/organizations', [
    'uses'  =>  'UserController@getUserOrganizations',
    'as'    =>  'users.organizations',
]);
Route::get('/users/{id}/followers', [
    'uses'  =>  'UserController@getUserFollowers',
    'as'    =>  'users.followers',
]);
Route::get('/users/{id}/following', [
    'uses'  =>  'UserController@getUserFollowing',
    'as'    =>  'users.following',
]);
Route::get('/users/{id}/wikis', [
    'uses'  =>  'UserController@wikis',
    'as'    =>  'users.wikis',
]);
Route::post('/users/follow', [
    'uses'  =>  'UserController@follow',
    'as'    =>  'users.followUser'
]);
Route::post('/users/unfollow', [
    'uses'  =>  'UserController@unfollow',
    'as'    =>  'users.unfollowUser',
]);

/*
|--------------------------------------------------------------------------
| Mix Routes
|--------------------------------------------------------------------------
*/

Route::get('/home', [
    'uses'  =>  'HomeController@index',
    'as'    =>  'dashboard',
]);
Route::get('/', [
    'uses'  =>  'HomeController@index',
    'as'    =>  'dashboard',
]);

/*
|--------------------------------------------------------------------------
| Organizations Routes
|--------------------------------------------------------------------------
*/

Route::get('/organizations/create', [
    'uses'  =>  'OrganizationController@create',
    'as'    =>  'organizations.create',
]);
Route::get('/organizations/invite', [
    'uses'  =>  'OrganizationController@getInvite',
    'as'    =>  'organizations.invite.show',
]);
Route::post('/organizations/invite', [
    'uses'  =>  'OrganizationController@inviteUser',
    'as'    =>  'organizations.invite.store',
]);
Route::post('/organizations', [
    'uses'  =>  'OrganizationController@store',
    'as'    =>  'organizations.store',
]);
Route::delete('/organizations/invite', [
    'uses'  =>  'OrganizationController@removeInvite',
    'as'    =>  'organizations.invite.destroy',
]);
Route::get('/organizations/{id}', [
    'uses'  =>  'OrganizationController@show',
    'as'    =>  'organizations.show',
]);
Route::get('/organizations/{id}/members', [
    'uses'  =>  'OrganizationController@getMembers',
    'as'    =>  'organizations.members',
]);
Route::get('/organizations/{id}/wikis', [
    'uses'  =>  'OrganizationController@getWikis',
    'as'    =>  'organizations.wikis.show',
]);
Route::get('/organizations/{id}/wiki', [
    'uses'  =>  'WikiController@create',
    'as'    =>  'organizations.wiki.create',
]);
Route::get('/organizations/search/{text}', [
    'uses'  =>  'OrganizationController@filterOrganizations',
]);

/*
|--------------------------------------------------------------------------
| Wikis Routes
|--------------------------------------------------------------------------
*/

Route::get('/wikis/create', [
    'uses'  =>  'WikiController@create',
    'as'    =>  'wikis.create'
]);
Route::post('/wikis', [
    'uses'  =>  'WikiController@store',
    'as'    =>  'wikis.store'
]);
Route::get('/wikis/{id}', [
    'uses'  =>  'WikiController@show',
    'as'    =>  'wikis.show'
]);
Route::get('/wikis/{id}/edit', [
    'uses'  =>  'WikiController@edit',
    'as'    =>  'wikis.edit',
]);
Route::patch('/wikis/{id}', [
    'uses'  =>  'WikiController@update',
    'as'    =>  'wikis.update',
]);
Route::get('/wikis/search/{text}', [
    'uses'  =>  'WikiController@filterWikis',
]);
Route::delete('/wikis/{id}', [
    'uses'  =>  'WikiController@destroy',
    'as'    =>  'wikis.destroy',
]);

/*
|--------------------------------------------------------------------------
| Wikis Routes
|--------------------------------------------------------------------------
*/

Route::get('/wikis/{id}/pages/{pageId}', [
    'uses'  =>  'WikiController@showPage',
    'as'    =>  'wikis.pages.show',
]);
Route::get('/wikis/{id}/pages/{pageId}/edit', [
    'uses'  =>  'WikiController@editPage',
    'as'    =>  'pages.edit',
]);
Route::patch('/wikis/{id}/pages/{pageId}', [
    'uses'  =>  'WikiController@updatePage',
    'as'    =>  'pages.update',
]);
Route::post('/wikis/{id}/pages', [
    'uses'  =>  'WikiController@storePage',
    'as'    =>  'wikis.pages.store',
]);
Route::get('/wikis/{id}/pages/create', [
    'uses'  =>  'WikiController@createPage',
    'as'    =>  'wikis.pages.create',
]);
Route::get('/wikis/{id}/pages/search/{text}', [
    'uses'  =>  'WikiController@filterWikiPages',
]);
Route::delete('/wikis/{id}/pages/{pageId}', [
    'uses'  =>  'WikiController@destroyPage',
    'as'    =>  'pages.destroy',
]);
Route::post('/pages/{id}/star', [
    'uses'  =>  'WikiController@starPage',
    'as'    =>  'pages.star',
]);
Route::post('/wikis/{id}/pages/{pageId}/comments', [
    'uses'  =>  'CommentController@store',
    'as'    =>  'wikis.pages.comments.store',
]);

/*
|--------------------------------------------------------------------------
| Comments Routes
|--------------------------------------------------------------------------
*/

Route::post('/comments/{id}/star', [
    'uses'  =>  'CommentController@starComment',
    'as'    =>  'comments.star',
]);