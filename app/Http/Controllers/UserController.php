<?php

namespace App\Http\Controllers;

use Hash;
use Image;
use Session;
use App\Models\User;
use App\Models\Organization;
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

    protected $organization;

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    protected $profileImagePath = 'images/profile-pics';

    /**
     * UserController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User         $user
     */
    public function __construct(Request $request, User $user, Organization $organization)
    {
        $this->user    = $user;
        $this->request = $request;
        $this->organization = $organization;
    }

    /**
     * Display the specified resource.
     *
     * @param         $organizationSlug
     * @param  string $userSlug
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization, User $user)
    {   
        $activities = $this->user->getActivty($user->id)->activity;

        return view('user.user', compact('user', 'organization', 'activities'));
    }

    public function storeAvatar() {
        $image = $this->request->file('profile_image');
        
        $imageName = 'img_' . date('Y-m-d-H-s') .  '.' . $this->request->file('profile_image')->getClientOriginalExtension();

        $path = public_path('images/profile-pics/' . $imageName);

        Image::make($image->getRealPath())->save($path);
        
        User::find(Auth::user()->id)->update([
            'profile_image' => $imageName,
        ]);
        
        return response()->json([
            'message' => 'Profile picture uploaded successfully.',
            'image' => $imageName
        ], \Symfony\Component\HttpFoundation\Response::HTTP_ACCEPTED);
    }

    public function cropAvatar() 
    {
        $img = Image::make(public_path('/images/profile-pics/' . $this->request->get('image')));
        $img->crop((int) $this->request->get('w'), (int) $this->request->get('h'), (int) $this->request->get('x'), (int) $this->request->get('y'));
        $img->save();

        return response()->json([
            'message' => 'Profile picture successfully cropped.'
        ], \Symfony\Component\HttpFoundation\Response::HTTP_ACCEPTED);
    }

    public function profileSettings(Organization $organization)
    {
        return view('user.setting.profile', compact('organization'));
    }

    public function accountSettings(Organization $organization)
    {
        return view('user.setting.account', compact('organization'));
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

    public function getReadList(Organization $organization, User $user)
    {
        return view('user.readlist', compact('organization'));
    }
    
    public function getOrganizations()
    {
        return response()->json([
            'organizations' => $this->user->where('email', $this->request->get('email'))->with('organizations')->first()->organizations,
        ], \Symfony\Component\HttpFoundation\Response::HTTP_OK);
    }    

    public function dashboard(Organization $organization)
    {
        $activities = $this->organization->getActivty($organization->id)->activity;

        $wikis      = $this->organization->getWikis($organization->id, 5);
        
        return view('organization.home', compact('organization', 'activities', 'wikis'));
    }
}
