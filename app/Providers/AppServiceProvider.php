<?php

namespace App\Providers;

use Auth;
use Request;
use Validator;
use App\Models\Role;
use App\Models\Team;
use App\Models\Invite;
use Laravel\Dusk\DuskServiceProvider;
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

        Validator::extend('team_has_email', function ($attribute, $email, $id, $validator) {
            $team = Team::where('name', Request::get('team_name'))
                ->with([
                    'members' => function ($query) use ($email) {
                        $query->where('email', $email);
                    },
                ])->first();

            if (!$team || $team->members->count() > 0) {
                return false;
            }

            return true;
        });

        Validator::extend('is_email_exists_in_team', function ($attribute, $email, $id, $validator) {
            $team = Team::where('name', Request::get('team_name'))
                ->with([
                    'members' => function ($query) use ($email) {
                        $query->where('email', $email);
                    },
                ])->first();

            if (!$team || $team->members->count() === 0) {
                return false;
            }

            return true;
        });

        Validator::extend('team_has_role', function ($attribute, $role, $id, $validator) {
            if (Request::isMethod('patch') === false) {
                $team = Auth::user()->getTeam();
                $role = Role::where('name', $role)->where('team_id', $team->id)->first();

                if (!is_null($role)) {
                    return false;
                }

                return true;
            }

            return true;
        });

        Validator::extend('is_already_invited', function () {
            $team = Team::where('slug', Request::get('team_slug'))->first();

            $invited = Invite::where('email', Request::get('email'))->where('team_id', $team->id)->get();

            if ($invited->count() > 0) {
                return false;
            }

            return true;
        });

        Validator::extend('is_already_member', function () {
            $email = Request::get('email');
            $team  = Team::where('slug', Request::get('team_slug'))
                ->with([
                    'members' => function ($query) use ($email) {
                        $query->where('email', $email);
                    },
                ])->first();

            if (!$team || $team->members->count() > 0) {
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
    }
}
