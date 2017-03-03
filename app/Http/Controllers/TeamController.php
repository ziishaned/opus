<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use Image;
use Redirect;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Category;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class TeamController extends Controller
{
    private $request;

    private $team;

    private $user;


    private $category;

    public function __construct(Request $request,
                                Team $team,
                                User $user,
                                Category $category)
    {
        $this->user         = $user;
        $this->request      = $request;
        $this->category     = $category;
        $this->team = $team;
    }

    public function getMembers(Team $team)
    {
        $teamMembers = $this->team->getMembers($team);

        return view('team.members', compact('team', 'teamMembers'));
    }

    public function join()
    {
        return view('team.join');
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

    public function postJoin()
    {
        $this->validate($this->request, Team::JOIN_TEAM_RULES, [
            'exists' => 'Specified team does\'t exists.',
            'team_has_email' => 'This team has alredy a user with this email address.',
        ]);

        $team = $this->team->where('name', $this->request->get('team_name'))->first();
    
        $user  = $this->user->createUser($this->request->all());

        DB::table('user_teams')->insert([
            'user_type'       => 'normal',
            'user_id'         => $user->id,
            'team_id'         => $team->id,
            'created_at'      => Carbon::now(),
            'updated_at'      => Carbon::now(),
        ]);

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
        
        $team = collect($this->request->all())->put('user_id', $user->id);
        $this->team->postTeam($team);

        return redirect()->route('home')->with([
            'alert'      => 'Team successfully created. Now login to your team!',
            'alert_type' => 'success',
        ]);
    }

    public function generalSettings(Team $team)
    {
        return view('team.setting.general', compact('team'));
    }

    public function membersSettings(Team $team)
    {
        return view('team.setting.members', compact('team'));
    }

    public function permissionSettings(Team $team)
    {
        return view('team.setting.permission', compact('team'));
    }

    public function groupSettings(Team $team)
    {
        return view('team.setting.group', compact('team'));
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
}
