<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = 'organization';

    protected $fillable = [
        'name',
        'user_id',
        'updated_at',
        'created_at',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
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
