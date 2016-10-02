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
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function wikis() {
        return $this->hasMany(Wiki::class);
    }

    public function pages() {
        return $this->hasMany(WikiPage::class);
    }
}
