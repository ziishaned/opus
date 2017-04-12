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
use App\Models\Integration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    private $request;

    private $team;

    private $user;

    private $role;

    private $space;

    public function __construct(Request $request, Team $team, Role $role, User $user, Space $space)
    {
        $this->user    = $user;
        $this->request = $request;
        $this->team    = $team;
        $this->role    = $role;
    }

    public function getMembers(Team $team)
    {
        $teamMembers = $this->team->getMembers($team);

        return view('team.members', compact('team', 'teamMembers'));
    }

    public function join(Team $team, $hash)
    {
        Auth::logout();

        $invitation = (new Invite)->getInvitation($team->id, $hash);

        return view('team.join', compact('team', 'hash', 'invitation'));
    }

    public function isContentTypeJson()
    {
        return $this->request->header('content-type') == 'application/json';
    }

    public function update(Team $team)
    {
        if($team->name === $this->request->get('team_name')) {
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

    public function destroy(Team $team)
    {
        $this->team->deleteTeam($team->id);

        Auth::logout();

        return redirect()->route('team.login')->with([
            'alert'      => 'Team successfully deleted.',
            'alert_type' => 'success',
        ]);
    }

    public function postJoin(Team $team, $hash)
    {
        $this->validate($this->request, Team::JOIN_TEAM_RULES, [
            'exists'         => 'Specified team does\'t exists.',
            'team_has_email' => 'This team has alredy a user with this email address.',
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

    public function inviteUsers(Team $team)
    {
        return view('team.users.invite', compact('team'));
    }

    public function login()
    {
        return view('team.login');
    }

    public function postLogin()
    {
        $this->validate($this->request, User::LOGIN_RULES, [
            'exists' => 'Specified team does\'t exists..',
        ]);

        if($data = $this->user->validate($this->request->all())) {
            Auth::login($data, $this->request->get('remember'));

            return redirect()->route('dashboard', [
                $data->team_slug,
            ]);
        }

        return redirect()->back()->withErrors([
            'wrong_credential' => 'Email or password is not valid.'
        ]);
    }

    public function create()
    {
        return view('team.create');
    }

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

    public function generalSettings(Team $team)
    {
        return view('team.setting.general', compact('team'));
    }

    public function membersSettings(Team $team)
    {
        $members = $this->team->getMembers($team);

        $roles = $this->role->getTeamRoles($team->id);

        $invitations = (new Invite)->getTeamPendingInvitations($team->id);

        return view('team.setting.members', compact('team', 'members', 'roles', 'invitations'));
    }

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

    public function filterMembers()
    {
        $members = $this->team->find(Auth::user()->getTeam()->id)->with(['members' => function ($query) {
            $query->where('slug', 'like', '%' . $this->request->get('q') . '%')->get();
        }])->first()->members;

        return $members;
    }

    public function integration(Team $team)
    {
        $integrations = (new Integration)->getTeamIntegration($team->id);

        return view('team.setting.integration', compact('team', 'integrations'));
    }

    public function slackIntegration(Team $team)
    {
        return view('team.setting.slack', compact('team'));
    }

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
