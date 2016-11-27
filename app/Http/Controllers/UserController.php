<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 *
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 * @package App\Http\Controllers
 */
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
    
    protected $activityLog;

    /**
     * UserController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User         $user
     */
    public function __construct(Request $request, User $user, ActivityLog $activityLog)
    {
        $this->user    = $user;
        $this->request = $request;
        $this->activityLog = $activityLog;
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
     * @param  string  $userSlug
     * @return \Illuminate\Http\Response
     */
    public function show($userSlug)
    {
        $user = $this->user->getUser($userSlug);
        $activities = $this->activityLog->getUserActivities($user->id);

        if($user) {
            return view('user.user', compact('user', 'activities'));
        }
        return response()->json([
            'message' => 'Resource not found.'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Filter Users.
     *
     * @param $text
     * @return mixed
     */
    public function filterUser($text)
    {
        return $this->user->filter($text);
    }

    /**
     * Return organizations view with user organizations.
     *
     * @param $userSlug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUserOrganizations($userSlug)
    {
        $user               = $this->user->getUser($userSlug);
        $userOrganizations  = $this->user->getOrganizations($user);
        return view('user.organizations', compact('user', 'userOrganizations'));
    }

    /**
     * Return followers view with the list of a specific user followers.
     *
     * @param $userSlug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUserFollowers($userSlug)
    {
        $user          = $this->user->getUser($userSlug);
        $userFollowers = $this->user->getFollowers($user);
        return view('user.followers', compact('user', 'userFollowers'));
    }

    /**
     * Return following view with the list of a specific user following.
     *
     * @param $userSlug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUserFollowing($userSlug)
    {
        $user          = $this->user->getUser($userSlug);
        $userFollowing = $this->user->getFollowing($user);
        return view('user.following', compact('user', 'userFollowing'));
    }

    /**
     * Get all the wikis of a specific user and return them on user wikis view.
     *
     * @param $userSlug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function wikis($userSlug)
    {
        $user       = $this->user->getUser($userSlug);
        $userWikis  = $this->user->getWikis($user);
        return view('user.wikis', compact('user', 'userWikis'));
    }

    /**
     * Follow a user.
     *
     * @return mixed
     */
    public function follow()
    {
        $this->user->followUser($this->request->get('followId'));
        return response()->json([
            'message' => 'User successfully followed.'
        ], Response::HTTP_CREATED);
    }

    /**
     * Unfollow a user.
     *
     * @return mixed
     */
    public function unfollow()
    {
        $this->user->unfollowUser($this->request->get('followId'));
        return response()->json([
            'message' => 'User successfully unfollowed.'
        ], Response::HTTP_CREATED);
    }

    public function profileSettings()
    {
        return view('user.setting.profile');
    }

    public function accountSettings()
    {
        return view('user.setting.account');
    }

    public function emailsSettings()
    {
        return view('user.setting.emails');
    }
}
