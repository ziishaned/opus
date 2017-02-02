<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    protected $fillable = [
        'subject_id',
        'subject_type',
    	'name',
    	'user_id',
    	'created_at',
    	'updated_at',
    ];

    public function subject()
    {
    	return $this->morphTo();
    }
}
