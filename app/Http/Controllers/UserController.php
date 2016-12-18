<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Hash;
use Image;
use Session;
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

    protected $profileImagePath = 'images/profile-pics';

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
     * @param         $organizationSlug
     * @param  string $userSlug
     *
     * @return \Illuminate\Http\Response
     */
    public function show($organizationSlug, $userSlug)
    {
        $organization = (new Organization)->getOrganization($organizationSlug);
        $user = $this->user->getUser($userSlug);

        if(!$user) {
            return abort(404);
        }
        
        $activities = $this->activityLog->getUserActivities($user->id);
        return view('user.user', compact('user', 'activities', 'organization'));
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

    public function storeAvatar() {
        $image = $this->request->file('profile_image');
        
        $imageName = 'img_' . date('Y-m-d-H-s') .  '.' . $this->request->file('profile_image')->getClientOriginalExtension();

        $path = public_path('images/profile-pics/' . $imageName);

        Image::make($image->getRealPath())->save($path);
        
        \App\Models\User::find(Auth::user()->id)->update([
            'profile_image' => $imageName,
        ]);
        
        return response()->json([
            'message' => 'Profile picture uploaded successfully.',
            'image' => $imageName
        ], \Symfony\Component\HttpFoundation\Response::HTTP_ACCEPTED);
    }

    public function cropAvatar() {
        $img = Image::make(public_path('/images/profile-pics/' . $this->request->get('image')));
        $img->crop((int) $this->request->get('w'), (int) $this->request->get('h'), (int) $this->request->get('x'), (int) $this->request->get('y'));
        $img->save();

        return response()->json([
            'message' => 'Profile picture successfully cropped.'
        ], \Symfony\Component\HttpFoundation\Response::HTTP_ACCEPTED);
    } 

    /**
     * Return organizations view with user organizations.
     *
     * @param $userSlug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getOrganizationsView($userSlug)
    {
        $user               = $this->user->getUser($userSlug);
        $userOrganizations  = $this->user->getOrganizations($user);
        return view('user.organizations', compact('user', 'userOrganizations'));
    }

    public function getOrganizations() 
    {
        $userId        =  Auth::user()->id;
        $user          =  $this->user->find($userId)->with(['organizations'])->first();
        $organizations =  [];

        foreach ($user->organizations as $key => $organization) {
            $organizations[] = [
                'url'  => route('organizations.show', [$organization->slug]),
                'name' => $organization->name
            ];
        }

        return $organizations;
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

    public function profileSettings($organizationSlug)
    {
        $organization = \App\Models\Organization::where('slug', '=', $organizationSlug)->first();
        return view('user.setting.profile', compact('organization'));
    }

    public function accountSettings($organizationSlug)
    {
        $organization = \App\Models\Organization::where('slug', '=', $organizationSlug)->first();
        return view('user.setting.account', compact('organization'));
    }

    public function emailsSettings($organizationSlug)
    {
        $organization = \App\Models\Organization::where('slug', '=', $organizationSlug)->first();
        return view('user.setting.emails', compact('organization'));
    }

    public function notificationsSettings($organizationSlug)
    {
        $organization = \App\Models\Organization::where('slug', '=', $organizationSlug)->first();
        return view('user.setting.notifications', compact('organization'));
    }

    public function update($slug)
    {
        $this->validate($this->request, [
            'email'         => 'required|unique:users,email,' . Auth::user()->id . '|email',
            'profile_image' => 'mimes:jpeg,jpg,png|max:1000',
        ]);

        $profile_image = '';
        if($this->request->file('profile_image')) {
            $file = $this->request->file('profile_image');
            $profile_image = md5(microtime() . $file->getClientOriginalName()) . "." . $file->getClientOriginalExtension();
            $this->request->file('profile_image')->move($this->profileImagePath, $profile_image);
        }

        $this->user->updateUser($slug, $this->request->all(), $profile_image);

        return redirect()->back()->with([
            'alert' => 'Profile successfully updated.',
            'alert_type' => 'success'
        ]);
    }

    public function updatePassword($slug)
    {
        $this->validate($this->request, [
            'password' => 'required|hash:' . Auth::user()->password,
            'new_password'  => 'required|same:password_confirmation',
            'password_confirmation'  => 'required'
        ]);

        $this->user->updatePassword($slug, $this->request->all());

        return $this->logout();
    }

    public function deleteAccount($slug)
    {
        $this->user->where('slug', '=', $slug)->delete();

        return $this->logout();
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();

        return redirect('/');
    }

    public function activity()
    {
        return $this->user->getActivity($this->request->get('user_id'));
    }
}
