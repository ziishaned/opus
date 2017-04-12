<?php

namespace App\Models;

use Auth;
use Hash;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Fenos\Notifynder\Traits\NotifableLaravel53 as NotifableTrait;

/**
 * Class User
 *
 * @author  Zeshan Ahmed <ziishaned@gmail.com>
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable, Sluggable, NotifableTrait;

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
        'email'     => 'required|email',
        'password'  => 'required',
        'team_name' => 'required|exists:teams,name',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'first_name', 'last_name', 'profile_image', 'timezone', 'email', 'password',
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the wikis that are watched by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function watchWikis()
    {
        return $this->hasMany(WatchWiki::class, 'user_id', 'id');
    }

    /**
     * Get the roles that owns the user.
     *
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'role_id')->with('permissions');
    }

    /**
     * Get the space that owns the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function space()
    {
        return $this->hasMany(Space::class, 'user_id', 'id');
    }

    /**
     * Get the team that owns the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function team()
    {
        return $this->belongsToMany(Team::class, 'user_teams', 'user_id', 'team_id');
    }

    /**
     * Get the team of authenticated user.
     *
     * @return mixed
     */
    public function getTeam()
    {
        return $this->team->first();
    }

    /**
     * Get the activities that owns the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity()
    {
        return $this->hasMany(Activity::class, 'user_id', 'id')->with(['subject' => function ($query) {
            $query->withTrashed();
        }, 'user'])->latest();
    }

    /**
     * Get the likes that owns the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
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
     * Get the comments that owns the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    /**
     * Get the wikis that owns the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wikis()
    {
        return $this->hasMany(Wiki::class, 'user_id', 'id')->latest();
    }

    /**
     * Get the pages that owns the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany(Page::class, 'user_id', 'id');
    }

    /**
     * Get a user.
     *
     * @param $userSlug string
     * @return bool
     */
    public function getUser($userSlug)
    {
        $user = $this->where('slug', $userSlug)->first();

        if ($user) {
            return $user;
        }

        return false;
    }

    /**
     * Get all the wikis of a user.
     *
     * @param $user object
     * @return \App\Models\User
     */
    public function getWikis($user)
    {
        return $this->find($user->id)->wikis()->paginate(10);
    }

    /**
     * Update a user.
     *
     * @param $slug string
     * @param $data array
     * @return mixed
     */
    public function updateUser($slug, $data)
    {
        return $this->where('slug', '=', $slug)->update([
            'name'       => $data['first_name'] . ' ' . $data['last_name'],
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'timezone'   => !empty($data['timezone']) ? $data['timezone'] : null,
            'email'      => $data['email'],
        ]);
    }

    /**
     * Update user credentials.
     *
     * @param $slug string
     * @param $data array
     * @return mixed
     */
    public function updatePassword($slug, $data)
    {
        return $this->where('slug', $slug)->update([
            'password' => Hash::make(key_exists('new_password', $data) ? $data['new_password'] : $data['password']),
        ]);
    }

    /**
     * Create a new user.
     *
     * @param $data array
     * @return static
     */
    public function createUser($data)
    {
        return $this->create([
            'name'       => $data['first_name'] . ' ' . $data['last_name'],
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'password'   => Hash::make($data['password']),
            'email'      => $data['email'],
        ]);
    }

    /**
     * Get the activities of a user.
     *
     * @param $id integer
     * @return mixed
     */
    public function getActivty($id)
    {
        return $this->find($id)->activity()->paginate(30);
    }

    /**
     * Validate a user credentials.
     *
     * @param $data array
     * @return bool
     */
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

    /**
     * Validate if a user has permission to visit a page,
     *
     * @param $routePermissions string
     * @return bool
     */
    public function hasPermission($routePermissions)
    {
        $routePermissions = explode('|', $routePermissions);

        $roles = Auth::user()->roles;

        foreach ($roles as $role) {
            foreach ($role->permissions as $permission) {
                foreach ($routePermissions as $routePer) {
                    if ($permission->name === $routePer) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Update the avatar of a user.
     *
     * @param int    $userId
     * @param string $image
     * @return mixed
     */
    public function updateAvatar($userId, $image)
    {
        return $this->find($userId)->update([
            'profile_image' => $image,
        ]);
    }
}
