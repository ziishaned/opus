<?php

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout')->middleware('web');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', 'HomeController@home')->name('home');
});

Route::group(['prefix' => 'organizations'], function () {
    Route::group(['middleware' => 'auth'], function() {
        Route::group(['prefix' => '{organization_slug}/users'], function () {
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

        Route::group(['prefix' => '{organization_slug}/settings'], function () {
            Route::get('profile', 'UserController@profileSettings')->name('settings.profile');
            Route::get('account', 'UserController@accountSettings')->name('settings.account');
            Route::get('notifications', 'UserController@notificationsSettings')->name('settings.notifications');
        });

        Route::group(['prefix' => '{organization_slug}/categories'], function () {
            Route::get('', 'CategoryConroller@index')->name('organizations.categories.index');
            Route::get('create', 'CategoryConroller@create')->name('organizations.categories.create');
            Route::post('', 'CategoryConroller@store')->name('organizations.categories.store');
            Route::delete('{categoryId}', 'CategoryConroller@destroy')->name('organizations.categories.destroy');
            Route::patch('{categoryId}', 'CategoryConroller@update')->name('organizations.categories.update');
        });

        Route::get('{organization_slug}/reports', 'ReportConroller@index')->name('organizations.reports.index');
        Route::get('{organization_slug}/members', 'OrganizationController@getMembers')->name('organizations.members');

        Route::get('{organization_slug}/invite', 'OrganizationController@inviteUsers')->name('invite.users');
        Route::get('{organization_slug}', 'OrganizationController@getActivity')->name('dashboard')->middleware('dashboard');
        Route::get('{organization_slug}/activity', 'OrganizationController@getActivity')->name('dashboard')->middleware('dashboard');
        Route::get('{organization_slug}/activity/user', 'OrganizationController@getUserActivity')->name('dashboard.user.activity');
        Route::get('{organization_slug}/wikis', 'OrganizationController@getWikis')->name('organizations.wikis');
        Route::get('{organization_slug}/wikis/user-contributions', 'OrganizationController@getUserContributedWikis')->name('organizations.wikis.user-contributions');
        Route::delete('{id}', 'OrganizationController@destroy')->name('organizations.destroy');
        Route::get('{organization_slug}/members', 'OrganizationController@getMembers')->name('organizations.members');
        Route::get('{organization_slug}/wiki', 'WikiController@create')->name('organizations.wiki.create');
        Route::get('search/{text}', 'OrganizationController@filterOrganizations');

        Route::patch('{organization_slug}/wikis/{wiki_slug}', 'WikiController@update')->name('wikis.update');
        Route::post('{organization_slug}/wikis', 'WikiController@store')->name('wikis.store');
        Route::get('{organization_slug}/wikis/create', 'WikiController@create')->name('organizations.wikis.create');
        Route::get('{organization_slug}/wikis/{wiki_slug}', 'WikiController@show')->name('wikis.show');
        Route::get('{organization_slug}/wikis/{wiki_slug}/overview', 'WikiController@overview')->name('wikis.overview');
        Route::get('{organization_slug}/wikis/{wiki_slug}/permissions', 'WikiController@permissions')->name('wikis.permissions');
        Route::get('{organization_slug}/wikis/{wiki_slug}/pages/reorder', 'PageController@pagesReorder')->name('pages.reorder');
        Route::post('{organization_id}/wikis/{wiki_id}/pages/reorder', 'PageController@reorder');
        Route::delete('{organization_slug}/wikis/{wiki_slug}', 'WikiController@destroy')->name('wikis.destroy');

        Route::delete('{organization_slug}/wikis/{wiki_slug}/pages/{page_slug}', 'PageController@destroy')->name('pages.destroy');
        Route::get('{organization_slug}/wikis/{wiki_slug}/pages/{page_slug}/edit', 'PageController@edit')->name('pages.edit');
        Route::post('{organization_slug}/wikis/{wiki_slug}/pages', 'PageController@store')->name('pages.store');
        Route::get('{organization_slug}/wikis/{wiki_slug}/pages/create', 'PageController@create')->name('pages.create');
        Route::get('{organization_slug}/wikis/{wiki_slug}/edit', 'WikiController@edit')->name('wikis.edit');
        Route::get('{organization_id}/wikis/{wiki_id}/pages/{pageId?}', 'WikiController@getWikiPages');
        Route::get('{organization_slug}/wikis/{wiki_slug}/pages/{page_slug}', 'PageController@show')->name('pages.show');
        Route::patch('{organization_slug}/wikis/{wiki_slug}/pages/{page_slug}', 'PageController@update')->name('pages.update');

        Route::post('{organization_slug}/wikis/{wiki_slug}/pages/{page_slug}/comments', 'CommentController@store')->name('comments.store');
        Route::delete('{organization_slug}/wikis/{wiki_slug}/pages/{page_slug}/{comment_id}', 'CommentController@destroy')->name('comments.delete');
        Route::patch('{organization_id}/wikis/{wiki_id}/pages/{page_id}/comments/{comment_id}', 'CommentController@update')->name('comments.delete');
    });


    Route::group(['middleware' => 'guest'], function() {
        Route::get('signin/{step}', 'OrganizationController@signin')->name('organizations.signin')->where(['step' => '[1-2]']);
        Route::post('signin/{step}', 'OrganizationController@postSignin')->name('organizations.postsignin')->where(['step' => '[1-2]']);
        Route::get('create/{step}', 'OrganizationController@create')->name('organizations.create')->where(['step' => '[1-4]']);
        Route::post('create/{step}', 'OrganizationController@store')->name('organizations.store')->where(['step' => '[1-4]']);
        Route::get('join/{step}', 'OrganizationController@join')->name('organizations.join')->where(['step' => '[1-4]']);
        Route::post('join/{step}', 'OrganizationController@postJoin')->name('organizations.postjoin')->where(['step' => '[1-4]']);
    });

});
