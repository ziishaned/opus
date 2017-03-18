<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
	use SoftDeletes, Sluggable;

    protected $table = 'roles';

    protected $fillable = [
    	'name',
    	'user_id',
    	'team_id',
    	'created_at',
    	'updated_at',
    ];

    protected $dates = ['deleted_at'];

    const ROLE_RULES = [
        'role_name' => 'required|unique:roles,name'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function team()
    {
    	return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'users_roles', 'role_id', 'user_id');
    }

    public function permissions()
    {
    	return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id');
    }

    public function createRole($data)
    {
        $role = $this->create([
            'name' => $data['role_name'],
            'user_id' => Auth::user()->id,
            'team_id' => Auth::user()->getTeam()->id,
        ]);

        return $role;
    }

    public function updateRole($id, $data)
    {
        $role = $this->find($id)->update([
            'name' => $data['role_name'],
            'user_id' => Auth::user()->id,
            'team_id' => Auth::user()->getTeam()->id,
        ]);

        return $role;
    }

    public function getTeamRoles($teamId)
    {
        $roles = $this->where('team_id', $teamId)->latest()->with(['members', 'permissions'])->get();

        return $roles;
    }
}
