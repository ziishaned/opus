<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response;

class Organization extends Model
{
    /**
     * @const array
     */
    const ORGANIZATION_RULES = [
        'organization_name' => 'required|max:55|unique:organization,name',
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'user_organization', 'organization_id', 'user_id');
    }

    /**
     * An organization can have many wikis.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wikis()
    {
        return $this->hasMany(Wiki::class, 'organization_id', 'id');
    }

    /**
     * Get all the organizations.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getOrganizations()
    {
        return $this->with(['user', 'wikis'])
                    ->paginate(10);
    }

    /**
     * Find a specific array in organization table.
     *
     * @param  integer $id
     * @return mixed
     */
    public function getOrganization($id)
    {
        $organization = $this->where('id', '=', $id)
                             ->with(['user', 'wikis', 'members'])
                             ->first();
        if($organization) {
            return $organization;
        }
        return false;
    }

    /**
     * Create an organization.
     *
     * @param  string $organizationName
     * @return mixed
     */
    public function postOrganization($organizationName)
    {
        $organization = $this->create([
            'name'     =>  $organizationName,
            'user_id'  =>  Auth::user()->id
        ]);
        DB::table('user_organization')->insert([
            'user_type'        => 'admin',
            'user_id'          => Auth::user()->id,
            'organization_id'  => $organization->id,
            'created_at'       => Carbon::now(),
            'updated_at'       => Carbon::now(),
        ]);
        return $organization->id;
    }

    /**
     * Update organization in database.
     *
     * @param  integer $id
     * @param  string  $organizationName
     * @return mixed
     */
    public function updateOrganization($id, $organizationName)
    {
        $organization = $this->find($id)->update([
            'name' => $organizationName,
        ]);
        if($organization) {
            return true;
        }
        return false;
    }

    /**
     * Delete organization from database.
     *
     * @param  integer $id
     * @return mixed
     */
    public function deleteOrganization($id)
    {
        if($this->find($id)->delete()) {
            return true;
        };
        return false;
    }

    public function inviteUser($data) {
        $userHaveOrganization =  DB::table('user_organization')
                                     ->whereIn('user_id', [$data['userId']])
                                     ->whereIn('organization_id', [$data['organizationId']])
                                     ->first();
        if(!$userHaveOrganization) {
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

    public function removeInvite($data)
    {
        DB::table('user_organization')
            ->where('user_id', '=', $data['userId'])
            ->where('organization_id', '=', $data['organizationId'])
            ->delete();
        return true;
    }

    public function getMembers($organizationId)
    {
        $query = $this;
        $query = $query->where('organization.id', '=', $organizationId);
        $query = $query->join('user_organization', 'organization.id', '=', 'organization_id')
                       ->join('users', 'user_organization.user_id', '=', 'users.id')
                       ->select([
                           'organization.id as organization_id',
                           'user_organization.user_type as member_type',
                           'users.name as member_name',
                           'users.id as member_id',
                           'users.email as member_email',
                       ])
                       ->groupBy('user_organization.user_id')
                       ->paginate(16);
        return $query;
    }

    public function getWikis($organizationId)
    {
        $organization = $this->where('id', '=', $organizationId)
                             ->with(['wikis', 'members'])
                             ->first();
        return $organization;
    }

    public function isMember($userId, $organizationId)
    {
        $member = DB::table('user_organization')->where([
            'user_id'         => $userId,
            'organization_id' => $organizationId,
        ])->first();

        if($member) {
            return true;
        }
        return false;
    }

    public function filterOrganizations($text)
    {
        $query = $this;
        $query = $query->where('user_organization.user_id', '=', Auth::user()->id);
        $query = $query->where('organization.name', 'like', '%' . $text . '%');
        $query = $query->join('user_organization', 'organization.id', '=', 'user_organization.organization_id')
                       ->select('organization.*')->get();   
        return $query;
    }
}
