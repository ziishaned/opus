<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserOrganization extends Model
{
    protected $table = 'user_organization';

    protected $fillable = [
        'user_type',
        'user_id',
        'organization_id',
        'created_at',
        'updated_at',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function organization() {
        return $this->belongsTo('App\Models\Organization');
    }
}
