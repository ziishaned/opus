<?php

namespace App\Http\ViewComposers;

use App\Models\User;
use App\Models\Wiki;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MenuComposer {

    /**
     * @var \App\Models\User
     */
    private $user;

    public function __construct(User $user)
    {

        $this->user = $user;
    }

    public function compose(View $view) {
        if(\Auth::user()) {
            $user  = $this->user->getUser(Auth::user()->slug);
            
            $view->with([
                'loggedInUser' => $user,
            ]);
        }
    }
}