<?php

namespace App\Providers;

use Session;
use Validator;
use App\Http\Validators\HashValidator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::resolver(function($translator, $data, $rules, $messages) {
          return new HashValidator($translator, $data, $rules, $messages);
        });
        Validator::extend('organization_has_email', function($attribute, $value, $parameters, $validator) {
            $users = \App\Models\Organization::where('name', '=', Session::get('organization_name'))->with(['user'])->get()->pluck('user');
            
            foreach ($users as $user) {
                if($user->email == $value) {
                    return false;
                }
            }
            
            return false;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
