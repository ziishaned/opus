<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Mail;
use Image;
use Redirect;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\{Auth, Session};
use App\Models\{User, Team, Group, Invite, Space, Integration};

class TeamController extends Controller
{
    private $request;

    private $team;

    private $user;

    private $group;

    private $space;

    public function __construct(Request $request,
                                Team $team,
                                Group $group,
                                User $user,
                                Space $space)
    {
        $this->user         =   $user;
        $this->request      =   $request;
        $this->space        =   $space;
        $this->team         =   $team;
        $this->group        =   $group;
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

    public function edit($id)
    {

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
            'exists' => 'Specified team does\'t exists.',
            'team_has_email' => 'This team has alredy a user with this email address.',
        ]);
    
        $user  = $this->user->createUser($this->request->all());

        DB::table('user_teams')->insert([
            'user_id'         => $user->id,
            'team_id'         => $team->id,
            'created_at'      => Carbon::now(),
            'updated_at'      => Carbon::now(),
        ]);

        $invitation = (new Invite)->getInvitation($team->id, $hash);

        DB::table('users_groups')->update([
            'group_id' => $invitation->group_id,
            'user_id' => $user->id,
            'team_id' => $team->id,
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
            'exists' => 'Specified team does\'t exists..' 
        ]);

        if($data = $this->user->validate($this->request->all())) {
            Auth::login($data, $this->request->get('remember'));

            return redirect()->route('dashboard', [
                $data->team_slug, 
            ]);
        } 

        return redirect()->back()->with([
            'alert'      => 'Email or password is not valid.',
            'alert_type' => 'danger',
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
        $team = $this->team->postTeam($teamRequestData);

        $this->createAdminsGroup($team);

        return redirect()->route('home')->with([
            'alert'      => 'Team successfully created. Now login to your team!',
            'alert_type' => 'success',
        ]);
    }

    public function createAdminsGroup($team)
    {
        // Create group
        $groupId = DB::table('groups')->insertGetId([
            'name'       => 'Admins',
            'slug'       => str_slug('Admins', '-'),
            'user_id'    => $team->user_id,
            'team_id'    => $team->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Implementing permissions on group
        $permissions = DB::table('permissions')->get();
        foreach ($permissions as $permission) {
            DB::table('group_permissions')->insert([
                'group_id' => $groupId,
                'permission_id' => $permission->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Inserting user into group.
        DB::table('users_groups')->insertGetId([
            'group_id'   => $groupId,
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

        $groups = $this->group->getTeamGroups($team->id);

        $invitations = (new Invite)->getTeamPendingInvitations($team->id);

        return view('team.setting.members', compact('team', 'members', 'groups', 'invitations'));
    }

    public function groupSettings(Team $team)
    {
        $groups = $this->group->where('team_id', $team->id)->latest()->with(['members', 'permissions'])->get();

        return view('team.setting.group', compact('team', 'groups'));
    }

    public function createGroup(Team $team)
    {
        return view('team.setting.create-group', compact('team'));
    }

    public function uploadLogo(Team $team)
    {
        $image = $this->request->file('team_logo');
        
        $imageName = 'img_' . date('Y-m-d-H-s') .  '.' . $this->request->file('team_logo')->getClientOriginalExtension();

        $img = Image::make($image);
        $img->crop((int) $this->request->get('w'), (int) $this->request->get('h'), (int) $this->request->get('x'), (int) $this->request->get('y'));
        $img->save('img/avatars/' . $imageName);
        
        $this->team->updateImage($team->id, $imageName);

        return redirect()->back()->with([
            'alert'      => 'Team logo successfully uploaded.',
            'alert_type' => 'success',
        ]);
    }

    public function filterMembers()
    {
        $members = $this->team->find(Auth::user()->getTeam()->id)->with(['members' => function($query) {
            $query->where('slug', 'like', '%'.$this->request->get('q').'%')->get();
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
}
