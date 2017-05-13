<?php

namespace App\Models;

use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Team
 *
 * @package App\Models
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class Team extends Model
{
    use Sluggable, SoftDeletes;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
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
        'email'      => 'required|email',
        'first_name' => 'required|max:10',
        'last_name'  => 'required|max:10',
        'password'   => 'required|min:6|confirmed',
        'team_name'  => 'required|unique:teams,name',
    ];

    const JOIN_TEAM_RULES = [
        'email'      => 'required|email|team_has_email',
        'first_name' => 'required|max:15',
        'last_name'  => 'required|max:15',
        'password'   => 'required|min:6|confirmed',
        'team_name'  => 'required|exists:teams,name',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'teams';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'team_logo', 'user_id', 'updated_at', 'created_at',
    ];

    protected $dates = ['deleted_at'];

    public static function boot()
    {
        parent::boot();

        Team::created(function ($team) {
            DB::table('user_teams')->insert([
                'user_id'    => $team->user_id,
                'team_id'    => $team->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        });
    }

    /**
     * Get the spaces that owns the team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function spaces()
    {
        return $this->hasMany(Space::class, 'team_id', 'id');
    }

    /**
     * Get the activities that owns the team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity()
    {
        return $this->hasMany(Activity::class, 'team_id', 'id')->with(['user', 'subject' => function ($query) {
            $query->withTrashed();
        }])->latest();
    }

    /**
     * Get the integrations that owns the team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function integration()
    {
        return $this->hasOne(Integration::class, 'team_id', 'id');
    }

    public function subject()
    {
        return $this->morphTo();
    }

    /**
     * Get the user that owns the team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the roles that owns the team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles()
    {
        return $this->hasMany(Role::class, 'team_id', 'id');
    }

    /**
     * Get the users that owns the team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany(User::class, 'user_teams', 'team_id', 'user_id');
    }

    /**
     * Get the wikis that owns the team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wikis()
    {
        return $this->hasMany(Wiki::class, 'team_id', 'id')->latest();
    }

    /**
     * Get the pages that owns the team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pages()
    {
        return $this->hasMany(Page::class, 'team_id', 'id')->latest();
    }

    /**
     * Get a specific team.
     *
     * @param $teamSlug string
     * @return bool
     */
    public function getTeam($teamSlug)
    {
        $team = $this->where('slug', '=', $teamSlug)->with(['user', 'wikis', 'members'])->first();

        if ($team) {
            return $team;
        }

        return false;
    }

    /**
     * Create a new team.
     *
     * @param $team
     * @return \App\Models\Team
     */
    public function postTeam($team)
    {
        return $this->create([
            'name'    => $team['team_name'],
            'user_id' => $team['user_id'],
        ]);
    }

    /**
     * Update an existing team.
     *
     * @param $id       integer
     * @param $teamName string
     * @return bool
     */
    public function updateTeam($id, $teamName)
    {
        return $this->find($id)->update([
            'name' => $teamName,
        ]);
    }

    /**
     * Delete a team.
     *
     * @param $id integer
     * @return bool
     */
    public function deleteTeam($id)
    {
        return $this->find($id)->forceDelete();
    }

    /**
     * Get all the members of a team.
     *
     * @param $team object
     * @return mixed
     */
    public function getMembers($team)
    {
        return $this->find($team->id)->members()->paginate(30);
    }

    /**
     * Validate a user is the member of a team.
     *
     * @param $userId integer
     * @param $teamId integer
     * @return bool
     */
    public function isMember($userId, $teamId)
    {
        $member = DB::table('user_teams')->where([
            'user_id' => $userId,
            'team_id' => $teamId,
        ])->first();

        if ($member) {
            return true;
        }

        return false;
    }

    /**
     * Get all the activities of a team.
     *
     * @param $id integer
     * @return mixed
     */
    public function getActivty($id)
    {
        return $this->find($id)->activity()->paginate(30);
    }

    /**
     * Update the logo of a team.
     *
     * @param $id    integer
     * @param $image string
     * @return bool
     */
    public function updateImage($id, $image)
    {
        return $this->find($id)->update([
            'team_logo' => $image,
        ]);
    }

    /**
     * Check if a user exists in a team. If user not exists then show 404 view or if found return the user.
     *
     * @param $passwordReset
     * @return array|null|\stdClass
     */
    public function getUser($passwordReset)
    {
        $user = DB::table('users')
            ->join('user_teams', 'users.id', '=', 'user_teams.user_id')
            ->join('teams', 'user_teams.team_id', '=', 'teams.id')
            ->where('teams.name', '=', $passwordReset->team_name)
            ->where('users.email', '=', $passwordReset->email)
            ->select('users.*')
            ->first();

        if (!$user) {
            abort(404);
        }

        return $user;
    }

    public static function getIntegration($teamId)
    {
         $team = self::where('id', $teamId)->with(['integration'])->first();

         return $team->integration;
    }
}
