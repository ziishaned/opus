<?php

namespace App\Providers;

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
            'organization_slug' =>  '(\w+-*\d*)+',
            'organization_id'   =>  '[0-9]+',
            'page_id'           =>  '[0-9]+',
            'wiki_id'           =>  '[0-9]+',
            'user_slug'         =>  '(\w+-*\d*)+',
        ]);

        Route::bind('user_slug', function($slug) {
            return \App\Models\User::where('slug', '=', $slug)->first();
        });

        Route::bind('page_slug', function($slug) {
            return \App\Models\WikiPage::where('slug', '=', $slug)->first();
        });

        Route::bind('page_id', function($id) {
            return \App\Models\WikiPage::where('id', '=', $id)->first();
        });

        Route::bind('wiki_id', function($id) {
            return \App\Models\Wiki::where('id', '=', $id)->first();
        });

        Route::bind('organization_id', function($id) {
            return \App\Models\Organization::where('id', '=', $id)->first();
        });

        Route::bind('organization_slug', function($slug) {
            return \App\Models\Organization::where('slug', '=', $slug)->first();
        });

        Route::bind('wiki_slug', function($slug) {
            $organizationId = \Auth::user()->organization->id;
            return \App\Models\Wiki::where('slug', '=', $slug)
                                    ->where('organization_id', '=', $organizationId)
                                    ->first();
        });

        Route::bind('category_slug', function($slug) {
            return \App\Models\Category::where('slug', '=', $slug)->first();
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
