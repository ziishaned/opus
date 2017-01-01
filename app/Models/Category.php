<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const CATEGORY_RULES = [
        'name' => 'required',
    ];

    protected $table = 'category';

    protected $fillable = [
    	'name',
    	'user_id',
    	'organization_id',
    	'created_at',
    	'updated_at',
    ];
}
