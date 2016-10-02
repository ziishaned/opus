<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function organization() {
        return $this->hasOne('App\Models\Organization');
    }

    public function user_organization() {
        return $this->hasMany('App\Models\UserOrganization');
    }

    public function wiki() {
        return $this->hasMany('App\Models\Wiki');
    }

    public function wiki_page() {
        return $this->hasMany('App\Models\WikiPage');
    }
}
