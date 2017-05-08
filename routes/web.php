<?php

Route::get('logout', 'UserController@logout')->name('logout');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', 'HomeController@home')->name('home');
    Route::get('team/login', 'TeamController@login')->name('team.login');
    Route::post('team/login', 'TeamController@postLogin')->name('team.postlogin');
    Route::get('team/create', 'TeamController@create')->name('team.create');
    Route::post('team/create', 'TeamController@store')->name('team.store');
    Route::get('password/reset', 'UserController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'UserController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'UserController@showResetForm')->name('password.reset');
    Route::post('password/reset/{token}', 'UserController@reset')->name('password.reset');
});

Route::get('get-pages', 'WikiController@getWikiPages')->name('wikis.pages');

Route::group(['prefix' => 'api', 'middleware' => 'auth'], function () {
    Route::get('/team/members', 'UserController@getTeamMembers')->name('api.teams.members');
    Route::post('/like', 'LikeController@storeLike')->name('like');
    Route::delete('/comment', 'CommentController@destroy')->name('comments.destroy');
    Route::patch('/comment', 'CommentController@update')->name('comments.update');
    Route::post('/wikis/pages', 'PageController@getWikiPages');
    Route::post('/pages/reorder', 'PageController@reorder');
    Route::post('/team/members/filter', 'TeamController@filterMembers');
    Route::post('tags', 'TagController@index');
    Route::post('search', 'TeamController@search');
});

Route::get('team/{team_slug}/invite/{hash}', 'TeamController@join')->name('team.join')->middleware('invitation');
Route::post('team/{team_slug}/invite/{hash}/join', 'TeamController@postJoin')->name('team.postjoin');

