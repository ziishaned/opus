<?php

namespace App\Providers;

use App\Models\Integration;
use Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Space;
use App\Models\Wiki;
use App\Models\Team;
use App\Models\Page;
use App\Models\Role;
use App\Models\Tag;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Route::patterns([
            'id'               => '[0-9]+',
            'team_id'          => '[0-9]+',
            'page_id'          => '[0-9]+',
            'wiki_id'          => '[0-9]+',
            'text'             => '[a-zA-Z0-9]+',
            'wiki_slug'        => '(\w+-*\d*)+',
            'space_slug'       => '(\w+-*\d*)+',
            'team_slug'        => '(\w+-*\d*)+',
            'role_slug'        => '(\w+-*\d*)+',
            'integration_slug' => '(\w+-*\d*)+',
            'tag_slug'         => '(\w+-*\d*)+',
            'page_slug'        => '(\w+-*\d*)+',
            'user_slug'        => '(\w+-*\d*)+',
        ]);

        Route::bind('user_slug', function ($slug) {
            $user = User::where('slug', $slug)->first();

            if (empty($user)) {
                abort(404);
            }

            return $user;
        });

        Route::bind('integration_slug', function ($slug) {
            $integration = Integration::where('slug', $slug)->with(['integrationActions'])->first();

            if (empty($integration)) {
                abort(404);
            }

            return $integration;
        });

        Route::bind('page_slug', function ($slug) {
            $page = Page::where('slug', $slug)
                ->with(['likes', 'comments'])
                ->first();

            if (empty($page)) {
                abort(404);
            }

            return $page;
        });

        Route::bind('page_id', function ($id) {
            $page = Page::where('id', $id)->first();

            if (empty($page)) {
                abort(404);
            }

            return $page;
        });

        Route::bind('tag_slug', function ($slug) {
            $tag = Tag::where('slug', '=', $slug)->first();

            if (empty($tag)) {
                abort(404);
            }

            return $tag;
        });

        Route::bind('wiki_id', function ($id) {
            $wiki = Wiki::where('id', '=', $id)->with(['space'])->first();

            if (empty($wiki)) {
                abort(404);
            }

            return $wiki;
        });

        Route::bind('wiki_slug', function ($slug) {
            $teamId = Auth::user()->getTeam()->id;

            $wiki = Wiki::where('slug', '=', $slug)
                ->where('team_id', '=', $teamId)
                ->with(['space', 'comments', 'likes'])
                ->first();
            if (empty($wiki)) {
                abort(404);
            }

            return $wiki;
        });

        Route::bind('team_id', function ($id) {
            $team = Team::where('id', $id)->first();

            if (empty($team)) {
                abort(404);
            }

            return $team;
        });

        Route::bind('team_slug', function ($slug) {
            $team = Team::where('slug', $slug)->first();

            if (empty($team)) {
                abort(404);
            }

            return $team;
        });

        Route::bind('role_slug', function ($slug) {
            $role = Role::where('slug', $slug)->with(['members', 'permissions'])->first();

            if (empty($role)) {
                abort(404);
            }

            return $role;
        });

        Route::bind('space_slug', function ($slug) {
            $space = Space::where('slug', $slug)->first();

            if (empty($space)) {
                abort(404);
            }

            return $space;
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace'  => $this->namespace,
        ], function ($router) {
            require base_path('routes/web.php');
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace'  => $this->namespace,
            'prefix'     => 'api',
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }
}
