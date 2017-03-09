<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Integration extends Model
{
    use Sluggable;

    protected $table = 'integration';

    protected $fillable = [
    	'title',
    	'slug',
    	'url',
    	'team_id',
    	'user_id',
    	'created_at',
    	'updated_at',
    ];

    const INTEGRATION_RULES = [
        'title' => 'required',
        'url' => 'required|url'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function team()
    {
    	return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function members()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function permissions()
    {
    	return $this->belongsToMany(IntegrationAction::class, 'team_integration_actions', 'integration_id', 'integration_action_id');
    }

    public function storeSlackIntegration($data, $teamId)
    {
        $integration = $this->create([
            'title' => $data['title'],
            'url'   => $data['url'],
            'team_id'   => $teamId,
            'user_id'   => Auth::user()->id,
        ]);

        return $integration;
    }
}
