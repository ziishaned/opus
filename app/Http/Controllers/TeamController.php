<?php

namespace App\Http\Controllers;

use DB;
use Image;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Team;
use App\Models\Role;
use App\Models\Space;
use App\Models\Invite;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class TeamController
 *
 * @package App\Http\Controllers
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class TeamController extends Controller
{
    /**
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * @var \App\Models\Team
     */
    private $team;

    /**
     * @var \App\Models\User
     */
    private $user;

    /**
     * @var \App\Models\Role
     */
    private $role;

    /**
     * @var
     */
    private $space;

    /**
     * TeamController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Team         $team
     * @param \App\Models\Role         $role
     * @param \App\Models\User         $user
     * @param \App\Models\Space        $space
     */
    public function __construct(Request $request, Team $team, Role $role, User $user, Space $space)
    {
        $this->user    = $user;
        $this->request = $request;
        $this->team    = $team;
        $this->role    = $role;
    }

    /**
     * Get all the members of a team in a view.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getMembers(Team $team)
    {
        $teamMembers = $this->team->getMembers($team);

        return view('team.members', compact('team', 'teamMembers'));
    }

    /**
     * Show a join team view to invited user.
     *
     * @param \App\Models\Team $team
     * @param                  $hash
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function join(Team $team, $hash)
    {
        Auth::logout();

        $invitation = (new Invite)->getInvitation($team->id, $hash);

        return view('team.join', compact('team', 'hash', 'invitation'));
    }

    /**
     * Update team.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Team $team)
    {
        if ($team->name === $this->request->get('team_name')) {
            return redirect()->back()->with([
                'alert'      => 'Team name successfully updated.',
                'alert_type' => 'success',
            ]);
        }

        $this->validate($this->request, Team::TEAM_RULES);

        $this->team->updateTeam($team->id, $this->request->get('team_name'));

        Auth::logout();

        return redirect()->route('team.login')->with([
            'alert'      => 'Team name successfully updated. You need to login to team again.',
            'alert_type' => 'success',
        ]);
    }

    /**
     * Delete a team.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Team $team)
    {
        $this->team->deleteTeam($team->id);

        Auth::logout();

        return redirect()->route('team.login')->with([
            'alert'      => 'Team successfully deleted.',
            'alert_type' => 'success',
        ]);
    }

    /**
     * Make invited user member of a team.
     *
     * @param \App\Models\Team $team
     * @param                  $hash
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postJoin(Team $team, $hash)
    {
        $this->validate($this->request, Team::JOIN_TEAM_RULES, [
            'exists'         => 'Specified team does\'t exists.',
            'team_has_email' => 'This team has already a user with this email address.',
        ]);

        $user = $this->user->createUser($this->request->all());

        DB::table('user_teams')->insert([
            'user_id'    => $user->id,
            'team_id'    => $team->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $invitation = (new Invite)->getInvitation($team->id, $hash);

        DB::table('users_roles')->insert([
            'role_id'    => $invitation->role_id,
            'user_id'    => $user->id,
            'team_id'    => $team->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        (new Invite)->claimAccount($team->id, $hash);

        return redirect()->route('home')->with([
            'alert'      => 'Team successfully joined. You can login to this team now.',
            'alert_type' => 'success',
        ]);
    }

    /**
     * Show a view to invite user to a team.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function inviteUsers(Team $team)
    {
        return view('team.users.invite', compact('team'));
    }

    /**
     * Show login view to guest.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('team.login');
    }

    /**
     * Login user to team.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin()
    {
        $this->validate($this->request, User::LOGIN_RULES, [
            'exists' => 'Specified team does\'t exists..',
        ]);

        if ($data = $this->user->validate($this->request->all())) {
            Auth::login($data, $this->request->get('remember'));

            return redirect()->route('dashboard', [
                $data->team_slug,
            ]);
        }

        return redirect()->back()->withErrors([
            'wrong_credential' => 'Email or password is not valid.',
        ]);
    }

    /**
     * Show create team view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('team.create');
    }

    /**
     * Create a new team.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate($this->request, Team::CREATE_TEAM_RULES);

        $user = $this->user->createUser($this->request->all());

        $teamRequestData = collect($this->request->all())->put('user_id', $user->id);
        $team            = $this->team->postTeam($teamRequestData);

        $this->createAdminsRole($team);

        return redirect()->route('home')->with([
            'alert'      => 'Team successfully created. Now login to your team!',
            'alert_type' => 'success',
        ]);
    }

    /**
     * Create admin role when a user create a team.
     *
     * @param $team
     * @return bool
     */
    public function createAdminsRole($team)
    {
        // Create role
        $roleId = DB::table('roles')->insertGetId([
            'name'       => 'Admins',
            'slug'       => str_slug('Admins', '-'),
            'user_id'    => $team->user_id,
            'team_id'    => $team->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Implementing permissions on role
        $permissions = DB::table('permissions')->get();
        foreach ($permissions as $permission) {
            DB::table('role_permissions')->insert([
                'role_id'       => $roleId,
                'permission_id' => $permission->id,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
        }

        // Inserting user into role.
        DB::table('users_roles')->insertGetId([
            'role_id'    => $roleId,
            'user_id'    => $team->user_id,
            'team_id'    => $team->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return true;
    }

    /**
     * Show general setting view.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function generalSettings(Team $team)
    {
        return view('team.setting.general', compact('team'));
    }

    /**
     * Get all the members of a team.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function membersSettings(Team $team)
    {
        $members = $this->team->getMembers($team);

        $roles = $this->role->getTeamRoles($team->id);

        $invitations = (new Invite)->getTeamPendingInvitations($team->id);

        return view('team.setting.members', compact('team', 'members', 'roles', 'invitations'));
    }

    /**
     * Upload team logo.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadLogo(Team $team)
    {
        $image = $this->request->file('team_logo');

        $imageName = 'img_' . date('Y-m-d-H-s') . '.' . $this->request->file('team_logo')->getClientOriginalExtension();

        $img = Image::make($image);
        $img->crop((int)$this->request->get('w'), (int)$this->request->get('h'), (int)$this->request->get('x'), (int)$this->request->get('y'));
        $img->save('img/avatars/' . $imageName);

        $this->team->updateImage($team->id, $imageName);

        return redirect()->back()->with([
            'alert'      => 'Team logo successfully uploaded.',
            'alert_type' => 'success',
        ]);
    }

    /**
     * Filter members of a team.
     *
     * @return mixed
     */
    public function filterMembers()
    {
        return $this->team->where('id', Auth::user()->getTeam()->id)->with(['members' => function ($query) {
            $query->where('slug', 'like', '%' . $this->request->get('q') . '%');
        }])->first()->members;
    }

    /**
     * Team search functionality
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search()
    {
        $data  = [];
        $query = $this->request->get('q');
        $team  = Auth::user()->getTeam();

        $wikis   = Team::find($team->id)->wikis()->where('name', 'like', '%' . $query . '%')->take(5)->get();
        $spaces  = Team::find($team->id)->spaces()->where('name', 'like', '%' . $query . '%')->take(5)->get();
        $pages   = Team::find($team->id)->pages()->where('name', 'like', '%' . $query . '%')->take(5)->get();
        $members = Team::find($team->id)->members()->where('name', 'like', '%' . $query . '%')->take(5)->get();

        $data['wikis']   = $this->formatWikis($wikis, $team);
        $data['spaces']  = $this->formatSpaces($spaces, $team);
        $data['pages']   = $this->formatPages($pages, $team);
        $data['members'] = $this->formatMembers($members, $team);

        return response()->json($data, 200);
    }

    /**
     * Format search result.
     *
     * @param $members
     * @param $team
     * @return array
     */
    public function formatMembers($members, $team)
    {
        $data = [];

        foreach ($members as $member) {
            $data[] = [
                'text' => $member->first_name . ' ' . $member->last_name,
                'link' => route('users.show', [$team->slug, $member->slug]),
            ];
        }

        return $data;
    }

    /**
     * Format search result.
     *
     * @param $pages
     * @param $team
     * @return array
     */
    public function formatPages($pages, $team)
    {
        $data = [];

        foreach ($pages as $page) {
            $data[] = [
                'text' => $page->name,
                'link' => route('pages.show', [$team->slug, $page->wiki->space->slug, $page->wiki->slug, $page->slug]),
            ];
        }

        return $data;
    }

    /**
     * Format search result.
     *
     * @param $wikis
     * @param $team
     * @return array
     */
    public function formatWikis($wikis, $team)
    {
        $data = [];

        foreach ($wikis as $wiki) {
            $data[] = [
                'text' => $wiki->name,
                'link' => route('wikis.show', [$team->slug, $wiki->space->slug, $wiki->slug]),
            ];
        }

        return $data;
    }

    /**
     * Format search result.
     *
     * @param $spaces
     * @param $team
     * @return array
     */
    public function formatSpaces($spaces, $team)
    {
        $data = [];

        foreach ($spaces as $space) {
            $data[] = [
                'text' => $space->name,
                'link' => route('spaces.wikis', [$team->slug, $space->slug]),
            ];
        }

        return $data;
    }
}
