<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Team;
use App\Models\Role;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    protected $request;

    protected $role;

    public function __construct(Request $request, Role $role)
    {
        $this->request = $request;
        $this->role    = $role;
    }

    public function index(Team $team)
    {
        $spaces = (new Space)->getTeamSpaces($team->id);

        $roles = $this->role->where('team_id', $team->id)->latest()->with(['members', 'permissions'])->get();

        return view('role.index', compact('team', 'roles', 'spaces'));
    }

    public function create(Team $team)
    {
        return view('role.create', compact('team'));
    }


    public function store(Team $team)
    {
        $this->validate($this->request, Role::ROLE_RULES);

        $role = $this->role->createRole($this->request->all());

        if($this->request->get('role_members')) {
            foreach ($this->request->get('role_members') as $member) {
                DB::table('users_roles')->insert([
                    'role_id'    => $role->id,
                    'user_id'    => $member,
                    'team_id'    => $team->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        if($this->request->get('permissions')) {
            foreach ($this->request->get('permissions') as $permission) {
                DB::table('role_permissions')->insert([
                    'role_id'       => $role->id,
                    'permission_id' => (int)$permission,
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now(),
                ]);
            }
        }

        return redirect()->route('roles.index', [$team->slug])->with([
            'alert'      => 'Role successfully created.',
            'alert_type' => 'success',
        ]);
    }

    public function edit(Team $team, Role $role)
    {
        return view('role.edit', compact('team', 'role'));
    }

    public function update(Team $team, Role $role)
    {
        $this->validate($this->request, Role::ROLE_RULES);

        $this->role->updateRole($role->id, $this->request->all());

        DB::table('users_roles')->where('role_id', $role->id)->delete();
        DB::table('role_permissions')->where('role_id', $role->id)->delete();

        if($this->request->get('role_members')) {
            foreach ($this->request->get('role_members') as $member) {
                DB::table('users_roles')->insert([
                    'role_id'    => $role->id,
                    'user_id'    => $member,
                    'team_id'    => $team->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        if($this->request->get('permissions')) {
            foreach ($this->request->get('permissions') as $permission) {
                DB::table('role_permissions')->insert([
                    'role_id'       => $role->id,
                    'permission_id' => (int)$permission,
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now(),
                ]);
            }
        }

        return redirect()->route('roles.index', [$team->slug])->with([
            'alert'      => 'Role successfully updated.',
            'alert_type' => 'success',
        ]);
    }

    public function destroy(Team $team, Role $role)
    {
        $this->role->find($role->id)->delete();

        return redirect()->route('roles.index', [$team->slug])->with([
            'alert'      => 'Role successfully deleted.',
            'alert_type' => 'success',
        ]);
    }
}
