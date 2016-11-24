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
Route::get('/users/{user_slug}', [
    'uses'  =>  'UserController@show',
    'as'    =>  'users.show',
]);
Route::get('/users/{user_slug}/organizations', [
    'uses'  =>  'UserController@getUserOrganizations',
    'as'    =>  'users.organizations',
]);
Route::get('/users/{user_slug}/followers', [
    'uses'  =>  'UserController@getUserFollowers',
    'as'    =>  'users.followers',
]);
Route::get('/users/{user_slug}/following', [
    'uses'  =>  'UserController@getUserFollowing',
    'as'    =>  'users.following',
]);
Route::get('/users/{user_slug}/wikis', [
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
Route::delete('/organizations/{id}', [
    'uses'  =>  'OrganizationController@destroy',
    'as'    =>  'organizations.destroy',
]);
Route::get('/organizations/{organization_slug}', [
    'uses'  =>  'OrganizationController@show',
    'as'    =>  'organizations.show',
]);
Route::get('/organizations/{organization_slug}/members', [
    'uses'  =>  'OrganizationController@getMembers',
    'as'    =>  'organizations.members',
]);
Route::get('/organizations/{organization_slug}/wiki', [
    'uses'  =>  'WikiController@create',
    'as'    =>  'organizations.wiki.create',
]);
Route::get('/organizations/{organization_slug}/activity', [
    'uses'  =>  'OrganizationController@getActivity',
    'as'    =>  'organizations.activity',
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
Route::get('/wikis/{wiki_slug}', [
    'uses'  =>  'WikiController@show',
    'as'    =>  'wikis.show'
]);
Route::get('/wikis/{wiki_slug}/edit', [
    'uses'  =>  'WikiController@edit',
    'as'    =>  'wikis.edit',
]);
Route::patch('/wikis/{wiki_slug}', [
    'uses'  =>  'WikiController@update',
    'as'    =>  'wikis.update',
]);
Route::get('/wikis/search/{text}', [
    'uses'  =>  'WikiController@filterWikis',
]);
Route::delete('/wikis/{wiki_slug}', [
    'uses'  =>  'WikiController@destroy',
    'as'    =>  'wikis.destroy',
]);

/*
|--------------------------------------------------------------------------
| Wikis Pages Routes
|--------------------------------------------------------------------------
*/

Route::get('/wikis/{wiki_slug}/pages/{page_slug}/edit', [
    'uses'  =>  'WikiController@editPage',
    'as'    =>  'pages.edit',
]);
Route::patch('/wikis/{wiki_slug}/pages/{page_slug}', [
    'uses'  =>  'WikiController@updatePage',
    'as'    =>  'pages.update',
]);
Route::get('/wikis/{wiki_slug}/pages/create', [
    'uses'  =>  'WikiController@createPage',
    'as'    =>  'wikis.pages.create',
]);
Route::get('/wikis/{wiki_slug}/pages/reorder', [
    'uses'  =>  'WikiController@pagesReorder',
    'as'    =>  'wikis.pages.reorder',
]);
Route::get('/wikis/{wiki_slug}/pages/{page_slug}', [
    'uses'  =>  'WikiController@showPage',
    'as'    =>  'wikis.pages.show',
]);
Route::post('/wikis/{wiki_slug}/pages', [
    'uses'  =>  'WikiController@storePage',
    'as'    =>  'wikis.pages.store',
]);
Route::get('/wikis/{id}/pages/search/{text}', [
    'uses'  =>  'WikiController@filterWikiPages',
]);
Route::delete('/wikis/{wiki_slug}/pages/{page_slug}', [
    'uses'  =>  'WikiController@destroyPage',
    'as'    =>  'pages.destroy',
]);
Route::post('/pages/{id}/star', [
    'uses'  =>  'WikiController@starPage',
    'as'    =>  'pages.star',
]);
Route::post('/wikis/{wiki_slug}/pages/{page_slug}/comments', [
    'uses'  =>  'CommentController@store',
    'as'    =>  'wikis.pages.comments.store',
]);
Route::patch('/pages/reorder', [
    'uses'  =>  'WikiController@updatePageParent',
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
Route::delete('/comments/{id}', [
    'uses'  =>  'CommentController@destroy',
    'as'    =>  'comments.delete',
]);
Route::patch('/comments/{id}', [
    'uses'  =>  'CommentController@update',
    'as'    =>  'comments.delete',
]);

/*
|--------------------------------------------------------------------------
| Help Routes
|--------------------------------------------------------------------------
*/
Route::get('/help', [
    'uses'  =>  'HomeController@help',
    'as'    =>  'help',
]);

/*
|--------------------------------------------------------------------------
| Settings Routes
|--------------------------------------------------------------------------
*/
Route::get('/settings/profile', [
    'uses'  =>  'UserController@profileSettings',
    'as'    =>  'settings.profile',
]);
Route::get('/settings/account', [
    'uses'  =>  'UserController@accountSettings',
    'as'    =>  'settings.account',
]);
Route::get('/settings/emails', [
    'uses'  =>  'UserController@emailsSettings',
    'as'    =>  'settings.emails',
]);