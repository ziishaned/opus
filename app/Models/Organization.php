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
        if($this->find($id)) {
            return $this->where('id', '=', $id)->with(['user', 'wikis'])->get();
        }

        return response()->json([
            'message' => 'Resource not found.'
        ], Response::HTTP_NOT_FOUND);
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

        return response()->json([
            'message' => 'Organization successfully created.'
        ], Response::HTTP_CREATED);
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
        if($this->find($id)) {
            $organization = $this->find($id);
            $organization->name = $organizationName;
            $organization->save();

            return response()->json([
                'message' => 'Organization successfully updated.'
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Resource not found.'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Delete organization from database.
     *
     * @param  integer $id
     * @return mixed
     */
    public function deleteOrganization($id)
    {
        if($this->find($id)) {
            $this->find($id)->delete();
            return response()->json([
                'message' => 'Organization successfully deleted.'
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Resource not found.'
        ], Response::HTTP_NOT_FOUND);
    }
}
