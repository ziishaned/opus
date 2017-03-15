<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $table = 'groups';

    protected $fillable = [
    	'code',
    	'email',
    	'team_id',
    	'claimed_at',
    ];

    public function team()
    {
    	return $this->belongsTo(Team::class, 'team_id', 'id');
    }
}
