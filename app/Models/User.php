<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @author  Zeshan Ahmed <ziishaned@gmail.com>
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable, Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source'    => ['first_name', 'last_name'],
                'separator' => '_',
            ],
        ];
    }

    const LOGIN_RULES = [
        'email'    => 'required|email',
        'password' => 'required',
        'team_name' => 'required|exists:teams,name',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'profile_image',
        'timezone',
        'email',
        'password',
    ];

    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function category()
    {
        return $this->hasMany(Category::class, 'user_id', 'id');
    }

    public function team()
    {
        return $this->belongsToMany(Team::class, 'user_teams', 'user_id', 'team_id');
    }

    public function getTeam()
    {
        return $this->team->first();
    }

    public function groups()
    {
        return $this->hasMany(Group::class, 'user_id', 'id')->with('permissions');
    }

    /**
     * DESC
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity()
    {
        return $this->hasMany(Activity::class, 'user_id', 'id')->with(['subject' => function($query) {
            $query->withTrashed();
        }, 'user'])->latest();
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'user_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function subject()
    {
        return $this->morphTo();
    }

    /**
     * DESC
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    /**
     * A user can has many wikis.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wikis()
    {
        return $this->hasMany(Wiki::class, 'user_id', 'id')->latest();
    }

    /**
     * A user can create many pages in a wiki.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany(WikiPage::class, 'user_id', 'id');
    }

    /**
     * Get all resources.
     *
     * @param $userSlug
     *
     * @return bool
     */
    public function getUser($userSlug)
    {
        $user = $this->where('slug', '=', $userSlug)->first();

        if ($user) {
            return $user;
        }

        return false;
    }

    /**
     * Get all the wikis of a user.
     *
     * @param $user
     *
     * @return \App\Models\User
     */
    public function getWikis($user)
    {
        $userWikis = $this->find($user->id)->wikis()->paginate(10);

        return $userWikis;
    }

    public function updateUser($slug, $data)
    {
        $this->where('slug', '=', $slug)->update([
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'timezone'      => !empty($data['timezone']) ? $data['timezone'] : null,
            'email'         => $data['email'],
        ]);

        return true;
    }

    public function updatePassword($slug, $data)
    {
        $this->where('slug', $slug)->update([
            'password' => Hash::make($data['new_password']),
        ]);

        return true;
    }

    public function createUser($data)
    {
        $user = $this->create([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'password'   => Hash::make($data['password']),
            'email'      => $data['email'],
        ]);

        return $user;
    }

    public function getActivty($id)
    {
        $activity = $this->find($id)->activity()->paginate(30);

        return $activity;
    }

    public function validate($data) 
    {
        $user = $this
            ->join('user_teams', 'users.id', '=', 'user_teams.user_id')
            ->join('teams', 'user_teams.team_id', '=', 'teams.id')
            ->where('teams.name', '=', $data['team_name'])
            ->where('users.email', '=', $data['email'])
            ->select('users.*', 'teams.slug as team_slug')
            ->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            return $user;
        }

        return false;
    }

    public function hasPermission($routePermissions)
    {
        $routePermissions = explode('|', $routePermissions);
        
        $groups = $this->with('groups')->findOrFail(Auth::user()->id)->groups;

        foreach ($groups as $group) {
            foreach ($group->permissions as $permission) {
                foreach ($routePermissions as $routePer) {
                    if($permission->name === $routePer) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    public function updateAvatar($id, $image)
    {
        $this->find($id)->update([
            'profile_image' => $image,
        ]);

        return true;
    }
}
