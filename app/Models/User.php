<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    /**
     * An organization has only one owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function organization()
    {
            return $this->hasOne(Organization::class, 'user_id', 'id');
    }

    /**
     * An organization can have multiple employee.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function organizations()
    {
        return $this->belongsToMany(Organization::class, 'user_organization', 'user_id', 'organization_id');
    }

    /**
     * Get all the wikis that are starred by a user.
     *
     * @return mixed
     */
    public function starWikis()
    {
        return $this->belongsToMany(Wiki::class, 'user_star', 'user_id', 'entity_id')->where('entity_type', '=', 'wiki');
    }

    /**
     * Get all the pages that are starred by a user.
     *
     * @return mixed
     */
    public function starPages()
    {
        return $this->belongsToMany(Wiki::class, 'user_star', 'user_id', 'entity_id')->where('entity_type', '=', 'page');
    }

    /**
     * Get all the wikis that are watched by a user.
     *
     * @return mixed
     */
    public function watchWikis()
    {
        return $this->belongsToMany(Wiki::class, 'user_watch', 'user_id', 'entity_id')->where('entity_type', '=', 'wiki');
    }

    /**
     * Get all the pages that are watched by a user.
     *
     * @return mixed
     */
    public function watchPages()
    {
        return $this->belongsToMany(Wiki::class, 'user_watch', 'user_id', 'entity_id')->where('entity_type', '=', 'page');
    }

    /**
     * A user can have many followers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_followers', 'follow_id', 'user_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'user_followers', 'user_id', 'follow_id');
    }

    /**
     * A user can has many wikis.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wikis()
    {
        return $this->hasMany(Wiki::class, 'user_id', 'id');
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

    public function getUsers()
    {
        return $this->with(['followers', 'following'])->paginate(10);
    }

    public function getUser($id)
    {
        $user = $this->where('id', '=', $id)->with(['organization', 'organizations', 'starWikis', 'starPages', 'watchWikis', 'watchPages', 'followers', 'following', 'wikis'])->first();
        if($user) {
            return $user;
        }
        return false;
    }

    public function getOrganizations($id)
    {
        return $this->where('id', '=', $id)->with(['organizations', 'followers', 'following'])->first();
        // $query = $this;
        // $query = $query->where('users.id', '=', $id)->with(['followers', 'following']);
        // $query = $query->join('user_organization', 'users.id', '=', 'user_organization.user_id')
        //                ->join('organization', 'user_organization.organization_id', '=', 'organization.id')
        //                ->leftJoin('wiki', 'user_organization.organization_id', '=', 'wiki.organization_id')
        //                ->groupBy('user_organization.organization_id')
        //                ->select('organization.*', DB::raw('COUNT(user_organization.user_id) as total_members'), DB::raw('COUNT(wiki.id) as total_wikis'))->first();
        // return $query;
    }

    public function getFollowers($id)
    {
        $query = $this;
        $query = $query->where('users.id', '=', $id)->with(['organizations', 'followers', 'following'])->first();
        return $query;
    }

    public function getFollowing($id)
    {
        $query = $this;
        $query = $query->where('id', '=', $id)->with(['organizations', 'following', 'followers'])->first();
        return $query;
    }

    public function getWikis($id)
    {
        $query = $this;
        $query = $query->where('id', '=', $id)->with(['organizations', 'following', 'followers'])->first();
        return $query;   
    }

    public function followUser($followId)
    {
        return DB::table('user_followers')->insert([
            'user_id'    => Auth::user()->id,
            'follow_id'  => $followId,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    public function unfollowUser($followId)
    {
        return DB::table('user_followers')->where([
            'user_id'    => Auth::user()->id,
            'follow_id'  => $followId,
        ])->delete();
    }
}
