<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @var \App\Models\User
     */
    protected $user;

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request, User $user)
    {
        $this->user    = $user;
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->user->getUsers();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->getUser($id);
        $activities = DB::table('activity_log')->where('causer_id', '=', Auth::user()->id)->latest()->paginate(10);

        if($user) {
            return view('user.user', compact('user', 'activities'));
        }
        return response()->json([
            'message' => 'Resource not found.'
        ], Response::HTTP_NOT_FOUND);
    }

    public function filterUser($text)
    {
        return User::where(function ($query) use ($text) {
            $query->where('name', 'like', '%' . $text . '%')
                  ->orWhere('email', 'like', '%' . $text . '%');
        })->where('id', '!=', Auth::user()->id)->get();
    }

    public function getUserOrganizations($id)
    {
        $user = $this->user->getOrganizations($id);
        return view('user.organizations', compact('user'));
    }

    public function getUserFollowers($id)
    {
        $user = $this->user->getFollowers($id);
        return view('user.followers', compact('user'));
    }

    public function getUserFollowing($id)
    {
        $user = $this->user->getFollowing($id);
        return view('user.following', compact('user'));
    }

    public function wikis($id)
    {
        $user = $this->user->getWikis($id);
        return view('user.wikis', compact('user'));
    }

    public function follow()
    {
        $this->user->followUser($this->request->get('followId'));
        return response()->json([
            'message' => 'Successfully following.'
        ], Response::HTTP_CREATED);
    }

    public function unfollow()
    {
        $this->user->unfollowUser($this->request->get('followId'));
        return response()->json([
            'message' => 'Successfully unfollow.'
        ], Response::HTTP_CREATED);
    }
}
