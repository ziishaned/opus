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
                'user_id'         => $team->user_id,
                'team_id'         => $team->id,
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ]);
        });
    }

    public function spaces()
    {
        return $this->hasMany(Space::class, 'team_id', 'id');
    }

    public function activity()
    {
        return $this->hasMany(Activity::class, 'team_id', 'id')->with(['user', 'subject' => function($query) {
            $query->withTrashed();
        }])->latest();
    }

    public function integration()
    {
        return $this->hasOne(Integration::class, 'team_id', 'id');
    }

    public function subject()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function roles()
    {
        return $this->hasMany(Role::class, 'team_id', 'id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'user_teams', 'team_id', 'user_id');
    }

    public function wikis()
    {
        return $this->hasMany(Wiki::class, 'team_id', 'id')->latest();
    }

    public function pages()
    {
        return $this->hasMany(Page::class, 'team_id', 'id')->latest();
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
        $team = $this->create([
            'name'        => $team['team_name'],
            'user_id'     => $team['user_id'],
        ]);

        return $team;
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
    
    public function getMembers($team)
    {
        $members = $this->find($team->id)->members()->paginate(30);

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
        $team = $this->find($id)->activity()->paginate(30);
        
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
