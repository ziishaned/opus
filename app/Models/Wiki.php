<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wiki extends Model
{
    protected $table = 'wiki';

    protected $fillable = [
        'name',
        'user_id',
        'updated_at',
        'created_at',
        'organization_id',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function wiki_page() {
        return $this->hasMany('App\Models\WikiPage');
    }

    public function organization() {
        return $this->belongsTo('App\Models\Organization');
    }
}
