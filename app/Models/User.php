<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * @var $fillable  array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * @var $hidden array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the organization of a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function organization() {
        return $this->hasOne(Organization::class, 'user_id', 'id');
    }

    /**
     * Get all the organizations of a user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function organizations() {
        return $this->belongsToMany(Organization::class, 'user_organization', 'organization_id', 'id');
    }

    /**
     * Get all the wikis of a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wikis() {
        return $this->hasMany(Wiki::class, 'user_id', 'id');
    }

    /**
     * Get all pages of wikis created by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages() {
        return $this->hasMany(WikiPage::class, 'user_id', 'id');
    }
}
