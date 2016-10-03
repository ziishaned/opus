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
     * An organization can have multiple pages in a wiki.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany(WikiPage::class, 'organization_id', 'id');
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
     * @param  integer $id
     * @return mixed
     */
    public function getOrganization($id)
    {
        $organization = $this->where('id', '=', $id)->with(['user', 'wikis'])->first();
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
        DB::insert('INSERT INTO user_organization (user_type, user_id, organization_id, created_at, updated_at) values(?, ?, ?, ?, ?)', [
            'admin', Auth::user()->id, $organization->id, Carbon::now(), Carbon::now()
        ]);
        return true;
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
}
