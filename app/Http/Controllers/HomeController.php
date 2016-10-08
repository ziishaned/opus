<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Wiki;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * @var \App\Models\User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }

    public function index()
    {
        $user  = $this->user->getUser(Auth::user()->id);

        $wikis = Wiki::where('wiki.user_id', '=', Auth::user()->id)
        ->leftJoin('user_star', 'wiki.id', '=', 'user_star.entity_id')
        ->select('wiki.*', DB::raw("COUNT(user_star.id) as total_star"))
        ->groupBy('wiki.id')
        ->get();

        return view('home', compact('user', 'wikis'));
    }
}
