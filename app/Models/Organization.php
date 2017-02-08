<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Organization
 *
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 * @package App\Models
 */
class Organization extends Model
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

    /**
     * @const array
     */
    const ORGANIZATION_RULES = [
        'organization_name' => 'required|unique:organization,name',
    ];

    /**
     * @const array
     */
    const CREATE_ORGANIZATION_RULES = [
        'email'             => 'required|email',
        'first_name'        => 'required|max:15',
        'last_name'         => 'required|max:15',
        'password'          => 'required|min:6|confirmed',
        'organization_name' => 'required|unique:organization,name',
    ];

    /**
     * @var string
     */
    protected $table = 'organization';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'user_id',
        'updated_at',
        'created_at',
    ];

    protected $dates = ['deleted_at'];

    public static function boot()
    {
        parent::boot();
        
        Organization::created(function($organization) {
            DB::table('user_organization')->insert([
                'user_type'       => 'admin',
                'user_id'         => $organization->user_id,
                'organization_id' => $organization->id,
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ]);
        });
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'organization_id', 'id');
    }

    public function activity()
    {
        return $this->hasMany(Activity::class, 'organization_id', 'id')->with(['user', 'subject' => function($query) {
            $query->withTrashed();
        }])->latest();
    }

    public function subject()
    {
        return $this->morphTo();
    }

    /**
     * User can join organization.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Organization can have many members or users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany(User::class, 'user_organization', 'organization_id', 'user_id')->withPivot('created_at as joined_date', 'user_type as user_role');
    }

    /**
     * An organization can have many wikis.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wikis()
    {
        return $this->hasMany(Wiki::class, 'organization_id', 'id')->latest();
    }

    /**
     * Get all the organizations.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getOrganizations()
    {
        return $this->with(['user', 'wikis'])->paginate(10);
    }

    /**
     * Find a specific array in organization table.
     *
     * @param  string $organizationSlug
     *
     * @return mixed
     */
    public function getOrganization($organizationSlug)
    {
        $organization = $this->where('slug', '=', $organizationSlug)
                             ->with(['user', 'wikis', 'members'])
                             ->first();
        if ($organization) {
            return $organization;
        }

        return false;
    }

    public function getWikis($organizationId, $total = null)
    {
        if(!is_null($total)) {
            $organization = $this->where('id', $organizationId)->with(['wikis' => function($query) {
                return $query->take(5);
            }])->first();
            
            return $organization->wikis;
        }
        $organizationWikis = $this->find($organizationId)->wikis()->paginate(10);

        return $organizationWikis;
    }

    /**
     * Create an organization.
     *
     * @return mixed
     */
    public function postOrganization($organization)
    {
        $this->create([
            'name'        => $organization['organization_name'],
            'user_id'     => $organization['user_id'],
            'description' => $organization['description'],
        ]);

        return true;
    }

    /**
     * Update organization in database.
     *
     * @param  integer $id
     * @param  string  $organizationName
     *
     * @return mixed
     */
    public function updateOrganization($id, $organizationName)
    {
        $organization = $this->find($id)->update([
            'name' => $organizationName,
        ]);
        if ($organization) {
            return true;
        }

        return false;
    }

    /**
     * Delete organization from database.
     *
     * @param  integer $id
     *
     * @return mixed
     */
    public function deleteOrganization($id)
    {
        if ($this->find($id)->delete()) {
            return true;
        };

        return false;
    }

    /**
     * Invite a user to organization.
     *
     * @param array $data
     *
     * @return bool
     */
    public function inviteUser($data)
    {
        $userHaveOrganization = DB::table('user_organization')
                                  ->whereIn('user_id', [$data['userId']])
                                  ->whereIn('organization_id', [$data['organizationId']])
                                  ->first();
        if (!$userHaveOrganization) {
            DB::table('user_organization')->insert([
                'user_type'       => 'normal',
                'user_id'         => $data['userId'],
                'organization_id' => $data['organizationId'],
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ]);

            return true;
        }

        return true;
    }

    /**
     * Remove a user from organization.
     *
     * @param array $data
     *
     * @return bool
     */
    public function removeInvite($data)
    {
        DB::table('user_organization')
          ->where('user_id', '=', $data['userId'])
          ->where('organization_id', '=', $data['organizationId'])
          ->delete();

        return true;
    }

    /**
     * Get all the members of an organization
     *
     * @param $organization
     *
     * @return \App\Models\Organization
     */
    public function getMembers($organization)
    {
        $members = $this->find($organization->id)->members()->paginate(10);

        return $members;
    }

    /**
     * Check if a user is member of an organization.
     *
     * @param $userId
     * @param $organizationId
     *
     * @return bool
     */
    public function isMember($userId, $organizationId)
    {
        $member = DB::table('user_organization')->where([
            'user_id'         => $userId,
            'organization_id' => $organizationId,
        ])->first();

        if ($member) {
            return true;
        }

        return false;
    }

    /**
     * Filter the organizations.
     *
     * @param string $text
     *
     * @return \App\Models\Organization
     */
    public function filterOrganizations($text)
    {
        $query = $this;
        $query = $query->where('user_organization.user_id', '=', Auth::user()->id);
        $query = $query->where('organization.name', 'like', '%' . $text . '%');
        $query = $query->join('user_organization', 'organization.id', '=', 'user_organization.organization_id')
                       ->select('organization.*')->get();

        return $query;
    }

    public function getUserOrganizations($userId)
    {
        return $this
            ->join('user_organization', 'organization.id', '=', 'user_organization.organization_id')
            ->where('user_organization.user_id', '=', $userId)
            ->where('user_organization.user_type', '=', 'admin')
            ->groupBy('organization.user_id')
            ->select('organization.*', 'user_organization.user_type')
            ->get();
    }

    public function getActivty($id)
    {
        return $this->where('id', $id)->with('activity')->first();
    }
}
