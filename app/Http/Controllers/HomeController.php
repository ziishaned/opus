<?php

namespace App\Http\Controllers;

/**
 * Class HomeController
 *
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Show home view to guest.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        if(env('ONE_TEAM_MODE') == true && !empty(env('TEAM_NAME'))){
            return view('team.login', ['team_name'=>env('TEAM_NAME')]);
        }
        return view('home');
    }
}
