<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageTags extends Model
{
	protected $table = 'page_tags';
	
    protected $fillable = [
        'tag_id',
        'subject_id',
        'subject_type',
        'created_at',
        'updated_at',
    ];
}
