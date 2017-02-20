<?php

namespace App\Http\Controllers;

use DB;
use Mail;
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

    public function update($id)
    {
        $this->validate($this->request, Team::Team_RULES);
        $updated = $this->team->updateTeam($id, $this->request->get('team_name'));
        if ($updated) {
            return response()->json([
                'message' => 'Team successfully updated.',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Resource not found.',
        ], Response::HTTP_NOT_FOUND);
    }

    public function destroy($id)
    {
        $teamDeleted = $this->team->deleteTeam($id);
        if ($teamDeleted) {
            return redirect()->route('dashboard')->with([
                'alert'      => 'team successfully deleted.',
                'alert_type' => 'success',
            ]);
        }

        return response()->json([
            'message' => 'We are having some issues.',
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
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
}
