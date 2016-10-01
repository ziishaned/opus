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
}
