<?php

namespace App\Providers;

use App\Models\Organization;
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
        Validator::resolver(function ($translator, $data, $rules, $messages) {
            return new HashValidator($translator, $data, $rules, $messages);
        });
        Validator::extend('organization_has_email', function ($attribute, $email, $id, $validator) {
            $users = Organization::where('id', $id)
                                 ->with([
                                     'members' => function ($query) use ($email) {
                                         $query->where('email', $email);
                                     },
                                 ])->first();

            if ($users->members->count() > 0) {
                return false;
            }

            return true;
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
