<?php

Route::get('logout', 'UserController@logout')->name('logout');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', 'HomeController@home')->name('home');
    Route::get('login', 'UserController@login')->name('organizations.login');
    Route::post('login', 'UserController@postLogin')->name('organizations.postlogin');
    Route::get('create', 'OrganizationController@create')->name('organizations.create');
    Route::post('create', 'OrganizationController@store')->name('organizations.store');
    Route::get('join', 'OrganizationController@join')->name('organizations.join');
    Route::post('join', 'OrganizationController@postJoin')->name('organizations.postjoin');
    Route::get('user/organizations', 'UserController@getOrganizations')->name('user.organizations');
});

Route::get('get-pages', 'WikiController@getWikiPages')->name('wikis.pages');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'settings'], function () {
        Route::get('profile', 'UserController@profileSettings')->name('settings.profile');
        Route::get('account', 'UserController@accountSettings')->name('settings.account');
    });
});

Route::group(['prefix' => 'organizations', 'middleware' => 'auth'], function () {
    Route::get('select', 'UserController@setOrganization')->name('organizations.set');
    Route::post('select', 'UserController@postSetOrganization')->name('organizations.set.post');


    Route::group(['middleware' => 'organization'], function() {
        Route::group(['prefix' => '{organization_slug}/users'], function () {
            Route::get('activity', 'UserController@activity');
            Route::delete('{user_slug}', 'UserController@deleteAccount')->name('users.destroy');
            Route::get('search/{text}', 'UserController@filterUser');
            Route::patch('{user_slug}/password', 'UserController@updatePassword')->name('users.password.update');
            Route::get('{user_slug}/readlist', 'UserController@getReadList')->name('users.readlist');
            Route::get('{user_slug}', 'UserController@show')->name('users.show');
            Route::patch('{user_slug}', 'UserController@update')->name('users.update');
            Route::get('{user_slug}/wikis', 'UserController@wikis')->name('users.wikis');
            Route::post('avatar/store', 'UserController@storeAvatar');
            Route::post('avatar/crop', 'UserController@cropAvatar');
        });

        Route::group(['prefix' => '{organization_slug}/categories'], function () {
            Route::post('', 'CategoryConroller@store')->name('organizations.categories.store');
            Route::delete('{category_slug}', 'CategoryConroller@destroy')->name('organizations.categories.destroy');
            Route::patch('{category_slug}', 'CategoryConroller@update')->name('organizations.categories.update');
            Route::get('{category_slug}/wikis', 'CategoryConroller@getCategoryWikis')->name('categories.wikis');
        });

        Route::get('{organization_slug}/reports', 'ReportConroller@index')->name('organizations.reports.index');
        Route::get('{organization_slug}/members', 'OrganizationController@getMembers')->name('organizations.members');

        Route::get('{organization_slug}/invite', 'OrganizationController@inviteUsers')->name('invite.users');
        Route::get('{organization_slug}', 'OrganizationController@getActivity')->name('dashboard')->middleware('dashboard');
        Route::get('{organization_slug}/categories', 'OrganizationController@getCategories')->name('organizations.categories');
        Route::get('{organization_slug}/wikis/user-contributions', 'OrganizationController@getUserContributedWikis')->name('organizations.wikis.user-contributions');
        Route::delete('{id}', 'OrganizationController@destroy')->name('organizations.destroy');
        Route::get('{organization_slug}/members', 'OrganizationController@getMembers')->name('organizations.members');
        Route::get('{organization_slug}/wiki', 'WikiController@create')->name('organizations.wiki.create');
        Route::get('search/{text}', 'OrganizationController@filterOrganizations');

        Route::post('{organization_id}/wikis/{wiki_id}/pages/reorder', 'PageController@reorder');
        Route::patch('{organization_id}/wikis/{wiki_id}/pages/{page_id}/comments/{comment_id}', 'CommentController@update')->name('comments.update');

        Route::group(['prefix' => '{organization_slug}/wikis'], function () {
            Route::post('', 'WikiController@store')->name('wikis.store');
            Route::get('create', 'WikiController@create')->name('organizations.wikis.create');
        });

        Route::group(['prefix' => '{organization_slug}/categories/{category_slug}/wikis'], function () {
            Route::patch('{wiki_slug}', 'WikiController@update')->name('wikis.update');
            Route::get('{wiki_slug}', 'WikiController@show')->name('wikis.show');
            Route::get('{wiki_slug}/overview', 'WikiController@overview')->name('wikis.overview');
            Route::get('{wiki_slug}/permissions', 'WikiController@permissions')->name('wikis.permissions');
            Route::delete('{wiki_slug}', 'WikiController@destroy')->name('wikis.destroy');
            Route::get('{wiki_slug}/pages/reorder', 'PageController@pagesReorder')->name('pages.reorder');

            Route::get('{wiki_slug}/pages/create', 'PageController@create')->name('pages.create');
            Route::get('{wiki_slug}/pages/{page_slug}', 'PageController@show')->name('pages.show');
            Route::delete('{wiki_slug}/pages/{page_slug}', 'PageController@destroy')->name('pages.destroy');
            Route::get('{wiki_slug}/pages/{page_slug}/edit', 'PageController@edit')->name('pages.edit');
            Route::post('{wiki_slug}/pages', 'PageController@store')->name('pages.store');
            Route::get('{wiki_slug}/edit', 'WikiController@edit')->name('wikis.edit');
            Route::patch('{wiki_slug}/pages/{page_slug}', 'PageController@update')->name('pages.update');

            Route::post('{wiki_slug}/pages/{page_slug}/comments', 'CommentController@store')->name('comments.store');
            Route::delete('{wiki_slug}/pages/{page_slug}/{comment_id}', 'CommentController@destroy')->name('comments.delete');
        });
    });
});
