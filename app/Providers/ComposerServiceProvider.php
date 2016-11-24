<?php

namespace App\Providers;

use App\Http\ViewComposers\MenuComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer([
            'home',
            'help',
            'organization.invite',
            'organization.create',
            'organization.organization',
            'organization.members',
            'organization.activity',
            'user.setting.profile',
            'user.setting.account',
            'user.setting.emails',
            'user.organizations',
            'user.followers',
            'user.following',
            'user.user',
            'user.wikis',
            'wiki.create',
            'wiki.wiki',
            'wiki.edit',
            'wiki.page.create',
            'wiki.page.page',
            'wiki.page.edit',
            'wiki.page.reorder',
        ], MenuComposer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
