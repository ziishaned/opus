<?php

use App\Models\Page;

Route::get('logout', 'UserController@logout')->name('logout');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', 'HomeController@home')->name('home');
    Route::get('team/login', 'TeamController@login')->name('team.login');
    Route::post('team/login', 'TeamController@postLogin')->name('team.postlogin');
    Route::get('team/create', 'TeamController@create')->name('team.create');
    Route::post('team/create', 'TeamController@store')->name('team.store');
    Route::get('team/join', 'TeamController@join')->name('team.join');
    Route::post('team/join', 'TeamController@postJoin')->name('team.postjoin');
});

Route::get('get-pages', 'WikiController@getWikiPages')->name('wikis.pages');

Route::group(['prefix' => 'api', 'middleware' => 'auth'], function () {
    Route::get('/team/members', 'UserController@getTeamMembers')->name('api.teams.members');
    Route::get('/teams/{team_slug}/wikis', 'WikiController@getTeamWikis')->name('api.teams.wikis');
    Route::get('/teams/{team_slug}/categories', 'CategoryConroller@getTeamCategories')->name('api.teams.categories');
    Route::post('/like', 'LikeController@storeLike')->name('like');
    Route::delete('/comment', 'CommentController@destroy')->name('comments.destroy');
    Route::patch('/comment', 'CommentController@update')->name('comments.update');
    Route::post('/wikis/pages', 'PageController@getWikiPages');
    Route::post('/pages/reorder', 'PageController@reorder');
});

Route::group(['prefix' => 'teams', 'middleware' => 'auth'], function () {
    Route::group(['prefix' => '{team_slug}/users/{user_slug}/settings'], function () {
        Route::get('profile', 'UserController@profileSettings')->name('settings.profile');
        Route::get('account', 'UserController@accountSettings')->name('settings.account');
    });

    Route::group([ 'prefix' => '{team_slug}/settings'], function() {
        Route::get('general', 'TeamController@generalSettings')->name('teams.settings.general');
        Route::get('members', 'TeamController@membersSettings')->name('teams.settings.members');
    });

    Route::group(['prefix' => '{team_slug}/users'], function () {
        Route::get('activity', 'UserController@activity');
        Route::delete('{user_slug}', 'UserController@deleteAccount')->name('users.destroy');
        Route::patch('{user_slug}/password', 'UserController@updatePassword')->name('users.password.update');
        Route::get('{user_slug}/readlist', 'UserController@getReadList')->name('users.readlist');
        Route::get('{user_slug}', 'UserController@show')->name('users.show');
        Route::patch('{user_slug}', 'UserController@update')->name('users.update');
        Route::post('avatar/store', 'UserController@storeAvatar');
        Route::post('avatar/crop', 'UserController@cropAvatar');
    });

    Route::group(['prefix' => '{team_slug}/categories'], function () {
        Route::get('', 'CategoryConroller@create')->name('categories.create');
        Route::post('', 'CategoryConroller@store')->name('categories.store');
        Route::delete('{category_slug}', 'CategoryConroller@destroy')->name('teams.categories.destroy');
        Route::patch('{category_slug}', 'CategoryConroller@update')->name('teams.categories.update');
        Route::get('{category_slug}/wikis', 'CategoryConroller@getCategoryWikis')->name('categories.wikis');
    });

    Route::get('{team_slug}/members', 'TeamController@getMembers')->name('teams.members');

    Route::get('{team_slug}/invite', 'TeamController@inviteUsers')->name('invite.users');
    Route::get('{team_slug}', 'UserController@dashboard')->name('dashboard')->middleware('dashboard');
    Route::delete('{id}', 'TeamController@destroy')->name('teams.destroy');
    Route::get('{team_slug}/members', 'TeamController@getMembers')->name('teams.members');
    Route::get('{team_slug}/wiki', 'WikiController@create')->name('teams.wiki.create');

    Route::post('{team_id}/wikis/{wiki_id}/pages/reorder', 'PageController@reorder');
    Route::patch('{team_id}/wikis/{wiki_id}/pages/{page_id}/comments/{comment_id}', 'CommentController@update')->name('comments.update');

    Route::group(['prefix' => '{team_slug}/wikis'], function () {
        Route::post('', 'WikiController@store')->name('wikis.store');
        Route::get('create', 'WikiController@create')->name('wikis.create');
        Route::get('', 'WikiController@getWikis')->name('teams.wikis');
    });

    Route::group(['prefix' => '{team_slug}/categories/{category_slug}/wikis'], function () {
        Route::patch('{wiki_slug}', 'WikiController@update')->name('wikis.update');
        Route::get('{wiki_slug}', 'WikiController@show')->name('wikis.show');
        Route::get('{wiki_slug}/activity', 'WikiController@getWikiActivity')->name('wikis.activity');
        Route::get('{wiki_slug}/overview', 'WikiController@overview')->name('wikis.overview');
        Route::get('{wiki_slug}/permissions', 'WikiController@permissions')->name('wikis.permissions');
        Route::delete('{wiki_slug}', 'WikiController@destroy')->name('wikis.destroy');
        Route::get('{wiki_slug}/setting/overview', 'WikiController@wikiSetting')->name('wikis.setting');

        Route::get('{wiki_slug}/pages/create', 'PageController@create')->name('pages.create');
        Route::get('{wiki_slug}/pages/{page_slug}', 'PageController@show')->name('pages.show');
        Route::delete('{wiki_slug}/pages/{page_slug}', 'PageController@destroy')->name('pages.destroy');
        Route::get('{wiki_slug}/pages/{page_slug}/edit', 'PageController@edit')->name('pages.edit');
        Route::post('{wiki_slug}/pages', 'PageController@store')->name('pages.store');
        Route::get('{wiki_slug}/edit', 'WikiController@edit')->name('wikis.edit');
        Route::patch('{wiki_slug}/pages/{page_slug}', 'PageController@update')->name('pages.update');

        Route::post('{wiki_slug}/comments', 'CommentController@storeWikiComment')->name('wikis.comments.store');
        Route::post('{wiki_slug}/pages/{page_slug}/comments', 'CommentController@storePageComment')->name('pages.comments.store');
        Route::delete('{wiki_slug}/pages/{page_slug}/{comment_id}', 'CommentController@destroy')->name('comments.delete');
    });
    
});
