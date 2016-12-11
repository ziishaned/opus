<?php

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Auth::routes();

Route::group(['prefix' => 'users'], function () {
    Route::get('organizations', 'UserController@getOrganizations');
    Route::get('activity', 'UserController@activity');
    Route::delete('{user_slug}', 'UserController@deleteAccount')->name('users.destroy');
    Route::get('search/{text}', 'UserController@filterUser');
    Route::patch('{user_slug}/password', 'UserController@updatePassword')->name('users.password.update');
    Route::get('{user_slug}', 'UserController@show')->name('users.show');
    Route::patch('{user_slug}', 'UserController@update')->name('users.update');
    Route::get('{user_slug}/organizations', 'UserController@getOrganizationsView')->name('users.organizations');
    Route::get('{user_slug}/wikis', 'UserController@wikis')->name('users.wikis');
    Route::post('avatar/store', 'UserController@storeAvatar');
    Route::post('avatar/crop', 'UserController@cropAvatar');
});

Route::group(['prefix' => '/'], function () {
    Route::get('', 'HomeController@index')->name('dashboard');
    Route::get('home', 'HomeController@index')->name('dashboard')->middleware('dashboard');
    Route::get('help', 'HomeController@help')->name('help');
});

Route::group(['prefix' => 'organizations'], function () {
    Route::get('wikis', 'OrganizationController@getWikis');
    Route::get('create', 'OrganizationController@create')->name('organizations.create');
    Route::get('invite', 'OrganizationController@getInvite')->name('organizations.invite.show');
    Route::post('invite', 'OrganizationController@inviteUser')->name('organizations.invite.store');
    Route::post('', 'OrganizationController@store')->name('organizations.store');
    Route::delete('invite', 'OrganizationController@removeInvite')->name('organizations.invite.destroy');
    Route::delete('{id}', 'OrganizationController@destroy')->name('organizations.destroy');
    Route::get('{organization_slug}', 'OrganizationController@show')->name('organizations.show');
    Route::get('{organization_slug}/members', 'OrganizationController@getMembers')->name('organizations.members');
    Route::get('{organization_slug}/wiki', 'WikiController@create')->name('organizations.wiki.create');
    Route::get('{organization_slug}/activity', 'OrganizationController@getActivity')->name('organizations.activity');
    Route::get('search/{text}', 'OrganizationController@filterOrganizations');
});

Route::group(['prefix' => 'wikis'], function () {
    Route::get('{id}/pages/{pageId?}', 'WikiController@getWikiPages');
    Route::post('{id}/watch', 'WikiController@watchWiki');
    Route::post('{id}/star', 'WikiController@starWiki');
    Route::get('create', 'WikiController@create')->name('wikis.create');
    Route::post('/', 'WikiController@store')->name('wikis.store');
    Route::get('{wiki_slug}', 'WikiController@show')->name('wikis.show');
    Route::get('{wiki_slug}/edit', 'WikiController@edit')->name('wikis.edit');
    Route::patch('{wiki_slug}', 'WikiController@update')->name('wikis.update');
    Route::get('search/{text}', 'WikiController@filterWikis');
    Route::delete('{wiki_slug}', 'WikiController@destroy')->name('wikis.destroy');
});

Route::group(['prefix' => 'wikis'], function () {
    Route::get('{wiki_slug}/pages/{page_slug}/edit', 'WikiController@editPage')->name('pages.edit');
    Route::patch('{wiki_slug}/pages/{page_slug}', 'WikiController@updatePage')->name('pages.update');
    Route::get('{wiki_slug}/pages/create', 'WikiController@createPage')->name('wikis.pages.create');
    Route::get('{wiki_slug}/pages/reorder', 'WikiController@pagesReorder')->name('wikis.pages.reorder');
    Route::get('{wiki_slug}/pages/{page_slug}', 'WikiController@showPage')->name('wikis.pages.show');
    Route::post('{wiki_slug}/pages', 'WikiController@storePage')->name('wikis.pages.store');
    Route::get('{id}/pages/search/{text}', 'WikiController@filterWikiPages');
    Route::delete('{wiki_slug}/pages/{page_slug}', 'WikiController@destroyPage')->name('pages.destroy');
    Route::post('{wiki_slug}/pages/{page_slug}/comments', 'CommentController@store')->name('wikis.pages.comments.store');
});

Route::group(['prefix' => 'pages'], function () {
    Route::post('{id}/star', 'WikiController@starPage')->name('pages.star');
    Route::post('{id}/watch', 'WikiController@watchPage');
    Route::patch('reorder', 'WikiController@updatePageParent');
});

Route::group(['prefix' => 'comments'], function () {
    Route::post('{id}/star', 'CommentController@starComment')->name('comments.star');
    Route::delete('{id}', 'CommentController@destroy')->name('comments.delete');
    Route::patch('{id}', 'CommentController@update')->name('comments.delete');
});

Route::group(['prefix' => 'settings'], function () {
    Route::get('profile', 'UserController@profileSettings')->name('settings.profile');
    Route::get('account', 'UserController@accountSettings')->name('settings.account');
    Route::get('notifications', 'UserController@notificationsSettings')->name('settings.notifications');
    Route::get('emails', 'UserController@emailsSettings')->name('settings.emails');
});