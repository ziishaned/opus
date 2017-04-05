<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Role
 *
 * @package App\Models
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class Role extends Model
{
    use SoftDeletes, Sluggable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id', 'team_id', 'created_at', 'updated_at',
    ];

    protected $dates = ['deleted_at'];

    const ROLE_RULES = [
        'role_name' => 'required|team_has_role|max:45|min:2',
    ];

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

    /**
     * Get the team that owns the role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    /**
     * Get the user that owns the role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany(User::class, 'users_roles', 'role_id', 'user_id');
    }

    /**
     * Get the permissions that owns the role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id');
    }

    /**
     * Create a new role.
     *
     * @param $data array
     * @return static
     */
    public function createRole($data)
    {
        return $this->create([
            'name'    => $data['role_name'],
            'user_id' => Auth::user()->id,
            'team_id' => Auth::user()->getTeam()->id,
        ]);
    }

    /**
     * Update a role.
     *
     * @param $roleId integer
     * @param $data   array
     * @return mixed
     */
    public function updateRole($roleId, $data)
    {
        return $this->find($roleId)->update([
            'name'    => $data['role_name'],
            'user_id' => Auth::user()->id,
            'team_id' => Auth::user()->getTeam()->id,
        ]);
    }

    /**
     * Get all the roles of a team.
     *
     * @param $teamId integer
     * @return mixed
     */
    public function getTeamRoles($teamId)
    {
        return $this->where('team_id', $teamId)->latest()->with(['members', 'permissions'])->get();
    }
}
