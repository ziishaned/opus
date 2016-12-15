<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Wiki;

/**
 * Class HomeController
 *
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @var \App\Models\Wiki
     */
    protected $wiki;

    /**
     * HomeController constructor.
     *
     * @param \App\Models\Wiki $wiki
     */
    public function __construct(Wiki $wiki)
    {
        $this->wiki = $wiki;
        // $this->middleware(['dashboard', 'auth']);
        $this->middleware(['dashboard']);
    }

    public function home() 
    {
        return view('home');
    }

    /**
     * Get the home view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        $wikis = $this->wiki->getWikis($limit = 5);
        $activities = (new \App\Models\ActivityLog)->getUserAllActivities(Auth::user()->id);

        return view('dashboard', compact('wikis', 'activities'));
    }

    public function help() {
        return view('help');
    }
}
