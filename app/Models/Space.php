<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\Space\CreateSpaceNotification;
use App\Notifications\Space\DeleteSpaceNotification;
use App\Notifications\Space\UpdateSpaceNotification;

class Space extends Model
{
    use Sluggable, RecordsActivity, SoftDeletes, Notifiable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected static $recordEvents = ['created', 'updated', 'deleted'];

    const SPACE_RULES = [
        'name' => 'required|unique:space,name|max:25',
    ];

    protected $table = 'space';

    protected $fillable = [
        'name',
        'slug',
    	'outline',
    	'user_id',
    	'team_id',
    	'created_at',
    	'updated_at',
    ];

    protected $dates = ['deleted_at'];

    public function routeNotificationForSlack()
    {
        $integration = Team::find(Auth::user()->team->first()->id)->with(['integration'])->first()->integration;

        return $integration ? $integration->url : null;
    }

    public static function boot()
    {
        parent::boot();

        $spaceObject = new Space();

        static::created(function($space) use ($spaceObject) {
            $spaceObject->notify(new CreateSpaceNotification($space));
        });

        static::updated(function($space) use ($spaceObject) {
            $spaceObject->notify(new UpdateSpaceNotification($space));
        });

        static::deleting(function($space) use ($spaceObject) {
            $spaceObject->notify(new DeleteSpaceNotification($space));
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function wikis()
    {
        return $this->hasMany(Wiki::class, 'space_id', 'id');
    }

    public function createSpace($data, $teamId)
    {
    	$this->create([
    		'name' 		=> $data['name'],
            'outline'   => $data['description'],
	    	'user_id' 	=> Auth::user()->id,
	    	'team_id'   => $teamId,
    	]);

    	return true;
    }

    public function getTeamSpaces($teamId)
    {
        return $this->where('team_id', $teamId)->get();
    }

    public function deleteSpace($spaceId)
    {
        $this->find($spaceId)->delete();
        return true;
    }

    public function updateSpace($data, $spaceId, $teamId)
    {
        $this->find($spaceId)->update([
                                    'name' => $data['space_name'],
                                    'outline' => $data['description'],
                                ]);
        return true;
    }

    public function getSpace($spaceSlug, $teamId)
    {
        return $this->where('slug', '=', $spaceSlug)
                    ->where('team_id', '=', $teamId)
                    ->with(['wikis'])
                    ->first();   
    }
}
