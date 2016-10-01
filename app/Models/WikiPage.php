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
}
