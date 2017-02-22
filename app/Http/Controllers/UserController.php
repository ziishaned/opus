<?php

namespace App\Http\Controllers;

use Image;
use Session;
use App\Models\User;
use App\Models\Wiki;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserController
 *
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    protected $user;

    protected $team;

    protected $wiki;

    protected $request;

    protected $profileImagePath = 'images/profile-pics';

    public function __construct(Request $request, User $user, Team $team, Wiki $wiki)
    {
        $this->user    = $user;
        $this->team    = $team;
        $this->request = $request;
        $this->wiki    = $wiki;
    }

    public function show(Team $team, User $user)
    {   
        $activities = $this->user->getActivty($user->id)->activity;

        return view('user.profile', compact('user', 'team', 'activities'));
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

    public function profileSettings(Team $team)
    {
        return view('user.setting.profile', compact('team'));
    }

    public function accountSettings(Team $team)
    {
        return view('user.setting.account', compact('team'));
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

    public function getReadList(Team $team, User $user)
    {
        return view('user.read-list', compact('team'));
    }

    public function dashboard(Team $team)
    {
        $activities = $this->team->getActivty($team->id)->activity;
     
        $wikis      = $this->wiki->getTeamWikis($team->id, 5);
        
        return view('team.dashboard', compact('team', 'activities', 'wikis'));
    }
}
