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
    public function home()
    {
        return view('home');
    }
}
