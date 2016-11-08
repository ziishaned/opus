<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth');
    }

    /**
     * Get the home view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $wikis = $this->wiki->getWikis($limit = 5);
        return view('home', compact('wikis'));
    }

    public function help() {
        return view('help');
    }
}
