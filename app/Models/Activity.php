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
        'team_id',
        'created_at',
        'updated_at',
    ];

    public function subject()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function team()
    {
        $this->belongsTo(Team::class, 'team_id', 'id');
    }
}
