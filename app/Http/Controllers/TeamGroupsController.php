<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Team;
use App\Models\TeamGroups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamGroupsController extends Controller
{
    protected $request;
    
    protected $group;

    public function __construct(Request $request, TeamGroups $group)
    {
        $this->request  = $request;
        $this->group    = $group;
    }

    public function index()
    {
        
    }

    public function create()
    {
        
    }

    public function store(Team $team)
    {
        $this->validate($this->request, TeamGroups::GROUP_RULES);

        $group = $this->group->createGroup($this->request->all());

        foreach ($this->request->get('group_members') as $member) {
            DB::table('users_groups')->insert([
                'group_id' => $group->id,
                'user_id' => $member,
                'team_id' => $team->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        foreach ($this->request->get('permissions') as $permission) {
            DB::table('group_permissions')->insert([
                'group_id' => $group->id,
                'permission_id' => (int)$permission,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        return redirect()->route('teams.settings.groups', [$team->slug])->with([
            'alert'      => 'Group successfully created.',
            'alert_type' => 'success',
        ]);        
    }

    public function show($id)
    {
        
    }

    public function edit(Team $team, TeamGroups $group)
    {
        return view('group.edit', compact('team', 'group'));
    }

    public function update(Team $team, TeamGroups $group)
    {
        $this->validate($this->request, [
            'group_name' => 'required',
        ]);

        $this->group->updateGroup($group->id, $this->request->all());

        DB::table('users_groups')->where('group_id', $group->id)->delete();
        DB::table('group_permissions')->where('group_id', $group->id)->delete();

        foreach ($this->request->get('group_members') as $member) {
            DB::table('users_groups')->insert([
                'group_id' => $group->id,
                'user_id' => $member,
                'team_id' => $team->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        foreach ($this->request->get('permissions') as $permission) {
            DB::table('group_permissions')->insert([
                'group_id' => $group->id,
                'permission_id' => (int)$permission,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        return redirect()->route('teams.settings.groups', [$team->slug])->with([
            'alert'      => 'Group successfully updated.',
            'alert_type' => 'success',
        ]);
    }

    public function destroy(Team $team, TeamGroups $group)
    {
        $this->group->find($group->id)->delete();

        return redirect()->route('teams.settings.groups', [$team->slug])->with([
            'alert'      => 'Group successfully deleted.',
            'alert_type' => 'success',
        ]); 
    }
}
