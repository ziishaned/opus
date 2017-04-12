<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\Team;
use App\Models\Role;
use App\Models\Space;
use Illuminate\Http\Request;

/**
 * Class RoleController
 *
 * @package App\Http\Controllers
 */
class RoleController extends Controller
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var \App\Models\Role
     */
    protected $role;

    /**
     * RoleController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Role         $role
     * @param \App\Models\Space        $space
     */
    public function __construct(Request $request, Role $role, Space $space)
    {
        $this->space   = $space;
        $this->role    = $role;
        $this->request = $request;
    }

    /**
     * Get all roles of team.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Team $team)
    {
        $spaces = $this->space->getTeamSpaces($team->id);

        $roles = $this->role->getTeamRoles($team->id);

        return view('role.index', compact('team', 'roles', 'spaces'));
    }

    /**
     * Show a view to create new role.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Team $team)
    {
        return view('role.create', compact('team'));
    }

    /**
     * Create a new team role.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Team $team)
    {
        $this->validate($this->request, Role::ROLE_RULES);

        $role = $this->role->createRole($this->request->all());

        if ($this->request->get('role_members')) {
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

        if ($this->request->get('permissions')) {
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

    /**
     * Show a view to update an existing role.
     *
     * @param \App\Models\Team $team
     * @param \App\Models\Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Team $team, Role $role)
    {
        return view('role.edit', compact('team', 'role'));
    }

    /**
     * Update an existing role.
     *
     * @param \App\Models\Team $team
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Team $team, Role $role)
    {
        $this->validate($this->request, Role::ROLE_RULES);

        $this->role->updateRole($role->id, $this->request->all());

        DB::table('users_roles')->where('role_id', $role->id)->delete();
        DB::table('role_permissions')->where('role_id', $role->id)->delete();

        if ($this->request->get('role_members')) {
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

        if ($this->request->get('permissions')) {
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

    /**
     * Delete an existing role.
     *
     * @param \App\Models\Team $team
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Team $team, Role $role)
    {
        $this->role->find($role->id)->delete();

        return redirect()->route('roles.index', [$team->slug])->with([
            'alert'      => 'Role successfully deleted.',
            'alert_type' => 'success',
        ]);
    }
}
