<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamGroups extends Model
{
	use SoftDeletes, Sluggable;

    protected $table = 'team_groups';

    protected $fillable = [
    	'name',
    	'user_id',
    	'team_id',
    	'created_at',
    	'updated_at',
    ];

    protected $dates = ['deleted_at'];

    const GROUP_RULES = [
        'group_name' => 'required|unique:team_groups,name'
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
        return $this->belongsToMany(User::class, 'users_groups', 'group_id', 'user_id');
    }

    public function permissions()
    {
    	return $this->belongsToMany(Permission::class, 'group_permissions', 'group_id', 'permission_id');
    }

    public function createGroup($data)
    {
        $group = $this->create([
            'name' => $data['group_name'],
            'user_id' => Auth::user()->id,
            'team_id' => Auth::user()->team->id,
        ]);

        return $group;
    }

    public function updateGroup($id, $data)
    {
        $group = $this->find($id)->update([
            'name' => $data['group_name'],
            'user_id' => Auth::user()->id,
            'team_id' => Auth::user()->team->id,
        ]);

        return $group;
    }

    public function can($permission = null)
    {
        return !is_null($permission) && $this->checkPermission($permission);
    }

    protected function checkPermission($perm)
    {
        $permissions = $this->getAllPernissionsFormAllRoles();

        $permissionArray = is_array($perm) ? $perm : [$perm];
        
        return count(array_intersect($permissions, $permissionArray));
    }

    protected function getAllPernissionsFormAllRoles()
    {
        $permissionsArray = [];

        $permissions = $this->roles->load('permissions')->fetch('permissions')->toArray();
        
        return array_map('strtolower', array_unique(array_flatten(array_map(function ($permission) {

            return array_fetch($permission, 'permission_slug');

        }, $permissions))));
    }
}
