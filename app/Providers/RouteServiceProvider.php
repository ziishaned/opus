<?php

namespace App\Providers;

use Auth;
use App\Models\User;
use App\Models\Wiki;
use App\Models\Team;
use App\Models\Page;
use App\Models\Category;
use App\Models\Group;
use Illuminate\Support\Facades\Route;
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
            'page_slug'         =>  '(\w+-*\d*)+',
            'id'                =>  '[0-9]+',
            'wiki_slug'         =>  '(\w+-*\d*)+',
            'category_slug'     =>  '(\w+-*\d*)+',
            'text'              =>  '[a-zA-Z0-9]+',
            'team_slug'         =>  '(\w+-*\d*)+',
            'group_slug'        =>  '(\w+-*\d*)+',
            'team_id'           =>  '[0-9]+',
            'page_id'           =>  '[0-9]+',
            'wiki_id'           =>  '[0-9]+',
            'user_slug'         =>  '(\w+-*\d*)+',
        ]);

        Route::bind('user_slug', function($slug) {
            return User::where('slug', '=', $slug)->first();
        });

        Route::bind('page_slug', function($slug) {
            return Page::where('slug', '=', $slug)
                                    ->with(['likes', 'comments'])
                                    ->first();
        });

        Route::bind('page_id', function($id) {
            return Page::where('id', '=', $id)->first();
        });

        Route::bind('wiki_id', function($id) {
            return Wiki::where('id', '=', $id)->with(['category'])->first();
        });

        Route::bind('wiki_slug', function($slug) {
            $teamId = Auth::user()->getTeam()->id;
            
            return Wiki::where('slug', '=', $slug)
                                    ->where('team_id', '=', $teamId)
                                    ->with(['category', 'comments', 'likes'])
                                    ->first();
        });

        Route::bind('team_id', function($id) {
            return Team::where('id', '=', $id)->first();
        });

        Route::bind('team_slug', function($slug) {
            return Team::where('slug', '=', $slug)->first();
        });

        Route::bind('group_slug', function($slug) {
            return Group::where('slug', '=', $slug)->with(['members', 'permissions'])->first();
        });

        Route::bind('category_slug', function($slug) {
            return Category::where('slug', '=', $slug)->first();
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
            'namespace' => $this->namespace,
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
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }
}
