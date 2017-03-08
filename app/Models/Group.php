<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
	use SoftDeletes, Sluggable;

    protected $table = 'groups';

    protected $fillable = [
    	'name',
    	'user_id',
    	'team_id',
    	'created_at',
    	'updated_at',
    ];

    protected $dates = ['deleted_at'];

    const GROUP_RULES = [
        'group_name' => 'required|unique:groups,name'
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
            'team_id' => Auth::user()->getTeam()->id,
        ]);

        return $group;
    }

    public function updateGroup($id, $data)
    {
        $group = $this->find($id)->update([
            'name' => $data['group_name'],
            'user_id' => Auth::user()->id,
            'team_id' => Auth::user()->getTeam()->id,
        ]);

        return $group;
    }
}
