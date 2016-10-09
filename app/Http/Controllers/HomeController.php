<?php

namespace App\Http\Controllers;

use App\Models\Wiki;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $wikis = Wiki::where('wiki.user_id', '=', Auth::user()->id)
                     ->leftJoin('user_star', 'wiki.id', '=', 'user_star.entity_id')
                     ->select('wiki.*', DB::raw("COUNT(user_star.id) as total_star"))
                     ->groupBy('wiki.id')
                     ->get();

        return view('home', compact('wikis'));
    }
}