Route::group(['prefix' => 'teams', 'middleware' => 'auth'], function () {
    Route::group(['prefix' => '{team_slug}/users/{user_slug}/settings'], function () {
        Route::get('profile', 'UserController@profileSettings')->name('settings.profile');
        Route::get('account', 'UserController@accountSettings')->name('settings.account');
    });

    Route::group(['prefix' => '/{team_slug}/tags/{tag_slug}'], function () {
        Route::get('wikis', 'WikiController@getTagWikis')->name('tags.wikis');
        Route::get('pages', 'PageController@getTagPages')->name('tags.pages');
    });

    Route::group(['prefix' => '{team_slug}/settings/roles'], function () {
        Route::get('', 'RoleController@index')->name('roles.index');
        Route::delete('{role_slug}', 'RoleController@destroy')->name('roles.delete');
        Route::patch('{role_slug}', 'RoleController@update')->name('roles.update');
        Route::post('', 'RoleController@store')->name('roles.post');
        Route::get('{role_slug}/edit', 'RoleController@edit')->name('roles.edit');
        Route::get('create', 'RoleController@create')->name('roles.create');
    });

    Route::group(['prefix' => '{team_slug}/users/{user_slug}/notifications'], function () {
        Route::get('read-all', 'NotificationController@readAll')->name('notifications.readall');
    });

    Route::group(['prefix' => '{team_slug}/settings'], function () {
        Route::get('general', 'TeamController@generalSettings')->name('teams.settings.general');
        Route::get('members', 'TeamController@membersSettings')->name('teams.settings.members');

        Route::get('integrations', 'IntegrationController@index')->name('integrations.index');
        Route::get('integrations/create', 'IntegrationController@create')->name('integrations.create');
        Route::post('integrations', 'IntegrationController@store')->name('integrations.store');
        Route::get('integrations/{integration_slug}/edit', 'IntegrationController@edit')->name('integrations.edit');
        Route::patch('integrations/{integration_slug}', 'IntegrationController@update')->name('integrations.update');
        Route::delete('integrations/{integration_slug}', 'IntegrationController@destroy')->name('integrations.delete');
    });

    Route::group(['prefix' => '{team_slug}/users'], function () {
        Route::get('activity', 'UserController@activity');
        Route::post('{user_slug}', 'UserController@updateAvatar')->name('users.avatar');
        Route::delete('{user_slug}', 'UserController@deleteAccount')->name('users.destroy');
        Route::patch('{user_slug}/password', 'UserController@updatePassword')->name('users.password');
        Route::get('{user_slug}/readlist', 'UserController@getReadList')->name('users.readlist');
        Route::get('{user_slug}', 'UserController@show')->name('users.show');
        Route::patch('{user_slug}', 'UserController@update')->name('users.update');
        Route::get('{user_slug}/settings/account', 'UserController@accountSettings')->name('settings.account');
        Route::post('avatar/store', 'UserController@storeAvatar');
    });

    Route::group(['prefix' => '{team_slug}/spaces'], function () {
        Route::get('create', 'SpaceController@create')->name('spaces.create');
        Route::post('', 'SpaceController@store')->name('spaces.store');
        Route::delete('{space_slug}', 'SpaceController@destroy')->name('teams.spaces.destroy');
        Route::patch('{space_slug}', 'SpaceController@update')->name('teams.spaces.update');
        Route::get('{space_slug}/wikis', 'SpaceController@getSpaceWikis')->name('spaces.wikis');
    });

    Route::get('{team_slug}/members', 'TeamController@getMembers')->name('teams.members');

    Route::delete('{team_slug}/invite/{hash}', 'InviteController@destroy')->name('invite.destroy');
    Route::get('{team_slug}/invite', 'TeamController@inviteUsers')->name('invite.users');
    Route::get('{team_slug}', 'UserController@dashboard')->name('dashboard');
    Route::post('{team_slug}/invite', 'InviteController@store')->name('invites.create');
    Route::delete('{id}', 'TeamController@destroy')->name('teams.destroy');
    Route::get('{team_slug}/members', 'TeamController@getMembers')->name('teams.members');
    Route::get('{team_slug}/wiki', 'WikiController@create')->name('teams.wiki.create');
    Route::patch('{team_slug}', 'TeamController@update')->name('teams.update');
    Route::post('{team_slug}/logo', 'TeamController@uploadLogo')->name('teams.logo');
    Route::delete('{team_slug}/logo', 'TeamController@destroy')->name('teams.destroy');

    Route::post('{team_id}/wikis/{wiki_id}/pages/reorder', 'PageController@reorder');
    Route::patch('{team_id}/wikis/{wiki_id}/pages/{page_id}/comments/{comment_id}', 'CommentController@update')->name('comments.update');

    Route::group(['prefix' => '{team_slug}/wikis'], function () {
        Route::post('', 'WikiController@store')->name('wikis.store');
        Route::get('create', 'WikiController@create')->name('wikis.create')->middleware('acl:admin|add_page');
    });

    Route::group(['prefix' => '{team_slug}/spaces/{space_slug}/wikis'], function () {
        Route::get('{wiki_slug}/read-later', 'WikiController@addToReadList')->name('wikis.readlater.create');
        Route::delete('{wiki_slug}/read-later', 'WikiController@removeFromReadList')->name('wikis.readlater.destroy');
        Route::get('{wiki_slug}/watch', 'WikiController@watch')->name('wikis.watch');
        Route::get('{wiki_slug}/unwatch', 'WikiController@stopWatch')->name('wikis.unwatch');
        Route::get('{wiki_slug}/pdf', 'WikiController@generatePdf')->name('wikis.pdf');
        Route::get('{wiki_slug}/word', 'WikiController@generateWord')->name('wikis.word');
        Route::patch('{wiki_slug}', 'WikiController@update')->name('wikis.update');
        Route::patch('{wiki_slug}/settings/overview', 'WikiController@overviewUpdate')->name('wikis.overview.update');
        Route::get('{wiki_slug}', 'WikiController@show')->name('wikis.show');
        Route::get('{wiki_slug}/activity', 'WikiController@getWikiActivity')->name('wikis.activity');
        Route::delete('{wiki_slug}', 'WikiController@destroy')->name('wikis.destroy');
        Route::get('{wiki_slug}/settings', 'WikiController@setting')->name('wikis.settings');

        Route::get('{wiki_slug}/pages/{page_slug}/read-later', 'PageController@addToReadList')->name('pages.readlater.create');
        Route::delete('{wiki_slug}/pages/{page_slug}/read-later', 'PageController@removeFromReadList')->name('pages.readlater.destroy');
        Route::get('{wiki_slug}/pages/{page_slug}/pdf', 'PageController@generatePdf')->name('pages.pdf');
        Route::get('{wiki_slug}/pages/{page_slug}/word', 'PageController@generateWord')->name('pages.word');
        Route::get('{wiki_slug}/pages/create', 'PageController@create')->name('pages.create');
        Route::get('{wiki_slug}/pages/{page_slug}', 'PageController@show')->name('pages.show');
        Route::delete('{wiki_slug}/pages/{page_slug}', 'PageController@destroy')->name('pages.destroy');
        Route::get('{wiki_slug}/pages/{page_slug}/edit', 'PageController@edit')->name('pages.edit');
        Route::post('{wiki_slug}/pages', 'PageController@store')->name('pages.store');
        Route::get('{wiki_slug}/edit', 'WikiController@edit')->name('wikis.edit');
        Route::patch('{wiki_slug}/pages/{page_slug}', 'PageController@update')->name('pages.update');
        Route::get('{wiki_slug}/pages/{page_slug}/settings', 'PageController@setting')->name('pages.settings');
        Route::patch('{wiki_slug}/pages/{page_slug}/settings/overview', 'PageController@overviewUpdate')->name('pages.overview.update');

        Route::post('{wiki_slug}/comments', 'CommentController@storeWikiComment')->name('wikis.comments.store');
        Route::post('{wiki_slug}/pages/{page_slug}/comments', 'CommentController@storePageComment')->name('pages.comments.store');
        Route::delete('{wiki_slug}/pages/{page_slug}/{comment_id}', 'CommentController@destroy')->name('comments.delete');
    });

});
