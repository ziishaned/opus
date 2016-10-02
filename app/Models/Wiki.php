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
        return $this->belongsTo(User::class);
    }

    public function pages() {
        return $this->hasMany(WikiPage::class);
    }

    public function organization() {
        return $this->belongsTo(Organization::class);
    }
}
