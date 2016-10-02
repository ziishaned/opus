<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WikiPage extends Model
{
    protected $table = 'wiki_page';

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'wiki_id',
        'organization_id',
        'created_at',
        'updated_at',
    ];

    public function wiki() {
        return $this->belongsTo(Wiki::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function organization() {
        return $this->belongsTo(Organization::class);
    }
}
