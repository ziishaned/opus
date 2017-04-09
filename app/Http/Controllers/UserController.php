<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use Session;
use App\Models\User;
use App\Models\Wiki;
use App\Models\Team;
use App\Models\Like;
use App\Models\Space;
use App\Models\ReadList;
use Illuminate\Http\Request;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class UserController extends Controller
{
    /**
     * @var \App\Models\ReadList
     */
    private $readList;

    /**
     * @var \App\Models\User
     */
    private $user;

    /**
     * @var \App\Models\Team
     */
    private $team;

    /**
     * @var \App\Models\Wiki
     */
    private $wiki;

    /**
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * @var \App\Models\Space
     */
    private $space;

    /**
     * UserController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User         $user
     * @param \App\Models\Team         $team
     * @param \App\Models\Wiki         $wiki
     * @param \App\Models\Space        $space
     * @param \App\Models\ReadList     $readList
     */
    public function __construct(Request $request, User $user, Team $team, Wiki $wiki, Space $space, ReadList $readList)
    {
        $this->user     = $user;
        $this->team     = $team;
        $this->wiki     = $wiki;
        $this->space    = $space;
        $this->request  = $request;
        $this->readList = $readList;
    }

    /**
     * Show a user profile.
     *
     * @param \App\Models\Team $team
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Team $team, User $user)
    {
        $spaces = $this->space->getTeamSpaces($team->id);

        $activities = $this->user->getActivty($user->id);

        return view('user.profile', compact('user', 'team', 'activities', 'spaces'));
    }

    /**
     * Update the user profile image.
     *
     * @param \App\Models\Team $team
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function updateAvatar(Team $team, User $user)
    {
        $img = $this->request->file('profile_image');

        $imgName = $this->uploadAvatar($img);

        $this->user->updateAvatar($user->id, $imgName);

        return redirect()->back()->with([
            'alert'      => 'Profile image successfully updated.',
            'alert_type' => 'success',
        ]);
    }

    /**
     * Upload profile image to server.
     *
     * @param $img
     * @return string
     */
    public function uploadAvatar($img)
    {
        $imgName = $this->generateImageName($img->getClientOriginalExtension());

        $img = Image::make($img);
        $img->crop((int)$this->request->get('w'), (int)$this->request->get('h'), (int)$this->request->get('x'), (int)$this->request->get('y'));
        $img->save($this->getUploadPath($imgName));

        return $imgName;
    }

    /**
     * Get the path where the profile image is being upload.
     *
     * @param string $imgName
     * @return string
     */
    private function getUploadPath($imgName)
    {
        return public_path('img/avatars/' . $imgName);
    }

    /**
     * Generate name for the user profile image.
     *
     * @param string $ext
     * @return string
     */
    private function generateImageName($ext)
    {
        return "img_" . date('Y-m-d-H-s') . "{$ext}";
    }

    /**
     * Get the user profile setting view to update profile.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profileSettings(Team $team)
    {
        return view('user.setting.profile', compact('team'));
    }

    /**
     * Get the view to update account settings.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View/
     */
    public function accountSettings(Team $team)
    {
        return view('user.setting.account', compact('team'));
    }

    /**
     * Update user data.
     *
     * @param \App\Models\Team $team
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Team $team, User $user)
    {
        $this->validate($this->request, [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|unique:users,email,' . Auth::user()->id . '|email',
        ]);

        $this->user->updateUser($user->slug, $this->request->all());

        return redirect()->back()->with([
            'alert'      => 'Profile successfully updated.',
            'alert_type' => 'success',
        ]);
    }

    /**
     * Update user password.
     *
     * @param \App\Models\Team $team
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Team $team, User $user)
    {
        $this->validate($this->request, [
            'password'              => 'required|hash:' . Auth::user()->password,
            'new_password'          => 'required|same:password_confirmation',
            'password_confirmation' => 'required',
        ]);

        $this->user->updatePassword($user->slug, $this->request->all());

        return $this->logout()->with([
            'alert'      => 'Your password successfully changed. You have to login again.',
            'alert_type' => 'success',
        ]);
    }

    /**
     * Delete the user account.
     *
     * @param \App\Models\Team $team
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAccount(Team $team, User $user)
    {
        $this->user->where('slug', '=', $user->slug)->delete();

        return $this->logout()->with([
            'alert'      => 'Your account successfully deleted.',
            'alert_type' => 'success',
        ]);
    }

    /**
     * Logout user.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::logout();
        Session::flush();

        return redirect('/');
    }

    /**
     * Get the user read list view.
     *
     * @param \App\Models\Team $team
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getReadList(Team $team, User $user)
    {
        $readList = $this->readList->getUserReadList($user->id);

        $spaces = $this->space->getTeamSpaces($team->id);

        return view('user.read-list', compact('team', 'readList', 'spaces'));
    }

    /**
     * Get the team dashboard view.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard(Team $team)
    {
        $spaces = $this->space->getTeamSpaces($team->id);

        $likeWikis = (new Like)->getUserLikeWikis(Auth::user()->id);

        $activities = $this->team->getActivty($team->id);

        $wikis = $this->wiki->getTeamWikis($team->id, 5);

        return view('team.dashboard', compact('team', 'activities', 'wikis', 'likeWikis', 'spaces'));
    }

    /**
     * Get all the members of a team.
     *
     * @return mixed
     */
    public function getTeamMembers()
    {
        return $this->team->where('id', Auth::user()->getTeam()->id)->with(['members'])->first()->members;
    }
}
