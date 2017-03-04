<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamGroups extends Model
{
	use SoftDeletes;

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

    public function team()
    {
    	return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
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
}
