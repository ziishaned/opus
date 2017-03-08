<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use Sluggable, SoftDeletes;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    const TEAM_RULES = [
        'team_name' => 'required|unique:teams,name',
    ];

    const CREATE_TEAM_RULES = [
        'email'             => 'required|email',
        'first_name'        => 'required|max:10',
        'last_name'         => 'required|max:10',
        'password'          => 'required|min:6|confirmed',
        'team_name'         => 'required|unique:teams,name',
    ];

    const JOIN_TEAM_RULES = [
        'email'             => 'required|email|team_has_email',
        'first_name'        => 'required|max:15',
        'last_name'         => 'required|max:15',
        'password'          => 'required|min:6|confirmed',
        'team_name'         => 'required|exists:teams,name',
    ];

    protected $table = 'teams';

    protected $fillable = [
        'name',
        'team_logo',
        'user_id',
        'updated_at',
        'created_at',
    ];

    protected $dates = ['deleted_at'];

    public static function boot()
    {
        parent::boot();
        
        Team::created(function($team) {
            DB::table('user_teams')->insert([
                'user_type'       => 'admin',
                'user_id'         => $team->user_id,
                'team_id'         => $team->id,
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ]);
        });
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'team_id', 'id');
    }

    public function activity()
    {
        return $this->hasMany(Activity::class, 'team_id', 'id')->with(['user', 'subject' => function($query) {
            $query->withTrashed();
        }])->latest();
    }

    public function subject()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function groups()
    {
        return $this->hasMany(Group::class, 'team_id', 'id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'user_teams', 'team_id', 'user_id')->withPivot('created_at as joined_date', 'user_type as user_role');
    }

    public function wikis()
    {
        return $this->hasMany(Wiki::class, 'team_id', 'id')->latest();
    }

    public function getTeam($teamSlug)
    {
        $team = $this->where('slug', '=', $teamSlug)
                             ->with(['user', 'wikis', 'members'])
                             ->first();
        if ($team) {
            return $team;
        }

        return false;
    }

    public function postTeam($team)
    {
        $this->create([
            'name'        => $team['team_name'],
            'user_id'     => $team['user_id'],
        ]);

        return true;
    }

    public function updateTeam($id, $teamName)
    {
        $this->find($id)->update([
            'name' => $teamName,
        ]);

        return true;
    }

    public function deleteTeam($id)
    {
        $this->find($id)->forceDelete();
            
        return true;
    }

    public function inviteUser($data)
    {
        $userHaveTeam = DB::table('user_teams')
                                  ->whereIn('user_id', [$data['userId']])
                                  ->whereIn('team_id', [$data['teamId']])
                                  ->first();
        if (!$userHaveTeam) {
            DB::table('user_teams')->insert([
                'user_type'       => 'normal',
                'user_id'         => $data['userId'],
                'team_id' => $data['teamId'],
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ]);

            return true;
        }

        return true;
    }

    public function removeInvite($data)
    {
        DB::table('user_teams')
          ->where('user_id', '=', $data['userId'])
          ->where('team_id', '=', $data['teamId'])
          ->delete();

        return true;
    }

    public function getMembers($team)
    {
        $members = $this->find($team->id)->members()->paginate(10);

        return $members;
    }

    public function isMember($userId, $teamId)
    {
        $member = DB::table('user_teams')->where([
            'user_id'         => $userId,
            'team_id' => $teamId,
        ])->first();

        if ($member) {
            return true;
        }

        return false;
    }

    public function getActivty($id)
    {
        $team = $this->where('id', $id)->with(['activity'])->first();
        
        return $team;
    }

    public function updateImage($id, $image)
    {
        $this->find($id)->update([
            'team_logo' => $image,
        ]);

        return true;
    }
}
