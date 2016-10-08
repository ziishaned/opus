<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        return $this->belongsToMany(User::class, 'user_follower', 'user_id', 'id');
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
        $user = $this->where('id', '=', $id)->with(['organization', 'organizations', 'starWikis', 'starPages', 'watchWikis', 'watchPages'])->first();
        if($user) {
            return $user;
        }
        return false;
    }
}
