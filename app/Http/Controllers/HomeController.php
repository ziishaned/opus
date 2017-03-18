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
    }

    public function home() 
    {
        return view('home');
    }
}
